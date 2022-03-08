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
    
    function __construct(
            $firstName,
            $middleName,
            $maidenName,
            $lastName,
            $dob,
            $dod,
            $veteran,
            $obituary
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
    }
}
