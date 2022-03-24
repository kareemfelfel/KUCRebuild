<?php

Class Contact{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $title;
    public $phoneNumber;
    
    function __construct($row) {
        $this -> id = $row['ID'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> lastName = $row['LAST_NAME'];
        $this -> email = $row['EMAIL'];
        $this -> title = $row['TITLE'];
        $this -> phoneNumber = $row['PHONE_NUMBER'];
    }
    
    function stripCountryCodeFromPhoneNumber(){
        $this-> phoneNumber = substr($this->phoneNumber, 2);
    }
}

