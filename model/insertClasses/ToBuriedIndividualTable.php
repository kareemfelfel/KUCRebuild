<?php

class ToBuriedIndividualTable {
    public $firstName;
    public $middleName;
    public $maidenName;
    public $lastName;
    public $dob;
    public $dod;
    public ?int $veteran;
    public $obituary;
    public $nickname;
    
    function __construct(
            $firstName,
            $middleName,
            $maidenName,
            $lastName,
            $dob,
            $dod,
            $veteran,
            $obituary,
            $nickname
    )
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->maidenName = $maidenName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->dod = $dod;
        $this->veteran = $veteran? 1: 0;
        $this->obituary = $obituary;
        $this->nickname = $nickname;
    }
}
