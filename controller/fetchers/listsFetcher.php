<?php

/* 
 * All Lists related fetchers
 * 
 */
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
    $mutatedResponse->setError($response->error);
    echo json_encode(get_object_vars($mutatedResponse));
}

// Available plot numbers from 1 - 20. Can be changed to anything really,
// 20 Just seems reasonable.
function fetchPlotNumbersList(){
    $response = new Response();
    for($i = 1; $i <= 20; $i ++){
        $response->addResult(array(
                "value" => $i,
                "name" => $i
            ));
    }
    echo json_encode(get_object_vars($response));
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
    $mutatedResponse->setError($response->error);
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
    $mutatedResponse->setError($response->error);
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
    $mutatedResponse->setError($response->error);
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
    $mutatedResponse->setError($response->error);
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
    $mutatedResponse->setError($response->error);
    echo json_encode(get_object_vars($mutatedResponse));
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
        $response->setError($modelResponse->error);

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
        $response->setError($modelResponse->error);

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function addColumbariumSectionLetter(){
    $response = new Response();
   
    // Getting REQUEST data
    $data = json_decode($_POST['request']);
    $sectionLetter = !empty($data->sectionLetter) ? $data->sectionLetter : null;
    
    if(!isset($sectionLetter) || strlen($sectionLetter) < 1){
        $response->addError("Columbarium Section Letter must be of a valid value.");
    }
    
    if(empty($response->error)){
        $obj = new ToSectionLetter($sectionLetter);
        $modelResponse = insertColumbariumSectionLetter($obj);
        $response->setError($modelResponse->error);

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function addTombSectionLetter(){
    $response = new Response();
   
    // Getting REQUEST data
    $data = json_decode($_POST['request']);
    $sectionLetter = !empty($data->sectionLetter) ? $data->sectionLetter : null;
    
    if(!isset($sectionLetter) || strlen($sectionLetter) < 1){
        $response->addError("Lot Section Letter must be of a valid value.");
    }
    
    if(empty($response->error)){
        $obj = new ToSectionLetter($sectionLetter);
        $modelResponse = insertTombSectionLetter($obj);
        $response->setError($modelResponse->error);

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function fetchContactsList(){
    
    $mutatedResponse = new Response();
    $response = getAllContacts();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->firstName . " " . $response->result[$i]->lastName
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    $mutatedResponse->setError($response->error);
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchAllColumbariumsList(){
    $filter = new ColumbariumFilter();
    $response = getAllColumbariumRelatedDataWithFilter($filter);
    if(!empty($response->result)){
        $response->setResult(
            array_map(function($o) {
                return array(
                    "value" => $o->id,
                    "name" => $o->columbariumType->type . " - " .
                               $o->nicheType->type . " - " . 
                               $o->sectionLetter->letter . " " . 
                               $o->sectionNumber
                ); 
            }, $response->result)
        );
    }
    echo json_encode(get_object_vars($response));
}

function fetchAllTombsList(){
    $filter = new TombFilter();
    $response = getAllTombRelatedDataWithFilter($filter);
    if(!empty($response->result)){
        $response->setResult(
            array_map(function($o) {
                return array(
                    "value" => $o->id,
                    "name" => $o->sectionLetter->letter . " " .
                               $o->lotNumber . " | " . "Plots: " . implode(', ', $o->plotNums)
                ); 
            }, $response->result)
        );
    }
    echo json_encode(get_object_vars($response));
}
