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
// WILL BE STORED IN SESSION
class User {
    public $userType = UserType::GUEST;
    public $admin = null;
    public $accessibleModules = array();

   public function addAccessibleModule($module){
      array_push($this->accessibleModules, $module);
   }

   public function setUserType($type ){
      $this->userType = $type;
   }
   
   public function setAdmin(Admin $admin){
       $this->admin = $admin;
   }
}
