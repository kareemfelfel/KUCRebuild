<?php

class BasicPlotInfo{
    public $id;
    public $sectionLetter;
    public $forSale;
    public $purchaseDate;
    public $price;
    public $mainImage;
    public $attachments; // will need to call setAttachments with an array of the appropriate attachment class
    public $owner;
    public $buriedIndividuals; // Will need to call setBuriedIndividuals with an array of Buried Individuals data from table 'buried_individuals'
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> forSale = ($row['FOR_SALE'] == 1? true : false);
        $this -> purchaseDate = isset($row['PURCHASE_DATE']) ? date("m-d-Y", strtotime($row['PURCHASE_DATE'])) : null;
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
    
    function setBuriedIndividuals(array $buriedIndividuals){
        $this -> buriedIndividuals = $buriedIndividuals;
    }
    
    function setAttachments(array $attachments){
        $this->attachments = $attachments;
    }
    
    function setSectionLetter($row){
        $updatedRow['ID'] = $row['SL_ID'];
        $updatedRow['SECTION_LETTER'] = $row['SL_SECTION_LETTER'];
        $this -> sectionLetter = new SectionLetter($updatedRow);
    }
}
