<?php

class BuriedIndividual{
    public ?int $id;
    public $firstName;
    public $middleName;
    public $maidenName;
    public $lastName;
    public $nickname;
    public $dob;
    public $dod;
    public ?bool $veteran;
    public $obituary;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> dob = isset($row['DOB']) ? date("m-d-Y", strtotime($row['DOB'])) : null;
        $this -> dod = isset($row['DOD']) ? date("m-d-Y", strtotime($row['DOD'])) : null;
        $this -> lastName = $row['LAST_NAME'];
        $this -> maidenName = $row['MAIDEN_NAME'];
        $this -> middleName = $row['MIDDLE_NAME'];
        $this -> nickname = $row['NICKNAME'];
        $this -> obituary = $row['OBITUARY'];
        if($row['VETERAN'] != null)
            $this -> veteran = ($row['VETERAN'] == 1 ? true : false);
    }
}

