<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Helper Function for add Tomb and add Columbarium
function processMainImageUpload(&$response, &$filesToUpload){
    if(array_key_exists("mainImage", $_FILES)){
        $targetDir = "../assets/images/uploadedImages/";
        $file = $_FILES['mainImage']['name'];
	$path = pathinfo($file);
	$filename = $path['filename'];
	$ext = $path['extension'];
        $temp_name = $_FILES['mainImage']['tmp_name'];
	$mainImagePath = $targetDir.$filename.".".$ext;
        if (file_exists($mainImagePath)) {
            $response ->addError("A main image already exsist with the same name. Please rename the image and upload again.");
        }
        if(empty($response->error)){
            array_push($filesToUpload, array(
                "name" => $temp_name,
                "path" => $mainImagePath
            ));
        }     
    }
    else{
        // Set To null
        $mainImagePath = null;
    }
    
    return $mainImagePath;
}

// Helper Function for add Tomb and add Columbarium
function processAttachedDocumentsUpload(&$response, &$filesToUpload){
    // Attached Documents
    $attachedDocuments = array();
    if(array_key_exists("attachedDocuments", $_FILES)){
        for($i = 0; $i< count($_FILES['attachedDocuments']['name']); $i ++){
            $targetDir = "../assets/attachedFiles/";
            $file = $_FILES['attachedDocuments']['name'][$i];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['attachedDocuments']['tmp_name'][$i];
            $documentPath = $targetDir.$filename.".".$ext;
            if (file_exists($documentPath)) {
                $response ->addError($filename . " already exists. Please rename the file and upload again.");
            }
            if(empty($response->error)){
                array_push($filesToUpload, array(
                    "name" => $temp_name,
                    "path" => $documentPath
                ));
                array_push($attachedDocuments, $documentPath);
            }
        }
    }
    else{
        $attachedDocuments = null;
    }
    
    return $attachedDocuments;
}

function commitUploadFiles(&$response, $filesToUpload){
    if(empty($response->error)){
        for($i = 0; $i < count($filesToUpload); $i ++){
            if(!move_uploaded_file($filesToUpload[$i]['name'],$filesToUpload[$i]['path'])){
                $response->addError("Error Failed while uploading files to the server.");
            }
        }
    }
}
