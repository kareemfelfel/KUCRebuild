<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

// Include all of our mapping classes
include 'requireMappingClasses.php';

// Include Test cases
include '../tests/modelTests.php';

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
    case"directToSearchTombPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/tomb/searchTomb/searchTomb.php';
        break;
    case"directToContactsPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/contacts/contacts.php';
        break;
    case"directToEditContactPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/contacts/editContact/editContact.php';
        break;
    case"directToEditOwnerPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/administration/owners/editOwner/editOwner.php';
        break;
    case"directToAddColumbariumPage":
        include '../View/includes/head.php';
        include '../View/includes/navbar.php';
        include '../view/columbarium/addColumbarium/addColumbarium.php';
        break;
    //API
    case"fetchAllOwnersList":
        fetchAllOwnersList();
        break;
    case"fetchUnlinkedBuriedIndividualsList":
        fetchUnlinkedBuriedIndividualsList();
        break;
    case"fetchColumbariumSectionLettersList":
        fetchColumbariumSectionLettersList();
        break;
    case"fetchNicheTypesList":
        fetchNicheTypesList();
        break;
    case"fetchColumbariumTypesList":
        fetchColumbariumTypesList();
        break;
    case"fetchTombSectionLettersList":
        fetchTombSectionLettersList();
        break;
    case"fetchAllBuriedIndividualsList":
        fetchAllBuriedIndividualsList();
        break;
    case"fetchTombCards":
        fetchTombCards();
        break;
}
//-----API--------
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
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchUnlinkedBuriedIndividualsList(){
    $mutatedResponse = new Response();
    $response = getUnlinkedBuriedIndividuals();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->firstName . " " . $response->result[$i]->lastName
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

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
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
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
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
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
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
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
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

function fetchAllBuriedIndividualsList(){
    $mutatedResponse = new Response();
    $response = getAllBuriedIndividuals();
    if(count($response->result) > 0){
        for($i=0; $i<count($response->result); $i++){
            $mutatedResult = array(
                "value" => $response->result[$i]->id,
                "name" => $response->result[$i]->firstName . " " . $response->result[$i]->lastName
            );
            $mutatedResponse->addResult($mutatedResult);
        }
    }
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

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
    if(count($response->error) > 0){
        for($i=0; $i<count($response->error); $i++){
            $mutatedResponse->addError($response->error[$i]);
        }
    }
    echo json_encode(get_object_vars($mutatedResponse));
}

