<?php

Class Admin {
    public int $id;
    public $firstName;
    public $lastName;
    public $userName;
    public $password;
    
    function __construct($row) {
        $this -> id = $row['ID'];
        $this -> firstName = $row['FIRST_NAME'];
        $this -> lastName = $row['LAST_NAME'];
        $this -> username = $row['USERNAME'];
        $this -> password = $row['PASSWORD'];
    }
}

