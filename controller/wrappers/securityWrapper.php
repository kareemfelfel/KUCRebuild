<?php

function userIsAuthorized($action){
    $response = new Response();
    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = new User();
    }
    
    if($_SESSION['user']->userType == UserType::ADMIN){
        // TODO see if we can maybe update the admin's data here
        $response->addResult(true);
    }
    else{
        if(!empty(setGuestPrivileges()->error)){
            $response->addResult(false);
        }
        else{
            $response = checkGuestAccessToAction($action);
        }
    }

    return $response;
}

function processLogin(){
    $response = new Response();
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $email = !empty($data->email) ? $data->email : null;
    $password = !empty($data->password) ? $data->password : null;
    
    $modelResponse = getAdmin($email, sha1($password));
    
    if(empty($modelResponse->result)){
        $response->addError("Invalid Email and/or Password.");
    }
    else{
        $admin = $modelResponse->result[0];
        $_SESSION['user']->setUserType(UserType::ADMIN);
        $_SESSION['user']->setAdmin($admin);
        $response->addResult(true);
    }
    echo json_encode(get_object_vars($response));
}

function processLogout(){
    session_destroy();
    header("Location: " . "../index.php");
    exit();
}

function checkRequest($action){
    if($action == "directToAddNewAdminPage" || 
        $action == "directToLoginPage"){
        if (!isset($_SERVER['HTTPS'])) {
            $_SESSION['HTTPS-CHECK'] = true;
            echo $_SESSION['HTTPS-CHECK'];
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: " . $url);
            exit();
        }
    }
}

function validateRequest($action){
    if(!checkActionExists($action)->result[0]){
        http_response_code(404);
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/error/notFound.php';
        exit();
    }
    else{
        if(!userIsAuthorized($action)->result[0]){
            http_response_code(401);
            include '../view/includes/head.php';
            include '../view/includes/navbar.php';
            include '../view/error/unAuthorized.php';
            exit();
        }
    }
}

