<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

// Include all of our mapping classes
include 'requireMappingClasses.php';

// Include Test cases
include '../tests/modelTests.php';

// OUR MAIN CONTACT WITH DATABASE
include 'requireModel.php';

if (isset ($_POST['action']))
{
    $action = $_POST['action'];
}
else if (isset ($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    // variable to set active status in navbar
    $homeActive = true;
    include '../View/includes/head.php';
    include '../View/includes/navbar.php';
    include '../view/home/home.php';
    exit();
}

switch ($action)
{
    case"directToHomePage":
        // variable to set active status in navbar
        $homeActive = true;
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/home/home.php';
        break;
    case"directToAdministrationPage":
        // variable to set active status in navbar
        $administrationActive = true;
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/administration.php';
        break;
    case"directToContactUsPage":
        $contactUsActive = true;
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/contactUs/contactUs.php';
        break;
    case"directToAddTombPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../View/tomb/addTomb/addTomb.php';
        break;
    case"directToOwnersPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/owners/owners.php';
        break;
    case"directToBuriedIndividualsPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../View/administration/buriedIndividuals/buriedIndividuals.php';
        break;
    case"directToListControlsPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/editLists/editLists.php';
        break;
    case"directToAddNewAdminPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/addNewAdmin/addNewAdmin.php';
        break;
    case"directToLoginPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/login/login.php';
        break;
    case"directToSearchTombPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/tomb/searchTomb/searchTomb.php';
        break;
    case"directToContactsPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/contacts/contacts.php';
        break;
    case"directToEditContactPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/contacts/editContact/editContact.php';
        break;
    case"directToEditOwnerPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/owners/editOwner/editOwner.php';
        break;
    case"directToAddColumbariumPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/columbarium/addColumbarium/addColumbarium.php';
        break;
    case"directToSearchColumbariumPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/columbarium/searchColumbarium/searchColumbarium.php';
        break;
    case"directToEditBuriedIndividualPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/buriedIndividuals/editBuriedIndividual/editBuriedIndividual.php';
        break;
    case"directToViewTombPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/tomb/viewTomb/viewTomb.php';
        break;
    case"directToViewColumbariumPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/columbarium/viewColumbarium/viewColumbarium.php';
        break;
    //API
    case"fetchAllOwnersList":
        fetchAllOwnersList();
        break;
    case"fetchUnlinkedBuriedIndividualsList":
        fetchUnlinkedBuriedIndividualsList();
        break;
    case"fetchColumbariumSectionLettersList":
        fetchColumbariumSectionLettersList();
        break;
    case"fetchNicheTypesList":
        fetchNicheTypesList();
        break;
    case"fetchColumbariumTypesList":
        fetchColumbariumTypesList();
        break;
    case"fetchTombSectionLettersList":
        fetchTombSectionLettersList();
        break;
    case"fetchAllBuriedIndividualsList":
        fetchAllBuriedIndividualsList();
        break;
    case"fetchTombCards":
        fetchTombCards();
        break;
    case"fetchColumbariumCards":
        fetchColumbariumCards();
        break;
    case"fetchTombById":
        fetchTombById();
        break;
    case"fetchColumbariumById":
        fetchColumbariumById();
        break;
    case"addTomb":
        addTomb();
        break;
    case"addColumbarium":
        addColumbarium();
        break;
    case"addBuriedIndividual":
        addBuriedIndividual();
        break;
    case"addOwner":
        addOwner();
        break;
    case"addColumbariumType":
        addColumbariumType();
        break;
    case"addNicheType":
        addNicheType();
        break;
}
//-----API--------
function fetchAllOwnersList(){
    $mutatedResponse = new Response();
    $response = getAllOwners();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->firstName . " " . $response->result[$i]->lastName
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchUnlinkedBuriedIndividualsList(){
    $mutatedResponse = new Response();
    $response = getUnlinkedBuriedIndividuals();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->firstName 
                    . " " . 
                    $response->result[$i]->lastName 
                    . (isset($response->result[$i]->nickname)? " (" . $response->result[$i]->nickname . ")" : "")
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchColumbariumSectionLettersList(){
    $mutatedResponse = new Response();
    $response = getAllColumbariumSectionLetters();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->letter
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchNicheTypesList(){
    $mutatedResponse = new Response();
    $response = getAllNicheTypes();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->type
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchColumbariumTypesList(){
    $mutatedResponse = new Response();
    $response = getAllColumbariumTypes();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->type
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchTombSectionLettersList(){
    $mutatedResponse = new Response();
    $response = getAllTombSectionLetters();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->letter
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchAllBuriedIndividualsList(){
    $mutatedResponse = new Response();
    $response = getAllBuriedIndividuals();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->firstName 
                    . " " . 
                    $response->result[$i]->lastName
                    . (isset($response->result[$i]->nickname)? " (" . $response->result[$i]->nickname . ")" : "")
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchTombCards(){
    $request = json_decode($_GET['request']);
    
    $sectionLetterId = !empty($request->sectionLetterId) ? $request->sectionLetterId : null;
    $lotNumber = !empty($request->lotNumber) ? $request->lotNumber : null;
    $hasOpenPlots = !empty($request->hasOpenPlots) ? $request->hasOpenPlots : null;
    $forSale = !empty($request->forSale) ? $request->forSale : null;
    $ownerId = !empty($request->ownerId) ? $request->ownerId : null;
    $buriedIndividualIds = !empty($request->buriedIndividualIds) ? $request->buriedIndividualIds : null;
    
    $filter = new TombFilter();
    $filter->setSectionLetterId($sectionLetterId);
    $filter->setLotNumber($lotNumber);
    $filter->setHasOpenPlots($hasOpenPlots);
    $filter->setForSale($forSale);
    $filter->setOwnerId($ownerId);
    $filter->setBuriedIndividualIds($buriedIndividualIds);
    
    $mutatedResponse = new Response();
    $response = getAllTombRelatedDataWithFilter($filter);
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            
            $mutatedResult = array(
                "id" => $response->result[$i]->id,
                "title" => $response->result[$i]->sectionLetter->letter . " " . $response->result[$i]->lotNumber,
                "countBuriedIndividuals" => 
                    isset($response->result[$i]->buriedIndividuals)? 
                    count($response->result[$i]->buriedIndividuals): 0,
                "forSale" => $response->result[$i]->forSale,
                "latitude" => $response->result[$i]->latitude,
                "longitude" => $response->result[$i]->longitude,
                "ownerName" => 
                    isset($response->result[$i]->owner->id)? 
                    $response->result[$i]->owner->firstName . " " . $response->result[$i]->owner->lastName : "N/A",
                "image" => $response->result[$i]->mainImage,
                "buriedIndividualNames" => isset($response->result[$i]->buriedIndividuals) ? 
                    array_map(function($o) { 
                        return $o->firstName . " " . $o->lastName;
                        
                    }, $response->result[$i]->buriedIndividuals) 
                    : array() 
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchColumbariumCards(){
    $request = json_decode($_GET['request']);
    
    $columbariumTypeId = !empty($request->columbariumTypeId) ? $request->columbariumTypeId : null;
    $nicheTypeId = !empty($request->nicheTypeId) ? $request->nicheTypeId : null;
    $sectionLetterId = !empty($request->sectionLetterId) ? $request->sectionLetterId : null;
    $sectionNumber = !empty($request->sectionNumber) ? $request->sectionNumber : null;
    $forSale = !empty($request->forSale) ? $request->forSale : null;
    $ownerId = !empty($request->ownerId) ? $request->ownerId : null;
    $buriedIndividualIds = !empty($request->buriedIndividualIds) ? $request->buriedIndividualIds : null;
    
    $filter = new ColumbariumFilter();
    $filter->setColumbariumTypeId($columbariumTypeId);
    $filter->setNicheTypeId($nicheTypeId);
    $filter->setSectionLetterId($sectionLetterId);
    $filter->setSectionNumber($sectionNumber);
    $filter->setForSale($forSale);
    $filter->setOwnerId($ownerId);
    $filter->setBuriedIndividualIds($buriedIndividualIds);
    
    $mutatedResponse = new Response();
    $response = getAllColumbariumRelatedDataWithFilter($filter);
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            
            $mutatedResult = array(
                "id" => $response->result[$i]->id,
                "columbarium" => $response->result[$i]->columbariumType->type,
                "title" => $response->result[$i]->nicheType->type . " - " . 
                           $response->result[$i]->sectionLetter->letter . " " . 
                           $response->result[$i]->sectionNumber,
                "forSale" => $response->result[$i]->forSale,
                "buriedIndividualsCount" => 
                    isset($response->result[$i]->buriedIndividuals)? 
                    count($response->result[$i]->buriedIndividuals): 0,
                "ownerName" => 
                    isset($response->result[$i]->owner->id)? 
                    $response->result[$i]->owner->firstName . " " . $response->result[$i]->owner->lastName : "N/A",
                "image" => $response->result[$i]->mainImage,
                "buriedIndividualNames" => isset($response->result[$i]->buriedIndividuals) ? 
                    array_map(function($o) { 
                        return $o->firstName . " " . $o->lastName;
                        
                    }, $response->result[$i]->buriedIndividuals) 
                    : array() 
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchTombById(){
    $id = $_GET['id'];
    
    $filter = new TombFilter();
    $filter->setTombId($id);
    $response = new Response();
    
    $modelResponse = getAllTombRelatedDataWithFilter($filter);
    
    foreach($modelResponse->error as $error){
        $response->addError($error);
    }
    
    // There should only be one result so that loop should actually execute once
    foreach($modelResponse->result as $result){
        $mutatedResult = array(
            "id" => $result->id,
            "location" =>$result->sectionLetter->letter . " " .$result->lotNumber,
            "hasOpenPlots" =>$result->hasOpenPlots,
            "forSale" => $result->forSale,
            "purchaseDate" => $result->purchaseDate,
            "price" => $result->price,
            "mainImage" => $result->mainImage,
            "attachments" => isset($result->attachments) ?
                array_map(function($attachment) { 
                    $attachmentArr = explode('/', $attachment->link);
                    return array(
                        "id" => $attachment->id,
                        "link" => $attachment->link,
                        "name" => end($attachmentArr)
                    );
                }, $result->attachments) 
                : array(),
            "owner" => isset($result->owner->id) ? $result->owner : null,
            "buriedIndividuals" => isset($result->buriedIndividuals)? $result->buriedIndividuals : [],
            "longitude" => $result->longitude,
            "latitude" => $result->latitude            
        );
        $response->addResult($mutatedResult);
    }
    
    echo json_encode(get_object_vars($response));
}

function fetchColumbariumById(){
    $id = $_GET['id'];
    
    $filter = new ColumbariumFilter();
    $filter->setColumbariumId($id);
    $response = new Response();
    
    $modelResponse = getAllColumbariumRelatedDataWithFilter($filter);
    
    foreach($modelResponse->error as $error){
        $response->addError($error);
    }
    
    // There should only be one result so that loop should actually execute once
    foreach($modelResponse->result as $result){
        $mutatedResult = array(
            "id" => $result->id,
            "location" =>$result->columbariumType->type . " - " .$result->nicheType->type . " - " . $result->sectionLetter->letter . " " . $result->sectionNumber,
            "forSale" => $result->forSale,
            "purchaseDate" => $result->purchaseDate,
            "price" => $result->price,
            "mainImage" => $result->mainImage,
            "attachments" => isset($result->attachments) ?
                array_map(function($attachment) { 
                    $attachmentArr = explode('/', $attachment->link);
                    return array(
                        "id" => $attachment->id,
                        "link" => $attachment->link,
                        "name" => end($attachmentArr)
                    );
                }, $result->attachments) 
                : array(),
            "owner" => isset($result->owner->id) ? $result->owner : null,
            "buriedIndividuals" => isset($result->buriedIndividuals)? $result->buriedIndividuals : []           
        );
        $response->addResult($mutatedResult);
    }
    
    echo json_encode(get_object_vars($response));
}

function addTomb(){
    $response = new Response();
    
    
   
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $sectionLetterId = !empty($data->sectionLetterId) ? $data->sectionLetterId : null;
    $lotNumber = !empty($data->lotNumber) ? $data->lotNumber : null;
    $price = !empty($data->price) ? $data->price : null;
    $forSale = !empty($data->forSale) ? $data->forSale : null;
    $hasOpenPlots = !empty($data->hasOpenPlots) ? $data->hasOpenPlots : null;
    $purchaseDate = !empty($data->purchaseDate) ? $data->purchaseDate : null;
    $ownerId = !empty($data->ownerId) ? $data->ownerId : null;
    $buriedIndividualIds = !empty($data->buriedIndividualIds) ? $data->buriedIndividualIds : null;
    $longitude = !empty($data->longitude) ? $data->longitude : null;
    $latitude = !empty($data->latitude) ? $data->latitude : null;
    
    // Validating data before calling method to add
    
    if(!isset($sectionLetterId)){
        $response->addError("Section Letter must be specified.");
    }
    if(!isset($lotNumber) || !is_numeric($lotNumber) || (is_numeric($lotNumber) && $lotNumber < 0)){
        $response->addError("Lot Number must be specified.");
    }
    // Meaning, lot Number and section Letter ID are specified
    if(empty($response->error)){
        $tombExistResponse = checkTombExists($sectionLetterId, $lotNumber);
        if(empty($tombExistResponse->error) && !empty($tombExistResponse->result)){
            // If tomb exists
            if($tombExistResponse->result[0])
                $response->addError("A lot already exists with the same Section Letter and lotNumber.");
        }
        else{
            $response->addError($tombExistResponse->error[0]);
        }
    }

    if(isset($price) && (!is_numeric($price) || $price < 0)){
        $response->addError("Price must be of positive numerical value or left empty.");
    }
    if($forSale){
        if(isset($purchaseDate))
            $response->addError("A lot that is for sale can not have a purchase date.");
        if(isset($buriedIndividualIds) && count($buriedIndividualIds) > 0)
            $response->addError ("A lot that is for sale can not have buried individuals associated.");
        if(isset($ownerId))
            $response->addError ("A lot that is for sale can not have an owner associated.");
    }
    else{
        if(!isset($ownerId))
            $response->addError ("A lot that is NOT for sale MUST have an owner associated.");
    }
    if(!isset($longitude) || !isset($latitude)){
        $response->addError ("All Lots must be plotted on the map.");
    }
    
    //If all the data is validated, upload the attached documents
    if(empty($response->error)){
        // Upload the mainImage and attachedDocuments
        $mainImagePath = processMainImageUpload($response)?: "../assets/images/Knox_Head_Stones.jpg";
        $attachedDocumentsPaths = processAttachedDocumentsUpload($response);
        
        // If there are no problems with file uploading, process request
        if(empty($response->error)){
            //Prepare toTableTomb object
            $obj = new ToTableTomb(
                    $sectionLetterId,
                    $lotNumber,
                    $price,
                    $mainImagePath,
                    $forSale,
                    $hasOpenPlots,
                    $purchaseDate,
                    $ownerId,
                    $longitude,
                    $latitude,
                    $attachedDocumentsPaths,
                    $buriedIndividualIds
            );
            $modelResponse = insertAllTombRelatedData($obj);
            for($i = 0; $i< count($modelResponse->error); $i++){
                $response->addError($modelResponse->error[$i]);
            }
            
            if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
                $response->addResult($modelResponse->result[0]);
            }
            
        }
    }
    echo json_encode(get_object_vars($response));
}

// Helper Function for add Tomb and add Columbarium
function processMainImageUpload(&$response){
    if(array_key_exists("mainImage", $_FILES)){
        $targetDir = "../assets/images/uploadedImages/";
        $file = $_FILES['mainImage']['name'];
	$path = pathinfo($file);
	$filename = $path['filename'];
	$ext = $path['extension'];
        $temp_name = $_FILES['mainImage']['tmp_name'];
	$mainImagePath = $targetDir.$filename.".".$ext;
        if (file_exists($mainImagePath)) {
            $response ->addError("A main image already exsist with the same name. Please rename the image and upload again.");
        }
        else{
            move_uploaded_file($temp_name,$mainImagePath);
        }      
    }
    else{
        // Set To null
        $mainImagePath = null;
    }
    
    return $mainImagePath;
}

// Helper Function for add Tomb and add Columbarium
function processAttachedDocumentsUpload(&$response){
    // Attached Documents
    $attachedDocuments = array();
    if(array_key_exists("attachedDocuments", $_FILES)){
        for($i = 0; $i< count($_FILES['attachedDocuments']['name']); $i ++){
            $targetDir = "../assets/attachedFiles/";
            $file = $_FILES['attachedDocuments']['name'][$i];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['attachedDocuments']['tmp_name'][$i];
            $documentPath = $targetDir.$filename.".".$ext;
            if (file_exists($documentPath)) {
                $response ->addError($filename . " already exists. Please rename the file and upload again.");
            }
            else{
                move_uploaded_file($temp_name,$documentPath);
                array_push($attachedDocuments, $documentPath);
            }
        }
    }
    else{
        $attachedDocuments = null;
    }
    
    return $attachedDocuments;
}

function addColumbarium(){
    $response = new Response();
    
    
   
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $columbariumTypeId = !empty($data->columbariumTypeId) ? $data->columbariumTypeId : null;
    $nicheTypeId = !empty($data->nicheTypeId) ? $data->nicheTypeId : null;
    $sectionLetterId = !empty($data->sectionLetterId) ? $data->sectionLetterId : null;
    $sectionNumber = !empty($data->sectionNumber) ? $data->sectionNumber : null;
    $price = !empty($data->price) ? $data->price : null;
    $forSale = !empty($data->forSale) ? $data->forSale : null;
    $purchaseDate = !empty($data->purchaseDate) ? $data->purchaseDate : null;
    $ownerId = !empty($data->ownerId) ? $data->ownerId : null;
    $buriedIndividualIds = !empty($data->buriedIndividualIds) ? $data->buriedIndividualIds : null;

    // Request Validation
    if(!isset($sectionLetterId)){
        $response->addError("Section Letter must be specified.");
    }
    if(!isset($columbariumTypeId)){
        $response->addError("Columbarium Type must be specified.");
    }
    if(!isset($nicheTypeId)){
        $response->addError("Niche Type must be specified.");
    }
    if(!isset($sectionNumber) || !is_numeric($sectionNumber) || (is_numeric($sectionNumber) && $sectionNumber < 0)){
        $response->addError("Section Number must be specified.");
    }
    
    // Check for duplicates
    if(empty($response->error)){
        $columbariumExistResponse = checkColumbariumExists($columbariumTypeId, $nicheTypeId, $sectionLetterId, $sectionNumber);
        if(empty($columbariumExistResponse->error) && !empty($columbariumExistResponse->result)){
            // If columbarium exists
            if($columbariumExistResponse->result[0])
                $response->addError("A Columbarium already exists in the same location.");
        }
        else{
            $response->addError($columbariumExistResponse->error[0]);
        }
    }
 
    if(isset($price) && (!is_numeric($price) || $price < 0)){
        $response->addError("Price must be of positive numerical value or left empty.");
    }
    if($forSale){
        if(isset($purchaseDate))
            $response->addError("A Columbarium that is for sale can not have a purchase date.");
        if(isset($buriedIndividualIds) && count($buriedIndividualIds) > 0)
            $response->addError ("A Columbarium that is for sale can not have buried individuals associated.");
        if(isset($ownerId))
            $response->addError ("A Columbarium that is for sale can not have an owner associated.");
    }
    else{
        if(!isset($ownerId))
            $response->addError ("A Columbarium that is NOT for sale MUST have an owner.");
    }
    
    //If all the data is validated, upload the attached documents
    if(empty($response->error)){
        // Upload the mainImage and attachedDocuments
        $mainImagePath = processMainImageUpload($response)?: "../assets/images/Knox_Mausoleum.jpg";
        $attachedDocumentsPaths = processAttachedDocumentsUpload($response);
        
        // If there are no problems with file uploading, process request
        if(empty($response->error)){
            //Prepare toTableTomb object
            $obj = new ToTableColumbarium(
                    $columbariumTypeId,
                    $nicheTypeId,
                    $sectionLetterId,
                    $sectionNumber,
                    $mainImagePath,
                    $price,
                    $forSale,
                    $purchaseDate,
                    $ownerId,
                    $attachedDocumentsPaths,
                    $buriedIndividualIds
            );
            $modelResponse = insertAllColumbariumRelatedData($obj);
            for($i = 0; $i< count($modelResponse->error); $i++){
                $response->addError($modelResponse->error[$i]);
            }
            
            if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
                $response->addResult($modelResponse->result[0]);
            }
            
        }
    }
    echo json_encode(get_object_vars($response));
}

function addBuriedIndividual(){
    $response = new Response();
   
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $middleName = !empty($data->middleName) ? $data->middleName : null;
    $maidenName = !empty($data->maidenName) ? $data->maidenName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $nickname = !empty($data->nickname) ? $data->nickname : null;
    $dob = !empty($data->dob) ? $data->dob : null;
    $dod = !empty($data->dod) ? $data->dod : null;
    $veteran = !empty($data->veteran) ? $data->veteran : null;
    $obituary = !empty($data->obituary) ? $data->obituary : null;
    
    if(!isset($firstName) || strlen($firstName) < 1){
        $response->addError("First Name must be set.");
    }
    if(!isset($lastName) || strlen($lastName) < 1){
        $response->addError("Last Name must be set.");
    }
    if(!isset($dob)){
        $response->addError("Date of Birth must be set.");
    }
    if(!isset($dod)){
        $response->addError("Date of Death must be set.");
    }
    
    if(empty($response->error)){
        $obj = new ToBuriedIndividualTable(
            $firstName, 
            $middleName, 
            $maidenName, 
            $lastName,
            $dob, 
            $dod, 
            $veteran, 
            $obituary,
            $nickname
        );
        $modelResponse = insertBuriedIndividual($obj);
        for($i = 0; $i< count($modelResponse->error); $i++){
            $response->addError($modelResponse->error[$i]);
        }

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function addOwner(){
    $response = new Response();
   
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $middleName = !empty($data->middleName) ? $data->middleName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $address = !empty($data->address) ? $data->address : null;
    $phoneNumber = !empty($data->phoneNumber) ? $data->phoneNumber : null;
    $email = !empty($data->email) ? $data->email : null;
    
    if(!isset($firstName) || strlen($firstName) < 1){
        $response->addError("First Name must be set.");
    }
    if(!isset($lastName) || strlen($lastName) < 1){
        $response->addError("Last Name must be set.");
    }
    if(isset($phoneNumber)){
        if(!is_numeric($phoneNumber)){
            $response->addError("Phone number must consist of numbers only.");
        }
        if(strlen($phoneNumber) != 10){
            $response->addError("Only US phone numbers of 10 digits are accepted.");
        }
        // If phone number is valid, add +1 to the beginning of the string.
        if(empty($response->error)){
            $phoneNumber = "+1" . $phoneNumber;
        }
    }
    if (isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response->addError("Invalid email address.");
    }
    
    if(empty($response->error)){
        $obj = new ToOwnerTable(
            $firstName, 
            $lastName,
            $middleName,
            $address,
            $phoneNumber,
            $email
        );
        $modelResponse = insertOwner($obj);
        for($i = 0; $i< count($modelResponse->error); $i++){
            $response->addError($modelResponse->error[$i]);
        }

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function addColumbariumType(){
    $response = new Response();
   
    // Getting REQUEST data
    $data = json_decode($_POST['request']);
    $type = !empty($data->columbariumType) ? $data->columbariumType : null;
    
    if(!isset($type) || strlen($type) < 1){
        $response->addError("Columbarium Type must be of a valid value.");
    }
    
    if(empty($response->error)){
        $obj = new ToTypeTable($type);
        $modelResponse = insertColumbariumType($obj);
        for($i = 0; $i< count($modelResponse->error); $i++){
            $response->addError($modelResponse->error[$i]);
        }

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function addNicheType(){
    $response = new Response();
   
    // Getting REQUEST data
    $data = json_decode($_POST['request']);
    $type = !empty($data->nicheType) ? $data->nicheType : null;
    
    if(!isset($type) || strlen($type) < 1){
        $response->addError("Niche Type must be of a valid value.");
    }
    
    if(empty($response->error)){
        $obj = new ToTypeTable($type);
        $modelResponse = insertNicheType($obj);
        for($i = 0; $i< count($modelResponse->error); $i++){
            $response->addError($modelResponse->error[$i]);
        }

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}
