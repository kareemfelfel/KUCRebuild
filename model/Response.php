<?php

Class Response{
    public array $result;
    public array $error; // Array of Strings
    
    function addError($errorString){
        if(!isset($this -> error)){
            $this -> error = array();
        }
        array_push($this -> error, $errorString);
    }
    
    function addResult($singleResult){
        if(!isset($this -> result)){
            $this -> result = array();
        }
        if($singleResult != null){
            array_push($this -> result, $singleResult);
        }
    }
}
