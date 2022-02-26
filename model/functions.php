<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getUnlinkedBuriedIndividuals(){
    $response = new Response();
    try{
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
    }
    catch (PDOException $e) 
    {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAllOwners(){
    $response = new Response();
    try{
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
    }
    catch (PDOException $e) 
    {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAllColumbariumSectionLetters(){
    $response = new Response();
    try{
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
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

// Buried Individual Ids parameter is solely used for the purposes of filtering
function getBuriedIndividualsForTomb($tombId){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM buried_individuals "
                . "where (:tombId is NULL or TOMB_ID = :tombId);";
        
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
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAttachmentsForTomb($tombId){
    $response = new Response();
    try{
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
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

//-------------------------------------------------------------------
// This function will be used to fetch either all tombs, filtered tombs,
// or even one specific tomb.
// Send the appropriate filter parameters to fetch the needed tomb
// function calls getAttachmentsForTomb() and getBuriedIndividualsForTomb()
// responds with a response with result including listOf(Tombs)
function getAllTombRelatedDataWithFilter(TombFilter $filter){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        //This is done differently because we are comparing in SQL using `IN` 
        // which we cannot compare list to null
        if(isset($filter -> buriedIndividualIds) && count($filter->buriedIndividualIds) > 0){
            $qw = "and T.ID in (select TOMB_ID from buried_individuals where ID in ("
                . implode(',', $filter ->  buriedIndividualIds) ."))";
        }
        else{
            $qw = "";
        }
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
                . "WHERE " // All Filters are added here
                . "(:tombId IS NULL or T.ID = :tombId) and"
                . "(:sectionLetterId IS NULL or t.SECTION_LETTER_ID = :sectionLetterId) and"
                . "(:lotNumber IS NULL or T.LOT_NUMBER = :lotNumber) and"
                . "(:hasOpenPlots IS NULL or T.HAS_OPEN_PLOTS = :hasOpenPlots) and"
                . "(:forSale IS NULL or T.FOR_SALE = :forSale) and"
                . "(:ownerId IS NULL or T.OWNER_ID = :ownerId)"
                . $qw .";";
        
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
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAllBuriedIndividuals() {
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM buried_individuals;";
        $statement = $con->prepare($query);        
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0)
        {
            for( $i =0; $i< count($result); $i++)
            {
                $row = $result[$i];
                $buriedIndividual = new BuriedIndividual($row);
                $response -> addResult($buriedIndividual);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch All Buried Individuals.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAdmin($username,$password){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM ADMINS WHERE (USERNAME = :username && PASSWORD = :password );";
        $statement = $con->prepare($query);  
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0)
        {
            for( $i =0; $i< count($result); $i++)
            {
                $row = $result[$i];
                $admin = new Admin($row);
                $response -> addResult($admin);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch All Admins.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAllNicheTypes(){
    $response = new Response();
    try {
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM NICHE_TYPES;";
        $statement = $con->prepare($query);          
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0)
        {
            for( $i =0; $i< count($result); $i++)
            {
                $row = $result[$i];
                $nicheType = new Type($row);
                $response -> addResult($nicheType);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch All Niche Types.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function checkUsernameExist($username){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM ADMINS WHERE (USERNAME = :username);";
        $statement = $con->prepare($query);  
        $statement->bindParam(':username', $username);
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success)
        {
            if(count($result) == 1){
                $response -> addResult(true);
            }
            else{
                $response -> addResult(false);
            }
        }
        else{
            $response -> addError("Failed to fetch Admin with username");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAllColumbariumTypes(){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM columbarium_types;";
        $statement = $con->prepare($query);          
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0)
        {
            for($i = 0;$i < count($result); $i++)
            {
                $row = $result[$i];
                $columbariumType = new Type($row);
                $response -> addResult($columbariumType);                
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Columbarium types.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getAllTombSectionLetters(){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM tomb_section_letters;";
        $statement = $con->prepare($query);          
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0)
        {
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $tombSectionLetters = new SectionLetter($row);
                $response -> addResult($tombSectionLetters);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Tomb Section Letters.");
        }
        
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

// Buried Individual Ids parameter is solely used for the purposes of filtering
function getBuriedIndividualsForColumbarium($columbariumId){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM buried_individuals "
                . "where (:columbariumId is NULL or COLUMBARIUM_ID = :columbariumId);";
        
        $statement = $con->prepare($query);
        if(!isset($columbariumId)){
            $statement->bindValue(':columbariumId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':columbariumId', $columbariumId);
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
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function getColumbariumAttachments($columbariumId){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM "
                . "COLUMBARIUM_ATTACHMENTS "
                . "WHERE COLUMBARIUM_ID = :columbariumId;";
        $statement = $con->prepare($query);
        $statement->bindParam(':columbariumId', $columbariumId);
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0){
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $attachment = new ColumbariumAttachment($row);
                $response -> addResult($attachment);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Columbarium Attachments.");
        }
    } 
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}


function getAllColumbariumRelatedDataWithFilter(ColumbariumFilter $filter)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        //comparing in SQL using 'IN', which can't compare list to null
        if(isset($filter -> buriedIndividualIds) && count($filter->buriedIndividualIds) > 0){
            $qw = "and C.ID in (select COLUMBARIUM_ID from buried_individuals where ID in ("
                . implode(',', $filter ->  buriedIndividualIds) ."))";
        }
        else{
            $qw = "";
        }
        $query = "SELECT C.ID, C.FOR_SALE, C.PURCHASE_DATE, C.PRICE, "
            . "C.SECTION_LETTER_ID, C.SECTION_NUMBER, C.NICHE_TYPE_ID, "
            . "C.COLUMBARIUM_TYPE_ID, "
            . "C.MAIN_IMAGE, C.OWNER_ID, O.ID AS OWNR_ID, O.FIRST_NAME AS OWNR_FIRST_NAME, "
            . "O.LAST_NAME AS OWNR_LAST_NAME, O.MIDDLE_NAME AS OWNR_MIDDLE_NAME, "
            . "O.ADDRESS AS OWNR_ADDRESS, O.PHONE_NUMBER AS OWNR_PHONE_NUMBER, "
            . "O.EMAIL AS OWNR_EMAIL, CSL.ID AS SL_ID, CSL.SECTION_LETTER AS SL_SECTION_LETTER, "
            . "NT.ID AS NT_ID, NT.TYPE AS NT_TYPE, CT.ID AS CT_ID, CT.TYPE AS CT_TYPE "
            . "FROM COLUMBARIUM C LEFT JOIN owners O ON C.OWNER_ID = O.ID "
            . "INNER JOIN columbarium_section_letters CSL ON CSL.ID = C.SECTION_LETTER_ID "
            . "INNER JOIN niche_types NT ON NT.ID = C.NICHE_TYPE_ID "
            . "INNER JOIN columbarium_types CT ON CT.ID=C.COLUMBARIUM_TYPE_ID "
            . "WHERE " //FILTERS ADD HERE
            . "(:columbariumId IS NULL or C.ID = :columbariumId) and "
            . "(:sectionLetterId IS NULL or C.SECTION_LETTER_ID = :sectionLetterId) and "
            . "(:sectionNumber IS NULL or C.SECTION_NUMBER = :sectionNumber) and "
            . "(:nicheTypeId IS NULL or C.NICHE_TYPE_ID = :nicheTypeId) and "
            . "(:columbariumTypeId IS NULL or C.COLUMBARIUM_TYPE_ID = :columbariumTypeId) and "
            . "(:forSale IS NULL or C.FOR_SALE = :forSale) and "
            . "(:ownerId IS NULL or C.OWNER_ID = :ownerId)"
            . $qw. ";";
        $statement = $con->prepare($query);
        
        //binding paramters        
        if(!isset($filter ->columbariumId)){
            $statement->bindValue(':columbariumId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':columbariumId', $filter ->columbariumId);
        }
        if(!isset($filter -> sectionLetterId)){
            $statement->bindValue(':sectionLetterId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':sectionLetterId', $filter ->sectionLetterId);
        }
        if(!isset($filter -> sectionNumber)){
            $statement->bindValue(':sectionNumber', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':sectionNumber', $filter ->sectionNumber);
        }
        if(!isset($filter -> nicheTypeId)){
            $statement->bindValue(':nicheTypeId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':nicheTypeId', $filter ->nicheTypeId);
        }
        if(!isset($filter -> columbariumTypeId)){
            $statement->bindValue(':columbariumTypeId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':columbariumTypeId', $filter ->columbariumTypeId);
        }
        if(!isset($filter -> forSale)){
            $statement->bindValue(':forSale', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':forSale', $filter->forSale);
        }
        if(!isset($filter -> ownerId)){
            $statement->bindValue(':ownerId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':ownerId', $filter ->ownerId);
        }
        $success = $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($result) > 0) {
            for($i = 0; $i < count($result); $i++)
            {
                $row = $result[$i];
                $columbarium = new Columbarium($row);
                $columbarium ->setOwner($row);
                $columbarium ->setSectionLetter($row);
                $buriedIndividualsPromise = getBuriedIndividualsForColumbarium($columbarium -> id, $filter->buriedIndividualIds);
                if(count($buriedIndividualsPromise ->result)>0){
                    $columbarium->setBuriedIndividuals($buriedIndividualsPromise->result);
                }
                if(count($buriedIndividualsPromise-> error) > 0){
                    $response ->addError($buriedIndividualsPromise -> error[0]);
                }
                $attachmentsPromise = getColumbariumAttachments($columbarium ->id);
                //if we were able to fetch the attachments associated with tomb
                if(count($attachmentsPromise -> result) > 0){
                    $columbarium -> setAttachments($attachmentsPromise->result);
                }
                //if we have an error, only care to fetch the first error in the list and add it to our response's error
                if(count($attachmentsPromise -> error) > 0){
                    $response -> addError($attachmentsPromise -> error[0]);
                }
                $response -> addResult($columbarium);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Columbarium Data.");
        }
        }

    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}