<?php

/* 
 * All Contact Related Fetchers
 */

function addContact(){
    $response = new Response();
   
    // Getting REQUEST data
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $email = !empty($data->email) ? $data->email : null;
    $title = !empty($data->title) ? $data->title : null;
    $phoneNumber = !empty($data->phoneNumber) ? $data->phoneNumber : null;
    
    if(!isset($firstName) || strlen($firstName) < 1){
        $response->addError("First Name must be of a valid value.");
    }
    if(!isset($lastName) || strlen($lastName) < 1){
        $response->addError("Last Name must be of a valid value.");
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
    else{
        $response->addError("Phone Number must be set.");
    }
    if(!isset($email)){
        $response->addError("Email address must be set.");
    }
    if (isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response->addError("Invalid email address.");
    }
    
    if(empty($response->error)){
        $obj = new ToContactTable($firstName, $lastName, $email, $title, $phoneNumber);
        $modelResponse = insertContact($obj);
        $response->setError($modelResponse->error);

        if(count($response->error) == 0 && count($modelResponse->result) == 1){ // If everything was successful, send client true in response
            $response->addResult($modelResponse->result[0]);
        }
    }
    echo json_encode(get_object_vars($response));
}

function fetchContacts(){
    $response = getAllContacts();
    $response ->setResult(
        array_map(function($o) { 
            return array(
                "name" => $o->firstName . " " . $o->lastName,
                "title" => $o->title,
                "phoneNumber" => $o->phoneNumber,
                "email" => $o->email
                );

        }, $response->result)    
    );
    echo json_encode(get_object_vars($response));
}

function processDeleteContact(){
    $id = $_GET['id'];
    $response = deleteContact($id);
    echo json_encode(get_object_vars($response));
}

function fetchContactById(){
    $id = $_GET['id'];
    $response = getContactById($id);
    echo json_encode(get_object_vars($response));
}

function editContact(){
    $id = $_GET['id'];
    $response = new Response();
 
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $email = !empty($data->email) ? $data->email : null;
    $title = !empty($data->title) ? $data->title : null;
    $phoneNumber = !empty($data->phoneNumber) ? $data->phoneNumber : null;
    
    if(!isset($id) || !is_numeric($id)){
        $response->addError("Contact ID is not specified.");
    }
    if(!isset($firstName) || strlen($firstName) < 1){
        $response->addError("First Name must be of a valid value.");
    }
    if(!isset($lastName) || strlen($lastName) < 1){
        $response->addError("Last Name must be of a valid value.");
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
    else{
        $response->addError("Phone Number must be set.");
    }
    if(!isset($email)){
        $response->addError("Email address must be set.");
    }
    if (isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response->addError("Invalid email address.");
    }
    
    if(empty($response->error)){
        $obj = new ToContactTable($firstName, $lastName, $email, $title, $phoneNumber);
        $modelResponse = updateContact($id, $obj);
        $response->setError($modelResponse->error);
        $response->setResult($modelResponse->result);
    }
    echo json_encode(get_object_vars($response));
}
