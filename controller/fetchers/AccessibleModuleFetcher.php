<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function fetchAccessibleModules(){
    $response = getAccessibleModules();
    if(!empty($response->result)){
        $searchLotObject = current(
            array_filter($response->result, function($obj){
                return $obj->module == Module::LOT_SEARCH;
            })
        );
        
        $searchColumbariumObject = current(
            array_filter($response->result, function($obj){
                return $obj->module == Module::COLUMBARIUM_SEARCH;
            })
        );
            
        $response->setResult(
            array(
                "searchLot" => $searchLotObject ? $searchLotObject->guestAccess : false,
                "searchColumbarium" => $searchColumbariumObject ? $searchColumbariumObject->guestAccess : false
            )
        );
    }
    
    echo json_encode(get_object_vars($response));  
}

function editAccessibleModule(){
    $response = new Response();
   
    // Getting all REQUEST data
    $data = json_decode($_POST['request']);
    $module = !empty($data->module) ? $data->module : null;
    $guestAccess = !empty($data->guestAccess) ? $data->guestAccess : null;
    if(!isset($module)){
        $response->addError("Module is not set.");
    }
    
    
    if(empty($response->error)){
        $obj = new ToTableAccessibleModules($module, $guestAccess);
        $modalResponse = updateAccessibleModule($obj);
        $response->setResult($modalResponse->result);
        $response->setError($modalResponse->error);
    }
    echo json_encode(get_object_vars($response));  
}

