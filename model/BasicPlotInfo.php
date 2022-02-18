<?php

class BasicPlotInfo{
    public $id;
    public SectionLetter $sectionLetter;
    public $forSale;
    public $purchaseDate;
    public $price;
    public $mainImage;
    public $attachments; // will need to call addAttachment from each child class
    public Owner $owner;
    public $buriedIndividuals; // Will need to call addBuriedIndividual with a row of Buried Individual data from table 'buried_individuals'
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> forSale = ($row['FOR_SALE'] == 1? true : false);
        $this -> purchaseDate = $row['PURCHASE_DATE'];
        $this -> price = $row['PRICE'];
        $this -> mainImage = $row['MAIN_IMAGE'];
    }
    
    function setOwner($row){
        $updatedRow['ID'] = $row['OWNR_ID'];
        $updatedRow['ADDRESS'] = $row['OWNR_ADDRESS'];
        $updatedRow['EMAIL'] = $row['OWNR_EMAIL'];
        $updatedRow['FIRST_NAME'] = $row['OWNR_FIRST_NAME'];
        $updatedRow['LAST_NAME'] = $row['OWNR_LAST_NAME'];
        $updatedRow['MIDDLE_NAME'] = $row['OWNR_MIDDLE_NAME'];
        $updatedRow['PHONE_NUMBER'] = $row['OWNR_PHONE_NUMBER'];
        $this -> owner = new Owner($updatedRow);
    }
    
    function addBuriedIndividual($row){
        if(!isset($this -> buriedIndividuals)){
            $this -> buriedIndividuals = array();
        }
        array_push($this -> buriedIndividuals, new BuriedIndividual($row));
    }
    
    function setSectionLetter($row){
        $updatedRow['ID'] = $row['SL_ID'];
        $updatedRow['SECTION_LETTER'] = $row['SL_SECTION_LETTER'];
        $this -> sectionLetter = new SectionLetter($updatedRow);
    }
}
