<?php

class BasicPlotInfo{
    public $id;
    public $forSale;
    public $purchaseDate;
    public $price;
    public $mainImage;
    public $attachments; // will need to be initialized separately Array of links
    public Owner $owner; // Will need to be initialized separately
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> forSale = ($row['FOR_SALE'] == 1? true : false);
        $this -> purchaseDate = $row['PURCHASE_DATE'];
        $this -> price = $row['PRICE'];
        $this -> mainImage = $row['MAIN_IMAGE'];
        
    }
}
