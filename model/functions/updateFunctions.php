<?php

/* 
 * All Model Update methods to be included in this file
 */
function updateBuriedIndividualsTombId($tombId, $buriedIndividualsIds){
    $response = new Response();
    if(!isset($buriedIndividualsIds) || count($buriedIndividualsIds) == 0){
        $response->addResult(true); // Do not bother trying to add an empty array
        return $response;
    }
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        
        $query = "UPDATE `buried_individuals` "
                . "SET buried_individuals.TOMB_ID = :tombId "
                . "WHERE "
                . "buried_individuals.ID IN (" . implode(',', $buriedIndividualsIds) .");";
        $statement = $con->prepare($query);
        if(!isset($tombId)){
            $statement->bindValue(':tombId', null, PDO::PARAM_NULL);
        }
        else{
           $statement->bindParam(':tombId', $tombId); 
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else{
            $response -> addError("Failed to link Buried Individuals with Tomb ID.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateBuriedIndividualsColumbariumId($columbariumId, $buriedIndividualsIds){
    $response = new Response();
    if(!isset($buriedIndividualsIds) || count($buriedIndividualsIds) == 0){
        $response->addResult(true); // Do not bother trying to add an empty array
        return $response;
    }
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        
        $query = "UPDATE `buried_individuals` "
                . "SET buried_individuals.COLUMBARIUM_ID = :columbariumId "
                . "WHERE "
                . "buried_individuals.ID IN (" . implode(',', $buriedIndividualsIds) .");";
        $statement = $con->prepare($query);
        if(!isset($columbariumId)){
            $statement->bindValue(':columbariumId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindParam(':columbariumId', $columbariumId);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else{
            $response -> addError("Failed to link Buried Individuals with Columbarium ID.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateBuriedIndividual(int $id, ToBuriedIndividualTable $buriedIndividual)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "UPDATE buried_individuals
                  SET FIRST_NAME=:firstName, MIDDLE_NAME= :middleName, LAST_NAME=:lastName, 
                  MAIDEN_NAME= :maidenName, DOB= :dob,VETERAN = :veteran, DOD= :dod, OBITUARY= :obituary, 
                  NICKNAME = :nickname
                  WHERE ID = :id;";
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
        if(!isset($buriedIndividual ->nickname))
        {
            $statement->bindValue(':nickname', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':nickname', $buriedIndividual->nickname);
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
        $statement->bindValue(":id", $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(True);
        }
        else
        {
            $response-> addError("Failed to update Buried Individual.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateOwner(int $id, ToOwnerTable $owner)
{
    $response= new Response();
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "UPDATE owners
                  SET FIRST_NAME = :firstName, LAST_NAME = :lastName, MIDDLE_NAME = :middleName, ADDRESS = :address, PHONE_NUMBER = :phoneNumber, EMAIL = :email
                  WHERE ID = :id;";
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
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else
        {
            $response ->addError("Failed to update Owner.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateContact(int $id, ToContactTable $contact)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "UPDATE CONTACTS
                  SET FIRST_NAME = :firstName, LAST_NAME = :lastName, EMAIL = :email, TITLE = :title, PHONE_NUMBER = :phoneNumber
                  WHERE ID = :id;";
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
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response-> addResult(True);
        }
        else
        {
            $response->addError("Failed to update contact");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateTomb($id, ToTableTomb $tomb){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "UPDATE tombs
                  SET FOR_SALE = :forSale, HAS_OPEN_PLOTS = :hasOpenPlots, 
                  PURCHASE_DATE = :purchaseDate, PRICE = :price, 
                  LONGITUDE = :longitude, LATITUDE = :latitude,
                  MAIN_IMAGE = IFNull(:mainImage, MAIN_IMAGE),
                  OWNER_ID = :ownerId, PLOT_NUMS = :plotNums, NOTES = :notes
                  WHERE ID = :id;";
        $statement = $con->prepare($query);
        $statement->bindValue(':forSale', $tomb->forSale);
        $statement->bindValue(':hasOpenPlots', $tomb->hasOpenPlots);
        $statement->bindValue(':longitude', $tomb->longitude);
        $statement->bindValue(':latitude', $tomb->latitude);
        if(!isset($tomb->purchaseDate)){
            $statement->bindValue(':purchaseDate', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':purchaseDate', $tomb->purchaseDate);
        }
        if(!isset($tomb->mainImage)){
            $statement->bindValue(':mainImage', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':mainImage', $tomb->mainImage);
        }
        if(!isset($tomb->price)){
            $statement->bindValue(':price', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':price', $tomb->price);
        }
        if(!isset($tomb->ownerId)){
            $statement->bindValue(':ownerId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':ownerId', $tomb->ownerId);
        }
        if(!isset($tomb->plotNums)){
            $statement->bindValue(':plotNums', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':plotNums', $tomb->plotNums);
        }
        if(!isset($tomb->notes)){
            $statement->bindValue(':notes', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':notes', $tomb->notes);
        }
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success){
            $tombAttachmentsPromise = insertTombAttachments($id, $tomb->attachedDocuments);
            if(count($tombAttachmentsPromise->error) > 0){
                $response->addError($tombAttachmentsPromise->error[0]);
            }
            $updateBIPromise = updateBuriedIndividualsTombId($id, $tomb ->buriedIndividualIds);
            if(count($updateBIPromise->error) > 0){
                $response->addError($updateBIPromise->error[0]);
            }
            
            if(count($response->error) == 0){
                $response->addResult(true);
            }
        }
        else{
            $response->addError("Failed to update Lot.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateColumbarium($id, ToTableColumbarium $columbarium){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "UPDATE columbarium
                  SET FOR_SALE = :forSale, 
                  PURCHASE_DATE = :purchaseDate, PRICE = :price,
                  MAIN_IMAGE = IFNull(:mainImage, MAIN_IMAGE),
                  OWNER_ID = :ownerId
                  WHERE ID = :id;";
        $statement = $con->prepare($query);
        $statement->bindValue(':forSale', $columbarium->forSale);
        if(!isset($columbarium->purchaseDate)){
            $statement->bindValue(':purchaseDate', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':purchaseDate', $columbarium->purchaseDate);
        }
        if(!isset($columbarium->mainImage)){
            $statement->bindValue(':mainImage', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':mainImage', $columbarium->mainImage);
        }
        if(!isset($columbarium->price)){
            $statement->bindValue(':price', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':price', $columbarium->price);
        }
        if(!isset($columbarium->ownerId)){
            $statement->bindValue(':ownerId', null, PDO::PARAM_NULL);
        }
        else{
            $statement->bindValue(':ownerId', $columbarium->ownerId);
        }
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success){
            $columbariumAttachmentsPromise = insertColumbariumAttachments($id, $columbarium->attachedDocuments);
            if(count($columbariumAttachmentsPromise->error) > 0){
                $response->addError($columbariumAttachmentsPromise->error[0]);
            }
            $updateBIPromise = updateBuriedIndividualsColumbariumId($id, $columbarium ->buriedIndividualIds);
            if(count($updateBIPromise->error) > 0){
                $response->addError($updateBIPromise->error[0]);
            }
            
            if(count($response->error) == 0){
                $response->addResult(true);
            }
        }
        else{
            $response->addError("Failed to update Columbarium.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateAdmin(int $id, ToAdminTable $admin)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "UPDATE admins
                  SET FIRST_NAME = :firstName, LAST_NAME = :lastName, EMAIL = :email
                  WHERE ID = :id;";
        $statement = $con->prepare($query);
        $statement->bindValue(':firstName', $admin->firstName);
        $statement->bindValue(':lastName', $admin->lastName);
        $statement->bindValue(':email', $admin->email);
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to update admin");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateAdminPassword(int $id, $password)
{
    $response = new Response();
    try{
        $db = connection::getinstance();
        $con = $db->get_connection();
        $query = "UPDATE ADMINS
                  SET PASSWORD = :password
                  WHERE ID = :id;";
        $statement = $con->prepare($query);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response ->addResult(True);
        }
        else
        {
            $response->addError("Failed to update password");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateAccessibleModule(ToTableAccessibleModules $module){
    $response = new Response();
    try{
        $db = connection::getinstance();
        $con = $db->get_connection();
        $query = "UPDATE accessible_modules
                  SET GUEST_ACCESS = :guestAccess
                  WHERE MODULE = :module;";
        $statement = $con->prepare($query);
        $statement->bindValue(':module', $module->module);
        $statement->bindValue(':guestAccess', $module->guestAccess);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response ->addResult(True);
        }
        else
        {
            $response->addError("Failed to update Accessible Module");
            $response->addResult(false);
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
        $response->addResult(false);
    }
    return $response;
}