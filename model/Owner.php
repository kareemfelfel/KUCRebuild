<?php

class Owner{
    public $id;
    public $firstName;
    public $middleName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $address;
    
    function __construct($row) {
        $this -> id = $row['ID'];
        $this -> address = $row['ADDRESS'];
        $this -> email = $row['EMAIL'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> lastName = $row['LAST_NAME'];
        $this -> middleName = $row['MIDDLE_NAME'];
        $this -> phoneNumber = $row['PHONE_NUMBER'];
    }
}

