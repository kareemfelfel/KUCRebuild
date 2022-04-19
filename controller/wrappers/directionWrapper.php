<?php

function directToSearchColumbariumPage(){
    if($_SESSION['user']->userType == UserType::ADMIN){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/searchColumbarium/searchColumbarium.php';
    }
    
    if($_SESSION['user']->userType == UserType::GUEST){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/public/searchColumbarium/searchColumbarium.php';
    }
}

function directToViewColumbariumPage(){
        
    if($_SESSION['user']->userType == UserType::ADMIN){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/viewColumbarium/viewColumbarium.php';
    }
    
    if($_SESSION['user']->userType == UserType::GUEST){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/public/viewColumbarium/viewColumbarium.php';
    }
}

function directToSearchTombPage(){
        
    if($_SESSION['user']->userType == UserType::ADMIN){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/searchTomb/searchTomb.php';
    }
    
    if($_SESSION['user']->userType == UserType::GUEST){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/public/searchTomb/searchTomb.php';
    }
}

function directToViewTombPage(){
        
    if($_SESSION['user']->userType == UserType::ADMIN){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/viewTomb/viewTomb.php';
    }
    
    if($_SESSION['user']->userType == UserType::GUEST){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/public/viewTomb/viewTomb.php';
    }
}

function directToLoginPage(){
    
    if($_SESSION['user']->userType == UserType::ADMIN){
        header("Location: " . "../controller/controller.php?action=directToHomePage");
    }
    
    if($_SESSION['user']->userType == UserType::GUEST){
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/login/login.php';
    }
}

