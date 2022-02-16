<?php

/**
 * SINGLETON CLASS
 * 
 * this class connects to the database and returns con object.
 * Class should only be used through functions.php
 * @author: Kareem Felfel
 */
class connection{
    // protected variables
    private $dsn = 'mysql:host=localhost;dbname=kuc_db';
    private $username = 'root';
    private $password = '';
    protected $con;
    // the instance of this class
    public static $instance;
    //get instance function
    public static function getInstance()
    {
        // if the class is not instantiated at all
        // meaning if instance is null
        if(!isset($instance))
        {
            connection::$instance = new connection();
            
        }
        return self::$instance;
    }
    private function __construct() 
    {
        try 
        {
                $this -> con = new PDO($this->dsn, $this->username, $this->password);
        } 
        catch (PDOException $e) 
        {
            $errorMessage = $e->getMessage();
            include '../view/error/error.php';
            die;
	}
    }
    //connect to mysql database
    function get_connection()
    {
        if($this -> con)
        {
            //return connected if linked
            return $this -> con;
        }
        else
        {
            $errorMessage = "Failed to get access to the database";
            include '../view/error/error.php';
            die;
        }
    }
}

