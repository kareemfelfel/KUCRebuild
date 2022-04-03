<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessibleModules
 *
 * @author karee
 */
class AccessibleModule {
    public $module;
    public $id;
    public $decription;
    public $guestAccess;
    
    function __construct($row) {
        $this->module = $row['MODULE'];
        $this->id = $row['ID'];
        $this->description = $row['DESCRIPTION'];
        $this->guestAccess = $row['GUEST_ACCESS'] == 1? true : false;
    }
}
