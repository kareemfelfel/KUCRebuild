<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

// Include all of our mapping classes
include 'requireMappingClasses.php';

// OUR MAIN CONTACT WITH DATABASE
require_once '../model/connection.php';
require_once '../model/functions.php';


if (isset ($_POST['action']))
{
    $action = $_POST['action'];
}
else if (isset ($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    // variable to set active status in navbar
    $homeActive = true;
    include '../View/includes/head.php';
    include '../View/includes/navbar.php';
    include '../view/home/home.php';
    exit();
}

switch ($action)
{
    case"directToHomePage":
        // variable to set active status in navbar
        $homeActive = true;
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/home/home.php';
        break;
    case"directToAdministrationPage":
        // variable to set active status in navbar
        $administrationActive = true;
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/administration.php';
        break;
    case"directToContactUsPage":
        $contactUsActive = true;
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/contactUs/contactUs.php';
        break;
    case"directToAddTombPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../View/tomb/addTomb/addTomb.php';
        break;
    case"driectToAddColumbariumPage":
        break;
    case"directToOwnersPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/owners/owners.php';
        break;
    case"directToBuriedIndividualsPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../View/administration/buriedIndividuals/buriedIndividuals.php';
        break;
    case"directToListControlsPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/editLists/editLists.php';
        break;
    case"directToAddNewAdminPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/addNewAdmin/addNewAdmin.php';
        break;
    case"directToLoginPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/login/login.php';
        break;
}
            
function addHeaderAndNavbar(){
    include '../View/includes/head.php';
    include '../View/includes/navbar.php';
}

// TODO remove
function tombFilterTest(){
    $filter = new TombFilter();
    $filter ->setForSale(false);
    $filter ->setHasOpenPlots(true);
    $filter ->setLotNumber(123);
    $filter ->setBuriedIndividualIds(array(2, 1, 3, 4));
    $response = getAllTombRelatedDataWithFilter($filter);
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}