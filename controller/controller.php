<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Added before session because $_SESSION['user'] will carry an instance of the class User.
include '../model/User.php';
include '../model/consts.php';
include '../model/mappingClasses/Admin.php';
session_start();

// Include all of our mapping classes
include 'requireMappingClasses.php';

// Include Test cases
include '../tests/modelTests.php';

//Include All Fetchers
include 'requireFetchers.php';

// OUR MAIN CONTACT WITH DATABASE
include 'requireModel.php';

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
    header("Location: " . "../controller/controller.php?action=directToHomePage");
    exit();
}
// change to HTTPS for certain actions that require trasfer of sensitive data
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

// Make sure to switch to HTTPS for pages that require password

switch ($action)
{
    case"directToHomePage":
        // variable to set active status in navbar
        $homeActive = true;
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/home/home.php';
        break;
    case"directToAdministrationPage":
        // variable to set active status in navbar
        $administrationActive = true;
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/administration.php';
        break;
    case"directToContactUsPage":
        $contactUsActive = true;
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/contactUs/contactUs.php';
        break;
    case"directToAddTombPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/addTomb/addTomb.php';
        break;
    case"directToOwnersPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/owners/owners.php';
        break;
    case"directToBuriedIndividualsPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/buriedIndividuals/buriedIndividuals.php';
        break;
    case"directToListControlsPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/editLists/editLists.php';
        break;
    case"directToAddNewAdminPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/addNewAdmin/addNewAdmin.php';
        break;
    case"directToLoginPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/login/login.php';
        break;
    case"directToSearchTombPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/searchTomb/searchTomb.php';
        break;
    case"directToContactsPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/contacts/contacts.php';
        break;
    case"directToEditContactPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/contacts/editContact/editContact.php';
        break;
    case"directToEditOwnerPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/owners/editOwner/editOwner.php';
        break;
    case"directToAddColumbariumPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/addColumbarium/addColumbarium.php';
        break;
    case"directToSearchColumbariumPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/searchColumbarium/searchColumbarium.php';
        break;
    case"directToEditBuriedIndividualPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/buriedIndividuals/editBuriedIndividual/editBuriedIndividual.php';
        break;
    case"directToViewTombPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/viewTomb/viewTomb.php';
        break;
    case"directToViewColumbariumPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/viewColumbarium/viewColumbarium.php';
        break;
    case"directToPublicAccessPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/administration/publicAccess/publicAccess.php';
        break;
    case"directToEditColumbariumSelectorPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/editColumbarium/selector.php';
        break;
    case"directToEditTombSelectorPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/editTomb/selector.php';
        break;
    case"directToEditTombPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/tomb/editTomb/editTomb.php';
        break;
    case"directToEditColumbariumPage":
        include '../view/includes/head.php';
        include '../view/includes/navbar.php';
        include '../view/columbarium/editColumbarium/editColumbarium.php';
        break;
    case"login":
        processLogin();
        break;
    case"logout":
        processLogout();
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
    case"fetchColumbariumCards":
        fetchColumbariumCards();
        break;
    case"fetchTombById":
        fetchTombById();
        break;
    case"fetchColumbariumById":
        fetchColumbariumById();
        break;
    case"fetchContacts":
        fetchContacts();
        break;
    case"fetchContactsList":
        fetchContactsList();
        break;
    case"fetchBuriedIndividualById":
        fetchBuriedIndividualById();
        break;
    case"fetchOwnerById":
        fetchOwnerById();
        break;
    case"fetchContactById":
        fetchContactById();
        break;
    case"fetchAllTombsList":
        fetchAllTombsList();
        break;
    case"fetchAllColumbariumsList":
        fetchAllColumbariumsList();
        break;
    case"addTomb":
        addTomb();
        break;
    case"addColumbarium":
        addColumbarium();
        break;
    case"addBuriedIndividual":
        addBuriedIndividual();
        break;
    case"addOwner":
        addOwner();
        break;
    case"addColumbariumType":
        addColumbariumType();
        break;
    case"addNicheType":
        addNicheType();
        break;
    case"addColumbariumSectionLetter":
        addColumbariumSectionLetter();
        break;
    case"addTombSectionLetter":
        addTombSectionLetter();
        break;
    case"addContact":
        addContact();
        break;
    case"addAdmin":
        addAdmin();
        break;
    case"deleteContact":
        processDeleteContact();
        break;
    case"editBuriedIndividual":
        editBuriedIndividual();
        break;
    case"editOwner":
        editOwner();
        break;
    case"editContact":
        editContact();
        break;
    case"editTomb":
        editTomb();
        break;
    case"unlinkTombBuriedIndividual":
        unlinkTombBuriedIndividual();
        break;
    case"deleteTombAttachment":
        deleteTombAttachment();
        break;
    case"editColumbarium":
        editColumbarium();
        break;
    case"unlinkColumbariumBuriedIndividual":
        unlinkColumbariumBuriedIndividual();
        break;
    case"deleteColumbariumAttachment":
        deleteColumbariumAttachment();
        break;
}

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