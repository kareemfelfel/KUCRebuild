<?php

/* 
 * All Model Update methods to be included in this file
 */
function updateBuriedIndividualsTombId($tombId, $buriedIndividualsIds){
    $response = new Response();
    if(!isset($buriedIndividualsIds) || count($buriedIndividualsIds) == 0){
        $response->addResult(true); // Do not bother trying to add an empty array
        return $response;
    }
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        
        $query = "UPDATE `buried_individuals` "
                . "SET buried_individuals.TOMB_ID = :tombId "
                . "WHERE "
                . "buried_individuals.ID IN (" . implode(',', $buriedIndividualsIds) .");";
        $statement = $con->prepare($query);
        $statement->bindParam(':tombId', $tombId);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else{
            $response -> addError("Failed to link Buried Individuals with Tomb ID.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}

function updateBuriedIndividualsColumbariumId($columbariumId, $buriedIndividualsIds){
    $response = new Response();
    if(!isset($buriedIndividualsIds) || count($buriedIndividualsIds) == 0){
        $response->addResult(true); // Do not bother trying to add an empty array
        return $response;
    }
    try{
        $db = connection::getInstance();
        $con = $db -> get_connection();
        
        $query = "UPDATE `buried_individuals` "
                . "SET buried_individuals.COLUMBARIUM_ID = :columbariumId "
                . "WHERE "
                . "buried_individuals.ID IN (" . implode(',', $buriedIndividualsIds) .");";
        $statement = $con->prepare($query);
        $statement->bindParam(':columbariumId', $columbariumId);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response -> addResult(true);
        }
        else{
            $response -> addError("Failed to link Buried Individuals with Columbarium ID.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response -> addError($errorMessage);
    }
    return $response;
}
