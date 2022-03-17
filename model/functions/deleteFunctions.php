<?php

/* 
 * Model Delete Functions
 */

function deleteContact(int $id)
{
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "DELETE FROM CONTACTS WHERE ID=:id;";
        $statement = $con->prepare($query);
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to delete Contact.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}