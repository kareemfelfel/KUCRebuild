<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * used for mapping POST and PUT tomb related data to the table
 *
 * @author kareem
 */
class ToTableTomb {
    public $sectionLetterId;
    public $lotNumber;
    public $price;
    public $mainImage;
    public $forSale;
    public $hasOpenPlots;
    public $purchaseDate;
    public $ownerId;
    public $longitude;
    public $latitude;
    public $attachedDocuments;
    public $buriedIndividualIds;
    
    public function __construct(
            $sectionLetterId,
            $lotNumber,
            $price,
            $mainImage,
            $forSale,
            $hasOpenPlots,
            $purchaseDate,
            $ownerId,
            $longitude,
            $latitude,
            $attachedDocuments,
            $buriedIndividualIds
    ) {
        $this->sectionLetterId = $sectionLetterId;
        $this->lotNumber = $lotNumber;
        $this->price = $price;
        $this->mainImage = $mainImage;
        $this->forSale = $forSale? 1: 0;
        $this->hasOpenPlots = $hasOpenPlots? 1: 0;
        $this->purchaseDate = $purchaseDate;
        $this->ownerId = $ownerId;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->attachedDocuments = $attachedDocuments;
        $this->buriedIndividualIds = $buriedIndividualIds;
       
    }
}
