<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getUnlinkedBuriedIndividuals(){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM BURIED_INDIVIDUALS WHERE "
                . "(buried_individuals.TOMB_ID IS NULL && "
                . "buried_individuals.COLUMBARIUM_ID IS NULL);";
        $statement = $con->prepare($query);
        $success = $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($results) > 0)
        {
            for( $i =0; $i< count($results); $i++)
            {

                $row = $results[$i];
                $buriedIndividual = new BuriedIndividual($row);
                $response ->addResult($buriedIndividual);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Unlinked Buried Individuals.");
        }
        return $response;
    }
    catch (PDOException $e) 
    {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}

function getAllOwners(){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM OWNERS;";
        $statement = $con->prepare($query);
        $success = $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($results) > 0)
        {
            for( $i =0; $i< count($results); $i++)
            {
                $row = $results[$i];
                $owner = new Owner($row);
                $response ->addResult($owner);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch All Owners.");
        }
        return $response;
    }
    catch (PDOException $e) 
    {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}

function getAllColumbariumSectionLetters(){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM columbarium_section_letters;";
        $statement = $con->prepare($query);
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0){
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $columberiumSectionLetter = new SectionLetter($row);
                $response -> addResult($columberiumSectionLetter);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Columbarium Section Letters.");
        }
        return $response;
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}

// Buried Individual Ids parameter is solely used for the purposes of filtering
function getBuriedIndividualsForTomb($tombId, $buriedIndividualIds){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        //This is done differently because we are comparing in SQL using `IN` 
        // which we cannot compare list to null
        $qw = isset($buriedIndividualIds) && count($buriedIndividualIds) > 0? 
                "and ID in ("
                . implode(',', $buriedIndividualIds) .")" : "";
        $query = "SELECT * FROM buried_individuals "
                . "where (:tombId is NULL or TOMB_ID = :tombId) "
                . $qw .";";
        
        $statement = $con->prepare($query);
        if(!isset($tombId)){
            $statement->bindValue(':tombId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':tombId', $tombId);
        }
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0){
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $buriedIndividual = new BuriedIndividual($row);
                $response -> addResult($buriedIndividual);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Buried Individuals.");
        }
        return $response;
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}

function getAttachmentsForTomb($tombId){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM "
                . "TOMB_ATTACHMENTS "
                . "WHERE TOMB_ID = :tombId;";
        $statement = $con->prepare($query);
        $statement->bindParam(':tombId', $tombId);
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0){
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $attachment = new TombAttachment($row);
                $response -> addResult($attachment);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Tomb Attachments.");
        }
        return $response;
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}

//-------------------------------------------------------------------
// This function will be used to fetch either all tombs, filtered tombs,
// or even one specific tomb.
// Send the appropriate filter parameters to fetch the needed tomb
// function calls getAttachmentsForTomb() and getBuriedIndividualsForTomb()
// responds with a response with result including listOf(Tombs)
function getAllTombRelatedDataWithFilter(TombFilter $filter){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT T.ID, T.FOR_SALE, T.HAS_OPEN_PLOTS, T.PURCHASE_DATE, "
                . "T.PRICE, T.SECTION_LETTER_ID, T.LOT_NUMBER, T.LONGITUDE, "
                . "T.LATITUDE, T.MAIN_IMAGE, T.OWNER_ID, O.ID AS OWNR_ID, "
                . "O.FIRST_NAME AS OWNR_FIRST_NAME, O.LAST_NAME AS OWNR_LAST_NAME, "
                . "O.MIDDLE_NAME AS OWNR_MIDDLE_NAME, O.ADDRESS AS OWNR_ADDRESS, "
                . "O.PHONE_NUMBER AS OWNR_PHONE_NUMBER, O.EMAIL AS OWNR_EMAIL, "
                . "TSL.ID AS SL_ID, TSL.SECTION_LETTER AS SL_SECTION_LETTER "
                . "FROM TOMBS T INNER JOIN tomb_section_letters TSL ON "
                . "T.SECTION_LETTER_ID = TSL.ID LEFT JOIN OWNERS O ON "
                . "O.ID = T.OWNER_ID "
                . "WHERE " // All Filters are added here except for buriedIndividualIds
                . "(:tombId IS NULL or T.ID = :tombId) and"
                . "(:sectionLetterId IS NULL or t.SECTION_LETTER_ID = :sectionLetterId) and"
                . "(:lotNumber IS NULL or T.LOT_NUMBER = :lotNumber) and"
                . "(:hasOpenPlots IS NULL or T.HAS_OPEN_PLOTS = :hasOpenPlots) and"
                . "(:forSale IS NULL or T.FOR_SALE = :forSale) and"
                . "(:ownerId IS NULL or T.OWNER_ID = :ownerId);";
        
        $statement = $con->prepare($query);
        
        // Binding parameters
        if(!isset($filter ->tombId)){
            $statement->bindValue(':tombId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':tombId', $filter ->tombId);
        }
        if(!isset($filter -> sectionLetterId)){
            $statement->bindValue(':sectionLetterId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':sectionLetterId', $filter -> sectionLetterId);
        }
        if(!isset($filter -> lotNumber)){
            $statement->bindValue(':lotNumber', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':lotNumber', $filter -> lotNumber);
        }
        if(!isset($filter -> hasOpenPlots)){
            $statement->bindValue(':hasOpenPlots', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':hasOpenPlots', $filter -> hasOpenPlots);
        }
        if(!isset($filter -> forSale)){
            $statement->bindValue(':forSale', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':forSale', $filter -> forSale);
        }
        if(!isset($filter -> ownerId)){
            $statement->bindValue(':ownerId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':ownerId', $filter -> ownerId);
        }
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0){
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $tomb = new Tomb($row);
                $tomb ->setOwner($row);
                $tomb ->setSectionLetter($row);
                
                $buriedIndividualsPromise = getBuriedIndividualsForTomb($tomb -> id, $filter ->buriedIndividualIds);
                // If we were able to fetch the buried individuals associated with tomb
                if(count($buriedIndividualsPromise->result) > 0){
                    $tomb ->setBuriedIndividuals($buriedIndividualsPromise->result);
                }
                // If we have an error, only care to fetch the first error in the list and add it to our response's error
                if(count($buriedIndividualsPromise -> error) > 0){
                    $response -> addError($buriedIndividualsPromise -> error[0]);
                }
                
                $attachmentsPromise = getAttachmentsForTomb($tomb ->id);
                // If we were able to fetch the attachments associated with tomb
                if(count($attachmentsPromise->result) > 0){
                    $tomb ->setAttachments($attachmentsPromise->result);
                }
                // If we have an error, only care to fetch the first error in the list and add it to our response's error
                if(count($attachmentsPromise -> error) > 0){
                    $response -> addError($attachmentsPromise -> error[0]);
                }
                
                $response -> addResult($tomb);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Buried Individuals.");
        }
        return $response;
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}
    