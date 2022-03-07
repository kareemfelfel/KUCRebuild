<?php

class ToOwnerTable {
    public $firstName;
    public $lastName;
    public $middleName;
    public $address;
    public $phoneNumber;
    public $email;
    
    function __construct(
        $firstName,
        $lastName,
        $middleName,
        $address,
        $phoneNumber,
        $email
    ){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }
}
