<?php

class ToAdminTable {
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    
    function __construct(
            $firstName,
            $lastName,
            $email,
            $password
    ){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }
}
