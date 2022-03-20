<?php

/* 
 * All Buried Individuals related fetchers
 */
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
        $response->setError($modelResponse->error);

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function fetchBuriedIndividualById(){
    $id = $_GET['id'];
    $response = getBuriedIndividualById($id);
    // Setting the Date of birth and date of death to match the date component
    if(!empty($response->result)){
        $response->result[0]->setDodForDateComponent();
        $response->result[0]->setDobForDateComponent();
    }
    echo json_encode(get_object_vars($response));
}

function editBuriedIndividual(){
    $id = $_GET['id'];
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
    
    if(!isset($id) || !is_numeric($id)){
        $response->addError("Buried Individual ID is not specified.");
    }
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
        $modelResponse = updateBuriedIndividual($id, $obj);
        $response->setError($modelResponse->error);
        $response->setResult($modelResponse->result);
        
    }
    echo json_encode(get_object_vars($response));
}
