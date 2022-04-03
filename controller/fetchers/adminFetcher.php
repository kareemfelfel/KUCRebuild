<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function addAdmin(){
    $response = new Response();
    
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $email = !empty($data->email) ? $data->email : null;
    $password = !empty($data->password) ? $data->password : null;
    
    if(!isset($firstName) || strlen($firstName) < 1){
        $response->addError("First Name must be set.");
    }
    if(!isset($lastName) || strlen($lastName) < 1){
        $response->addError("Last Name must be set.");
    }
    if (isset($email)) {
        $modelEmailResponse = checkAdminEmailExist($email);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $response->addError("Invalid email address.");
        }
        if(empty($modelEmailResponse->error)){
            if($modelEmailResponse->result[0]){
                $response->addError("An account already exist with the same email.");
            } 
        }
        else{
            $response->addError($modelEmailResponse->error[0]);
        }
            
    }
    else{
        $response->addError("Email Address must be set.");
    }
    if(isset($password)){
        if(strlen($password) <= 8){
            $response->addError("Password must be at least 8 characters.");
        }
        if(!preg_match("#[0-9]+#", $password)){
            $response->addError("Password must contain at least 1 number.");
        }
        if(!preg_match("#[A-Z]+#", $password)){
            $response->addError("Password must contain at least 1 uppercase letter.");
        }
        if(!preg_match("#[a-z]+#", $password)){
            $response->addError("Password must contain at least 1 lowercase letter.");
        }
    }
    else{
        $response->addError("Password must be set.");
    }
    
    if(empty($response->error)){
        $obj = new ToAdminTable($firstName, $lastName, $email, sha1($password));
        $modelResponse = insertAdmin($obj);
        $response->setResult($modelResponse->result);
        $response->setError($modelResponse->error);
    }
    
    echo json_encode(get_object_vars($response));
}

