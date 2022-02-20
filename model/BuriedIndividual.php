<?php

class BuriedIndividual{
    public int $id;
    public $firstName;
    public $middleName;
    public $maidenName;
    public $lastName;
    public $dob;
    public $dod;
    public bool $veteran;
    public $obituary;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> dob = $row['DOB'];
        $this -> dod = $row['DOD'];
        $this -> lastName = $row['LAST_NAME'];
        $this -> maidenName = $row['MAIDEN_NAME'];
        $this -> middleName = $row['MIDDLE_NAME'];
        $this -> obituary = $row['OBITUARY'];
        $this -> veteran = ($row['VETERAN'] == 1 ? true : false);
    }
}

