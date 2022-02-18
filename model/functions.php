<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getUnlinkedBuriedIndividuals(){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM BURIED_INDIVIDUALS WHERE "
                . "(buried_individuals.TOMB_ID IS NULL && "
                . "buried_individuals.COLUMBARIUM_ID IS NULL);";
        $statement = $con->prepare($query);
        $success = $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($results) > 0)
        {
            for( $i =0; $i< count($results); $i++)
            {

                $row = $results[$i];
                $buriedIndividual = new BuriedIndividual($row);
                $response ->addResult($buriedIndividual);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch Unlinked Buried Individuals.");
        }
        return $response;
    }
    catch (PDOException $e) 
    {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}

function getAllOwners(){
    try{
        $response = new Response();
        $db = connection::getInstance();
        $con = $db -> get_connection();
        $query = "SELECT * FROM OWNERS;";
        $statement = $con->prepare($query);
        $success = $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        if($success && count($results) > 0)
        {
            for( $i =0; $i< count($results); $i++)
            {
                $row = $results[$i];
                $owner = new Owner($row);
                $response ->addResult($owner);
            }
        }
        if(!$success){
            $response -> addError("Failed to fetch All Owners.");
        }
        return $response;
    }
    catch (PDOException $e) 
    {
        $errorMessage = $e->getMessage();
        include '../view/error/error.php';
        die;
    }
}