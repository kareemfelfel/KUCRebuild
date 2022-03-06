<?php

class ToBuriedIndividualTable {
    public $firstName;
    public $middleName;
    public $maidenName;
    public $lastName;
    public $dob;
    public $dod;
    public ?bool $veteran;
    public $obituary;
    public ?int $tombId;
    public ?int $columbariumId;
    
    function __construct(
            $firstName,
            $middleName,
            $maidenName,
            $lastName,
            $dob,
            $dod,
            $veteran,
            $obituary,
            $tombId,
            $columbariumId
    )
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->maidenName = $maidenName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->dod = $dod;
        $this->veteran = $veteran? 1: 0;
        $this->tombId = $tombId;
        $this->columbariumId = $columbariumId;
    }
}
