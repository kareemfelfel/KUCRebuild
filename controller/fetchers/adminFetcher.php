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
        if(strlen($password) < 8){
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

function editAdmin(){
    $response = new Response();
    $id = $_SESSION['user']->admin->id;
    $data = json_decode($_POST['request']);
    $firstName = !empty($data->firstName) ? $data->firstName : null;
    $lastName = !empty($data->lastName) ? $data->lastName : null;
    $email = !empty($data->email) ? $data->email : null;
    
    if(!isset($firstName) || strlen($firstName) < 1){
        $response->addError("First Name must be set.");
    }
    if(!isset($lastName) || strlen($lastName) < 1){
        $response->addError("Last Name must be set.");
    }
    if (isset($email) && $email !== $_SESSION['user']->admin->email) {
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
    if(!isset($email)){
        $response->addError("Email Address must be set.");
    }
    
    if(empty($response->error)){
        $admin = new ToAdminTable($firstName, $lastName, $email, null);
        $modelResponse = updateAdmin($id, $admin);
        $response->setResult($modelResponse->result);
        $response->setError($modelResponse->error);
    }
    
    if(empty($response->error)){
        updateAdminInfo();
    }
    
    echo json_encode(get_object_vars($response));
}

function retrieveAdminInfo(){
    $response = new Response();
    $response->setResult(
            array(
                "firstName" => $_SESSION['user']->admin->firstName,
                "lastName" => $_SESSION['user']->admin->lastName,
                "email" => $_SESSION['user']->admin->email
            )
    );
    echo json_encode(get_object_vars($response));
}

function editAdminPassword(){
    $response = new Response();
    $id = $_SESSION['user']->admin->id;
    $data = json_decode($_POST['request']);
    $currentPassword = !empty($data->currentPassword)? $data->currentPassword : null;
    $newPassword = !empty($data->newPassword)? $data->newPassword : null;
    
    if(isset($currentPassword)){
        $hashedPassword = sha1($currentPassword);
        if($hashedPassword != $_SESSION['user']->admin->password){
            $response->addError("Current Password does not match our record.");
        }
    }
    else{
        $response->addError("Current Password must be set.");
    }
    
    if(!isset($newPassword)){
        $response->addError("New Password must be set.");
    }
    
    if(empty($response->error)){
        if(strlen($newPassword) < 8){
            $response->addError("Password must be at least 8 characters.");
        }
        if(!preg_match("#[0-9]+#", $newPassword)){
            $response->addError("Password must contain at least 1 number.");
        }
        if(!preg_match("#[A-Z]+#", $newPassword)){
            $response->addError("Password must contain at least 1 uppercase letter.");
        }
        if(!preg_match("#[a-z]+#", $newPassword)){
            $response->addError("Password must contain at least 1 lowercase letter.");
        }
    }
    
    if(empty($response->error)){
        $modelResponse = updateAdminPassword($id, sha1($newPassword));
        $response->setResult($modelResponse->result);
        $response->setError($modelResponse->error);
    }
    
    if(empty($response->error)){
        updateAdminInfo();
    }
    
    echo json_encode(get_object_vars($response));
}

function fetchAdmins(){
    $response = getAllAdmins();
    
    $mutatedResult = array_map(function($o) {
        return array(
            "firstName" => $o->firstName,
            "lastName" => $o->lastName,
            "email" => $o->email
        );
    }, $response->result);
    
    $response->setResult($mutatedResult);
    
    echo json_encode(get_object_vars($response));
}

function processDeleteAdmin(){
    $id = $_SESSION['user']->admin->id;
    $data = json_decode($_POST['request']);
    $password1 = !empty($data->password1)? $data->password1 : null;
    $password2 = !empty($data->password2)? $data->password2 : null;
    $confirmed = !empty($data->confirm) ? $data->confirm : false;
    $response = new Response();
    
    if(strtolower($_SESSION['user']->admin->email) == "admin@kuc.com"){
        $response->addError("admin@kuc.com is a special user that cannot be deleted.");
    }
    else{
        $allAdminsCount = count(getAllAdmins()->result);
        if($allAdminsCount == 1){
            $response->addError("This account can not be deleted as it is the last admin in the database.");
        }
    }
    
    if(isset($password1) && isset($password2)){
        $hashedPassword = sha1($password1);
        if($password1 != $password2){
            $response->addError("Passwords do not match.");
        }
        else if($hashedPassword != $_SESSION['user']->admin->password){
            $response->addError("Incorrect Password.");
        }
    }
    else{
        $response->addError("Password must be set.");
    }
    
    if(!$confirmed){
        $response->addError("You must agree to the statement above.");
    }
    
    if(empty($response->error)){
        $modelResponse = deleteAdmin($id);
        $response->setResult($modelResponse->result);
        $response->setError($modelResponse->error);
    }


    
    echo json_encode(get_object_vars($response));
}
