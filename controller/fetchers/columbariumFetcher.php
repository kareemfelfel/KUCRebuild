<?php

/* 
 * All Columbarium Related fetchers
 */

function fetchColumbariumCards(){
    $request = json_decode($_GET['request']);
    
    $columbariumTypeId = !empty($request->columbariumTypeId) ? $request->columbariumTypeId : null;
    $nicheTypeId = !empty($request->nicheTypeId) ? $request->nicheTypeId : null;
    $sectionLetterId = !empty($request->sectionLetterId) ? $request->sectionLetterId : null;
    $sectionNumber = !empty($request->sectionNumber) ? $request->sectionNumber : null;
    $forSale = !empty($request->forSale) ? $request->forSale : null;
    $ownerId = !empty($request->ownerId) ? $request->ownerId : null;
    $buriedIndividualIds = !empty($request->buriedIndividualIds) ? $request->buriedIndividualIds : null;
    $buriedIndividualVeteranStatus = !empty($request->buriedIndividualVeteranStatus) ? $request->buriedIndividualVeteranStatus : null;
    
    $filter = new ColumbariumFilter();
    $filter->setColumbariumTypeId($columbariumTypeId);
    $filter->setNicheTypeId($nicheTypeId);
    $filter->setSectionLetterId($sectionLetterId);
    $filter->setSectionNumber($sectionNumber);
    $filter->setForSale($forSale);
    $filter->setOwnerId($ownerId);
    $filter->setBuriedIndividualIds($buriedIndividualIds);
    $filter->setBuriedIndividualVeteranStatus($buriedIndividualVeteranStatus);
    
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
            // ONLY return what the guest needs
            if($_SESSION['user']->userType == UserType::GUEST){
                unset($mutatedResult['ownerName']);
            }
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    $mutatedResponse->setError($response->error);
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchColumbariumById(){
    $id = $_GET['id'];
    
    $filter = new ColumbariumFilter();
    $filter->setColumbariumId($id);
    $response = new Response();
    
    $modelResponse = getAllColumbariumRelatedDataWithFilter($filter);
    
    $response->setError($modelResponse->error);
    
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
        // ONLY return what the guest needs
        if($_SESSION['user']->userType == UserType::GUEST){
            unset($mutatedResult['owner']);
            unset($mutatedResult['attachments']);
            unset($mutatedResult['price']);
        }
        $response->addResult($mutatedResult);
    }
    
    echo json_encode(get_object_vars($response));
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
        $response->addError("Level must be specified.");
    }
    if(!isset($sectionNumber) || !is_numeric($sectionNumber) || (is_numeric($sectionNumber) && $sectionNumber < 0)){
        $response->addError("Niche Number must be specified.");
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
        // This will contain a list of all the documents that need uploaded. Once confirmed
        // That no errors exist at all, files will be uploaded
        $filesToUpload = array();
        // Processes upload file names and location but Does NOT actually upload
        $mainImagePath = processMainImageUpload($response, $filesToUpload)?: "../assets/images/Knox_Mausoleum.jpg";
        $attachedDocumentsPaths = processAttachedDocumentsUpload($response, $filesToUpload);
        commitUploadFiles($response, $filesToUpload);
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
            $response->setError($modelResponse->error);
            
            if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
                $response->addResult($modelResponse->result[0]);
            }
            
        }
    }
    echo json_encode(get_object_vars($response));
}

function editColumbarium(){
    $id = $_GET['id'];
    $response = new Response();
 
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $price = !empty($data->price) ? $data->price : null;
    $forSale = !empty($data->forSale) ? $data->forSale : null;
    $purchaseDate = !empty($data->purchaseDate) ? $data->purchaseDate : null;
    $ownerId = !empty($data->ownerId) ? $data->ownerId : null;
    $buriedIndividualIds = !empty($data->buriedIndividualIds) ? $data->buriedIndividualIds : null;
    
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
    
    if(empty($response->error)){
        // This will contain a list of all the documents that need uploaded. Once confirmed
        // That no errors exist at all, files will be uploaded
        $filesToUpload = array();
        // Upload the mainImage and attachedDocuments
        $mainImagePath = processMainImageUpload($response, $filesToUpload);
        $attachedDocumentsPaths = processAttachedDocumentsUpload($response, $filesToUpload);
        commitUploadFiles($response, $filesToUpload);
        // If there are no problems with file uploading, process request
        if(empty($response->error)){
            //Prepare toTableTomb object
            $obj = new ToTableColumbarium(
                    0, // Col Type, Niche Type, Section Letter, and Section Numbers can not be altered
                    0,
                    0,
                    0,
                    $mainImagePath,
                    $price,
                    $forSale,
                    $purchaseDate,
                    $ownerId,
                    $attachedDocumentsPaths,
                    $buriedIndividualIds
            );
            $modelResponse = updateColumbarium($id, $obj);
            $response->setError($modelResponse->error);
            $response->setResult($modelResponse->result);  
        }
    }
    echo json_encode(get_object_vars($response));
}

function unlinkColumbariumBuriedIndividual(){
    $buriedIndividualId = $_GET['buriedIndividualId'];
    $response = new Response();
    if(!isset($buriedIndividualId)){
        $response->addError("Buried Individual ID must be specified.");
    }
    else{
        $arrayId = array($buriedIndividualId);
    }
    
    if(empty($response->error)){
        $modelResponse = updateBuriedIndividualsColumbariumId(null, $arrayId);
        $response->setError($modelResponse->error);
        $response->setResult($modelResponse->result);
    }
    
    echo json_encode(get_object_vars($response));
}

function deleteColumbariumAttachment(){
    $columbariumId = $_GET['columbariumId'];
    $link = $_GET['link'];
    $response = new Response();
    
    if(!isset($columbariumId)){
        $response->addError("Columbarium ID must be specified.");
    }
    if(!isset($link)){
        $response->addError("Attachment link must be specified.");
    }
    
    if(empty($response->error)){
        if(unlink($link)){
            $modelResponse = deleteAttachmentForColumbarium($columbariumId, $link);
            $response->setResult($modelResponse->result);
            $response->setError($modelResponse->error);
        }
        else{
            $response->addError("Failed to Remove the Attachment from the server.");
        }
    }
    
    echo json_encode(get_object_vars($response));
}

function editExistingColumbariumSetForSale(){
    $id = !empty($_GET['id']) ? $_GET['id'] : null;
    $response = new Response();
    if(isset($id)){
        $biResponse = updateBuriedIndividualsClearColumbariumId($id);
        $forSaleResponse = updateColumbariumClearOwnerAndSetForSale($id);
        
        if(empty($biResponse->error) && empty($forSaleResponse->error)){
            $response->addResult(true);
        }
        else{
            $response->addError("Failed to set Columbarium to for sale.");
        }
    }
    else{
        $response->addError("ID is not specified.");
    }
    
    echo json_encode(get_object_vars($response));
}

function processDeleteColumbarium(){
    $id = $_GET['id'];
    $response = deleteColumbarium($id);
    echo json_encode(get_object_vars($response));
}