<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ToTableColumbarium
 *
 * @author kareem
 */
class ToTableColumbarium {
    public int $columbariumTypeId;
    public int $nicheTypeId;
    public int $sectionLetterId;
    public int $sectionNumber;
    public $mainImage;
    public $price;
    public int $forSale;
    public $purchaseDate;
    public ?int $ownerId;
    public ?array $attachedDocuments;
    public ?array $buriedIndividualIds;
    
    public function __construct(
            $columbariumTypeId,
            $nicheTypeId,
            $sectionLetterId,
            $sectionNumber,
            $mainImage,
            $price,
            $forSale,
            $purchaseDate,
            $ownerId,
            $attachedDocuments,
            $buriedIndividualIds
    ) {
        $this->columbariumTypeId = $columbariumTypeId;
        $this->nicheTypeId = $nicheTypeId;
        $this->sectionLetterId = $sectionLetterId;
        $this->sectionNumber = $sectionNumber;
        $this->price = $price;
        $this->mainImage = $mainImage;
        $this->forSale = $forSale? 1: 0;
        $this->purchaseDate = $purchaseDate;
        $this->ownerId = $ownerId;
        $this->attachedDocuments = $attachedDocuments;
        $this->buriedIndividualIds = $buriedIndividualIds;
    }
}
