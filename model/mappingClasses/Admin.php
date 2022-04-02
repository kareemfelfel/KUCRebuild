<?php

Class Admin {
    public int $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    
    function __construct($row) {
        $this -> id = $row['ID'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> lastName = $row['LAST_NAME'];
        $this -> email = $row['EMAIL'];
        $this -> password = $row['PASSWORD'];
    }
}

