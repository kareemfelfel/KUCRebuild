<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author karee
 */
class User {
    public $userType = UserType::GUEST;
    public ?Admin $admin = null;
    public Array $accessibleModules = array();
    public static $instance;
    
    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new User();
            
        }
        return self::$instance;
    }

   public function addAccessibleModule($module){
      array_push($this->accessibleModules, $module);
   }

   public function setUserType(UserType $type ){
      $this->userType = $type;
   }
   
   public function setAdmin(Admin $admin){
       $this->admin = $admin;
   }
}
