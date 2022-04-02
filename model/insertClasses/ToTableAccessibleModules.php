<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ToTableAccessibleModules
 *
 * @author karee
 */
class ToTableAccessibleModules {
    public $guestAccess;
    public $module;
    
    function __construct($module, $guestAccess) {
        $this->module = $module;
        $this->guestAccess = $guestAccess? 1: 0;
    }
}
