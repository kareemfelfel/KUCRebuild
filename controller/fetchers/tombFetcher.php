<?php

/* 
 * All Tomb related fetchers
 */

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
    $mutatedResponse->setError($response->error);
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchTombById(){
    $id = $_GET['id'];
    
    $filter = new TombFilter();
    $filter->setTombId($id);
    $response = new Response();
    
    $modelResponse = getAllTombRelatedDataWithFilter($filter);
    
    $response->setError($modelResponse->error);
    
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
            $response->setError($modelResponse->error);
            
            if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
                $response->addResult($modelResponse->result[0]);
            }
            
        }
    }
    echo json_encode(get_object_vars($response));
}
function editTomb(){
    $id = $_GET['id'];
    $response = new Response();
 
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $price = !empty($data->price) ? $data->price : null;
    $forSale = !empty($data->forSale) ? $data->forSale : null;
    $hasOpenPlots = !empty($data->hasOpenPlots) ? $data->hasOpenPlots : null;
    $purchaseDate = !empty($data->purchaseDate) ? $data->purchaseDate : null;
    $ownerId = !empty($data->ownerId) ? $data->ownerId : null;
    $buriedIndividualIds = !empty($data->buriedIndividualIds) ? $data->buriedIndividualIds : null;
    $longitude = !empty($data->longitude) ? $data->longitude : null;
    $latitude = !empty($data->latitude) ? $data->latitude : null;
    
    if(isset($price) && (!is_numeric($price) || $price < 0)){
        $response->addError("Price must be of positive numerical value or left empty.");
    }
    if($forSale){
        $idFilter = new TombFilter();
        $idFilter->setTombId($id);
        $existingTomb = getAllTombRelatedDataWithFilter($id)->result;
        if(!empty($existingTomb) && !$existingTomb[0]->forSale){ // If the tomb was originally not for sale and was changed to be for sale
            $response->addError("A lot can not be changed from not for sale to for sale.");
        }
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
        $mainImagePath = processMainImageUpload($response);
        $attachedDocumentsPaths = processAttachedDocumentsUpload($response);
        
        // If there are no problems with file uploading, process request
        if(empty($response->error)){
            //Prepare toTableTomb object
            $obj = new ToTableTomb(
                    0, // Section Letter ID is 0 as this value is not allowed to be changed
                    0, // Section Number is 0 as this value is not allowed to be changed
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
            $modelResponse = updateTomb($id, $obj);
            $response->setError($modelResponse->error);
            $response->setResult($modelResponse->result);        
        }
    }
    echo json_encode(get_object_vars($response));
}