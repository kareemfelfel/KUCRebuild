<?php

class ToAdminTable {
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    
    function __construct(
            $firstName,
            $lastName,
            $username,
            $password
    ){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = $password;
    }
}
