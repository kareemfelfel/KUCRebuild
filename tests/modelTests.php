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

function getAllContactsTest()
{
    $response = getAllContacts();
    if(count($response->result) > 0)
        echo json_encode(get_object_vars($response ->result[0]));
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function insertColumbariumTypeTest()
{ 
    $intype = "lastTest";
    $toType = new ToTypeTable($intype);
    $response = insertColumbariumType($toType);
    if(count($response->result) > 0)
        echo $response ->result[0];
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function insertBuriedIndividualTest()
{
    //test values
    $firstName = "Z";
    $lastName = "Z";
    $middleName = "Z";
    $maidenName = "Z";
    $dob = "2010-12-12";
    $dod = "2022-12-12";
    $obituary = "Z";
    $veteran = 1;
    $buriedIndividual = new ToBuriedIndividualTable($firstName, $middleName, $maidenName, $lastName, $dob, $dod, $veteran, $obituary);
    $response = insertBuriedIndividual($buriedIndividual);
    if(count($response->result) > 0)
        echo $response ->result[0];
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function insertOwnerTest()
{
    //test values
    $firstName = "test";
    $lastName ="test";
    $middleName = null;
    $address = "address";
    $phoneNumber = "phoneNumber";
    $email = "Email";
    $owner = new ToOwnerTable($firstName, $lastName, $middleName, $address, $phoneNumber, $email);
    $response = insertOwner($owner);
    if(count($response->result) > 0)
        echo $response ->result[0];
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function insertContactTest()
{
    //test values
    $firstName = "test";
    $lastName = "test";
    $email = "test";
    $title = "test";
    $phoneNumber = "123456789";
    $contact  = new ToContactTable($firstName, $lastName, $email, $title, $phoneNumber);
    $response = insertContact($contact);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}

function insertNicheTypeTest()
{
    //test value
    $type = "TestType";
    $nicheType = new ToTypeTable($type);
    $response = insertNicheType($nicheType);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}

function insertTombSectionLetterTest()
{
    $letter = "Z";
    $sectionLetter = new ToSectionLetter($letter);
    $response = insertTombSectionLetter($sectionLetter);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}

function insertColumbariumSectionLetterTest()
{
    $letter = "Z";
    $sectionLetter = new ToSectionLetter($letter);
    $response = insertColumbariumSectionLetter($sectionLetter);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
} 

function updateBuriedIndividualTest()
{
    //test values
    $id = "8";
    $firstName = "Z";
    $lastName = "Z";
    $middleName = "Z";
    $maidenName = "Z";
    $dob = "2010-12-12";
    $dod = "2022-12-12";
    $obituary = "Z";
    $veteran = 1;
    $buriedIndividual = new ToBuriedIndividualTable($firstName, $middleName, $maidenName, $lastName, $dob, $dod, $veteran, $obituary);
    $response = updateBuriedIndividual($id, $buriedIndividual);
    if(count($response->result) > 0)
        echo $response ->result[0];
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function updateOwnerTest()
{
    $id = "5";
    $firstName = "test";
    $lastName ="test";
    $middleName = null;
    $address = "address";
    $phoneNumber = "phoneNumber";
    $email = "Email";
    $owner = new ToOwnerTable($firstName, $lastName, $middleName, $address, $phoneNumber, $email);
    $response = updateOwner($id, $owner);
    if(count($response->result) > 0)
        echo $response ->result[0];
    if(count($response -> error) > 0)
        echo $response -> error[0];
}

function updateContactTest()
{
    $id = "1";
    $firstName = "test";
    $lastName = "test";
    $email = "test";
    $title = "test";
    $phoneNumber = "123456789";
    $contact  = new ToContactTable($firstName, $lastName, $email, $title, $phoneNumber);
    $response = updateContact($id, $contact);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}

function updateAdminTest()
{
    $id = "1";
    $firstName = "test";
    $lastName = "test";
    $username = "test";
    $password = "dummyData"; //this is just so we can pass it as dummy data into the class
    $admin = new ToAdminTable($firstName, $lastName, $username, $password);
    $response = updateAdmin($id, $admin);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}

function updateAdminPasswordTest()
{
    $id = "1";
    $password = "test";
    $response = updateAdminPassword($id, $password);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}

function deleteContactTest()
{
    $id = "3";
    $response = deleteContact($id);
    if(count($response->result)>0)
        echo $response->result[0];
    if(count($response->error)>0)
        echo $response->error[0];
}