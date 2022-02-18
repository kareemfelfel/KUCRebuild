<?php

Class Response{
    public $result;
    public $error; // Array of Strings
    
    function addError($errorString){
        if(!isset($this -> error)){
            $this -> error = array();
        }
        array_push($this -> error, $errorString);
    }
}
