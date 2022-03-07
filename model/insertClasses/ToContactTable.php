<?php

class ToContactTable {
    public $firstName;
    public $lastName;
    public $email;
    public $title;
    public $phoneNumber;
    
    function __construct(         
        $firstName,
        $lastName,
        $email,
        $title,
        $phoneNumber
    ){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->title = $title;
        $this->phoneNumber = $phoneNumber;
    }
}
