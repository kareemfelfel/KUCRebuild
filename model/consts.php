<?php

// These are asbtract classes because PHP 8.0 does not support enums
abstract class UserType{
    const GUEST = 'Guest';
    const ADMIN = 'Admin';
}

//All modules that are available for a GUEST
//They must have the same value as the values in the database table accessible_modules
abstract class Module{
    const HOME = 'Home';
    const CONTACT_US = 'ContactUs';
    const LOT_SEARCH = 'LotSearch';
    const LOGIN = 'Login';
    const COLUMBARIUM_SEARCH = 'ColumbariumSearch';
}