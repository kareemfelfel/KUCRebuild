<?php

/* 
 * All Related Owner fetchers
 * 
 */
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
    $mutatedResponse->setError($response->error);
    echo json_encode(get_object_vars($mutatedResponse));
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
        $response->setError($modelResponse->error);

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function fetchOwnerById(){
    $id = $_GET['id'];
    $response = getOwnerById($id);
    if(!empty($response->result)){
        $response->result[0]->stripCountryCodeFromPhoneNumber();
    }
    echo json_encode(get_object_vars($response));
}

function editOwner(){
    $id = $_GET['id'];
    $response = new Response();
 
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $middleName = !empty($data->middleName) ? $data->middleName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $address = !empty($data->address) ? $data->address : null;
    $phoneNumber = !empty($data->phoneNumber) ? $data->phoneNumber : null;
    $email = !empty($data->email) ? $data->email : null;
    
    if(!isset($id) || !is_numeric($id)){
        $response->addError("Owner ID is not specified.");
    }
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
        $modelResponse = updateOwner($id, $obj);
        $response->setError($modelResponse->error);
        $response->setResult($modelResponse->result);
        
    }
    echo json_encode(get_object_vars($response));
}
