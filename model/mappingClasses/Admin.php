<?php

Class Admin {
    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    
    function __construct($row) {
        $this -> id = $row['ID'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> lastName = $row['LAST_NAME'];
        $this -> username = $row['USERNAME'];
        $this -> password = $row['PASSWORD'];
    }
}

