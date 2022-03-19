<?php

Class Response{
    public array $result;
    public array $error; // Array of Strings
    
    function __construct() {
        $this -> result = array();
        $this -> error = array();
    }
    function addError($errorString){
        array_push($this -> error, $errorString);
    }
    
    function addResult($singleResult){
        array_push($this -> result, $singleResult);
    }
    
    function setResult(Array $results){
        $this -> result = $results;
    }
    
    function setError(Array $errors){
        $this -> error = $errors;
    }
}
