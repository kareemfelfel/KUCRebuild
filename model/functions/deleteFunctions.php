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
        $query = "DELETE FROM contacts WHERE ID=:id;";
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

function deleteAttachmentForTomb($tombId, $link){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "DELETE FROM tomb_attachments WHERE TOMB_ID = :tombId AND LINK = :link;";
        $statement = $con->prepare($query);
        $statement->bindValue(':tombId', $tombId);
        $statement->bindValue(':link', $link);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to delete Attachment.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}

function deleteAttachmentForColumbarium($columbariumId, $link){
    $response = new Response();
    try{
        $db = connection::getInstance();
        $con = $db->get_connection();
        $query = "DELETE FROM columbarium_attachments WHERE COLUMBARIUM_ID = :columbariumId AND LINK = :link;";
        $statement = $con->prepare($query);
        $statement->bindValue(':columbariumId', $columbariumId);
        $statement->bindValue(':link', $link);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success)
        {
            $response->addResult(True);
        }
        else
        {
            $response->addError("Failed to delete Attachment.");
        }
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        $response->addError($errorMessage);
    }
    return $response;
}