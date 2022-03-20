<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Helper Function for add Tomb and add Columbarium
function processMainImageUpload(&$response){
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
        else{
            move_uploaded_file($temp_name,$mainImagePath);
        }      
    }
    else{
        // Set To null
        $mainImagePath = null;
    }
    
    return $mainImagePath;
}

// Helper Function for add Tomb and add Columbarium
function processAttachedDocumentsUpload(&$response){
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
            else{
                move_uploaded_file($temp_name,$documentPath);
                array_push($attachedDocuments, $documentPath);
            }
        }
    }
    else{
        $attachedDocuments = null;
    }
    
    return $attachedDocuments;
}
