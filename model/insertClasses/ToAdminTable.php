<?php

class ToAdminTable {
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    
    function __construct(
            $id,
            $firstName,
            $lastName,
            $username,
            $password
    ){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = $password;
    }
}
