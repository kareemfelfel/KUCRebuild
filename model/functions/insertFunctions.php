<?php

/* 
 * All Model Insert methods to be included in this file
 */
function insertTombAttachments($tombId, $attachments){
    $response = new Response();
    if(!isset($attachments) || count($attachments) == 0){
        $response->addResult(true); // Do not bother trying to add an empty array
        return $response;
    }
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $sq = "";
        for($i = 0; $i < count($attachments); $i++){
            $sq .= "(" . $tombId . ", '". $attachments[$i] . "')";
            if($i != count($attachments) - 1){
                $sq .= ",";
            }
        }
        $query = "INSERT INTO `tomb_attachments` "
                . "(TOMB_ID, LINK) "
                . "VALUES "
                . $sq .";";
        $statement = $con->prepare($query);  
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else{
            $response -> addError("Failed to link attachments to tomb.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function insertColumbariumAttachments($columbariumId, $attachments){
    $response = new Response();
    if(!isset($attachments) || count($attachments) == 0){
        $response->addResult(true); // Do not bother trying to add an empty array
        return $response;
    }
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $sq = "";
        for($i = 0; $i < count($attachments); $i++){
            $sq .= "(" . $columbariumId . ", '". $attachments[$i] . "')";
            if($i != count($attachments) - 1){
                $sq .= ",";
            }
        }
        $query = "INSERT INTO `columbarium_attachments` "
                . "(COLUMBARIUM_ID, LINK) "
                . "VALUES "
                . $sq .";";
        $statement = $con->prepare($query);  
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else{
            $response -> addError("Failed to link attachments to Columbarium.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function insertAllTombRelatedData(ToTableTomb $tombData){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "INSERT INTO `tombs` "
                . "(FOR_SALE, HAS_OPEN_PLOTS, LATITUDE, LONGITUDE, LOT_NUMBER, MAIN_IMAGE, OWNER_ID, PRICE, PURCHASE_DATE, SECTION_LETTER_ID, PLOT_NUMS, NOTES) "
                . "VALUES "
                . "(:forSale, :hasOpenPlots, :latitude, :longitude, "
                . ":lotNumber, :mainImage, :ownerId, :price, :purchaseDate, "
                . ":sectionLetterId, :plotNumbers, :notes);";
        $statement = $con->prepare($query); 
        
        // Binding parameters
        // NON NULL params
        $statement->bindParam(':forSale', $tombData->forSale);
        
        $statement->bindParam(':hasOpenPlots', $tombData->hasOpenPlots);
        
        $statement->bindParam(':latitude', $tombData->latitude);
        
        $statement->bindParam(':longitude', $tombData->longitude);
        
        $statement->bindParam(':lotNumber', $tombData->lotNumber);
        
        $statement->bindParam(':mainImage', $tombData->mainImage);
        
        $statement->bindParam(':sectionLetterId', $tombData->sectionLetterId);
        
        // Nullable data
        if(!isset($tombData -> ownerId)){
            $statement->bindValue(':ownerId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':ownerId', $tombData ->ownerId);
        }
        
        if(!isset($tombData -> price)){
            $statement->bindValue(':price', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':price', $tombData ->price);
        }
        
        if(!isset($tombData -> purchaseDate)){
            $statement->bindValue(':purchaseDate', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':purchaseDate', $tombData ->purchaseDate);
        }
        if(!isset($tombData -> plotNums)){
            $statement->bindValue(':plotNumbers', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':plotNumbers', $tombData ->plotNums);
        }
        if(!isset($tombData -> notes)){
            $statement->bindValue(':notes', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':notes', $tombData ->notes);
        }
        
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $tombId = $con->lastInsertId();
            $tombAttachmentsPromise = insertTombAttachments($tombId, $tombData->attachedDocuments);
            if(count($tombAttachmentsPromise->error) > 0){
                $response->addError($tombAttachmentsPromise->error[0]);
            }
            $updateBIPromise = updateBuriedIndividualsTombId($tombId, $tombData ->buriedIndividualIds);
            if(count($updateBIPromise->error) > 0){
                $response->addError($updateBIPromise->error[0]);
            }
            
            if(count($response->error) == 0){
                $response->addResult(true);
            }
        }
        else{
            $response -> addError("Failed to Insert Tomb Data.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function insertAllColumbariumRelatedData(ToTableColumbarium $columbariumData){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "INSERT INTO columbarium "
                . "(FOR_SALE, PURCHASE_DATE, PRICE, SECTION_LETTER_ID, SECTION_NUMBER, NICHE_TYPE_ID, COLUMBARIUM_TYPE_ID, MAIN_IMAGE, OWNER_ID) VALUES "
                . "(:forSale, :purchaseDate, :price, :sectionLetterId, "
                . ":sectionNumber, :nicheTypeId, :columbariumTypeId, :mainImage, :ownerId);";
        $statement = $con->prepare($query); 
        
        // Binding parameters
        // NON NULL params
        $statement->bindParam(':forSale', $columbariumData->forSale);
        
        $statement->bindParam(':sectionNumber', $columbariumData->sectionNumber);
        
        $statement->bindParam(':mainImage', $columbariumData->mainImage);
        
        $statement->bindParam(':sectionLetterId', $columbariumData->sectionLetterId);
        
        $statement->bindParam(':nicheTypeId', $columbariumData->nicheTypeId);
        
        $statement->bindParam(':columbariumTypeId', $columbariumData->columbariumTypeId);
        
        // Nullable data
        if(!isset($columbariumData -> ownerId)){
            $statement->bindValue(':ownerId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':ownerId', $columbariumData ->ownerId);
        }
        
        if(!isset($columbariumData -> price)){
            $statement->bindValue(':price', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':price', $columbariumData ->price);
        }
        
        if(!isset($columbariumData -> purchaseDate)){
            $statement->bindValue(':purchaseDate', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':purchaseDate', $columbariumData ->purchaseDate);
        }
        
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $columbariumId = $con->lastInsertId();
            $columbariumAttachmentsPromise = insertColumbariumAttachments($columbariumId, $columbariumData->attachedDocuments);
            if(count($columbariumAttachmentsPromise->error) > 0){
                $response->addError($columbariumAttachmentsPromise->error[0]);
            }
            $updateBIPromise = updateBuriedIndividualsColumbariumId($columbariumId, $columbariumData ->buriedIndividualIds);
            if(count($updateBIPromise->error) > 0){
                $response->addError($updateBIPromise->error[0]);
            }
            
            if(count($response->error) == 0){
                $response->addResult(true);
            }
        }
        else{
            $response -> addError("Failed to Insert Columbarium Data.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function insertBuriedIndividual(ToBuriedIndividualTable $buriedIndividual)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "INSERT INTO buried_individuals (FIRST_NAME, MIDDLE_NAME, LAST_NAME, MAIDEN_NAME, DOB, DOD, VETERAN, OBITUARY, NICKNAME) 
            VALUES (:firstName, :middleName, :lastName, :maidenName, :dob, :dod, :veteran, :obituary, :nickname);";
        $statement = $con->prepare($query);
        $statement->bindValue(':firstName', $buriedIndividual->firstName);
        if(!isset($buriedIndividual ->middleName))
        {
            $statement->bindValue(':middleName', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':middleName', $buriedIndividual->middleName);
        }
        $statement->bindValue(':lastName', $buriedIndividual->lastName);
        if(!isset($buriedIndividual ->maidenName))
        {
            $statement->bindValue(':maidenName', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':maidenName', $buriedIndividual->maidenName);
        }
        $statement->bindValue(':dob', $buriedIndividual->dob);
        $statement->bindValue(':dod', $buriedIndividual->dod);
        $statement->bindValue(':veteran', $buriedIndividual->veteran);
        if(!isset($buriedIndividual ->obituary))
        {
            $statement->bindValue(':obituary', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':obituary', $buriedIndividual->obituary);
        }
        if(!isset($buriedIndividual ->nickname))
        {
            $statement->bindValue(':nickname', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':nickname', $buriedIndividual->nickname);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else{
            $response->addError("Failed to insert Buried Individual.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function insertColumbariumType(ToTypeTable $type)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "INSERT INTO columbarium_types (TYPE)
                    VALUE (:columbariumType);";
        $statement = $con->prepare($query);
        $statement->bindValue(':columbariumType', $type->type);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {            
            $response->addResult(True);
        }
        else{
            $response->addError("Failed to insert Columbarium Type.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function insertOwner(ToOwnerTable $owner)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "INSERT INTO owners (FIRST_NAME, LAST_NAME, MIDDLE_NAME, ADDRESS, PHONE_NUMBER, EMAIL)
                    VALUES(:firstName, :lastName, :middleName, :address, :phoneNumber, :email);";
        $statement = $con->prepare($query);
        $statement->bindValue(':firstName', $owner->firstName);
        $statement->bindValue(':lastName', $owner->lastName);
        if(!isset($owner->middleName))
        {
            $statement->bindValue(':middleName', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':middleName', $owner->middleName);
        }
        if(!isset($owner->address))
        {
            $statement->bindValue(':address', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':address', $owner->address);
        }
        if(!isset($owner->phoneNumber))
        {
            $statement->bindValue(':phoneNumber', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':phoneNumber', $owner->phoneNumber);
        }
        if(!isset($owner->email))
        {
            $statement->bindValue(':email', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':email', $owner->email);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else{
            $response->addError("Failed to insert Owner.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function insertContact(ToContactTable $contact)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "INSERT INTO CONTACTS (FIRST_NAME, LAST_NAME, EMAIL, TITLE, PHONE_NUMBER)
                    VALUES (:firstName, :lastName, :email, :title, :phoneNumber);";
        $statement = $con->prepare($query);
        $statement->bindValue(':firstName', $contact->firstName);
        $statement->bindValue(':lastName', $contact->lastName);
        $statement->bindValue(':email', $contact->email);
        if(!isset($contact->title))
        {
            $statement->bindValue(':title', null, PDO::PARAM_NULL);
        }
        else
        {
            $statement->bindValue(':title', $contact->title);
        }
        $statement->bindValue(':phoneNumber', $contact->phoneNumber);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else{
            $response->addError("Failed to insert Contact.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function insertNicheType(ToTypeTable $nicheType)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "INSERT INTO niche_types (TYPE)
                    VALUE (:nicheType);";
        $statement = $con->prepare($query);
        $statement->bindValue(':nicheType', $nicheType->type);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to insert Niche Type");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function insertTombSectionLetter(ToSectionLetter $sectionLetter)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "INSERT INTO tomb_section_letters (SECTION_LETTER)
                    VALUE (:sectionLetter);";
        $statement = $con->prepare($query);
        $statement->bindValue(':sectionLetter', $sectionLetter->letter);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to insert a Lot Section Letter.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function insertColumbariumSectionLetter(ToSectionLetter $sectionLetter)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "INSERT INTO columbarium_section_letters (SECTION_LETTER)
                    VALUE (:sectionLetter);";
        $statement = $con->prepare($query);
        $statement->bindValue(':sectionLetter', $sectionLetter->letter);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to insert Columbarium Section Letter.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function insertAdmin(ToAdminTable $admin){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "INSERT INTO admins (FIRST_NAME, LAST_NAME, EMAIL, PASSWORD)
                VALUES (:firstName, :lastName, :email, :password);";
        $statement = $con->prepare($query);
        $statement->bindValue(':firstName', $admin->firstName);
        $statement->bindValue(':lastName', $admin->lastName);
        $statement->bindValue(':email', $admin->email);
        $statement->bindValue(':password', $admin->password);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to insert Admin.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}
