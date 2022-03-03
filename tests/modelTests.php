<?php

function getAllTombRelatedDataWithFilterTest(){
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

function getUnlinkedBuriedIndividualsTest(){
    $response = getUnlinkedBuriedIndividuals();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllOwnersTest(){
    $response = getAllOwners();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllColumbariumSectionLettersTest(){
    $response = getAllColumbariumSectionLetters();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getBuriedIndividualsForTombTest(){
    $response = getBuriedIndividualsForTomb(1);
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAttachmentsForTombTest(){
    $response = getAttachmentsForTomb(1);
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllBuriedIndividualsTest(){
    $response = getAllBuriedIndividuals();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAdminTest(){
    $response = getAdmin("test", "test");
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllNicheTypesTest(){
    $response = getAllNicheTypes();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function checkUsernameExistTest(){
    $response = checkUsernameExist("test");
    
    if(count($response->result) > 0)
        echo $response ->result[0];
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllColumbariumTypesTest(){
    $response = getAllColumbariumTypes();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllTombSectionLettersTest(){
    $response = getAllTombSectionLetters();
    
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}


function getBuriedIndividualsForColumbariumTest($columbariumID){
    $response = getBuriedIndividualsForColumbarium($columbariumID);
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}



function getColumbariumAttachmentsTest($columbariumId){
    $response = getColumbariumAttachments($columbariumId);
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function getAllColumbariumRelatedDataWithFilterTest()
{
    $filter = new ColumbariumFilter();
    $filter->setForSale(true);
    $filter->setSectionLetterId(4);
    $filter->setSectionNumber(123);
    $filter->setColumbariumTypeId(5);
    $filter ->setNicheTypeId(1);
    $response = getAllColumbariumRelatedDataWithFilter($filter);
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}