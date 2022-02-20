<?php

class ColumbariumFilter{
    public ?int $columbariumId = null;
    public ?int $columbariumTypeId = null;
    public ?int $forSale = null;
    public ?int $nicheTypeId = null;
    public ?int $sectionLetterId = null;
    public ?int $sectionNumber = null;
    public ?int $ownerId = null;
    public ?array $buriedIndividualIds = null;
    
    public function setColumbariumId($id){
        $this -> columbariumId = $id;
    }
    
    public function setColumbariumTypeId($id){
        $this -> columbariumTypeId = $id;
    }
    
    public function setForSale(bool $param){
        $this -> forSale = ($param ? 1: 0);
    }
    
    public function setNicheTypeId($id){
        $this -> nicheTypeId = $id;
    }
    
    public function setSectionLetterId($id){
        $this -> sectionLetterId = $id;
    }
    
    public function setSectionNumber($num){
        $this -> sectionNumber = $num;
    }
    
    public function setOwnerId($id){
        $this -> ownerId = $id;
    }
    
    public function setBuriedIndividualIds(array $ids){
        $this -> buriedIndividualIds = $ids;
    }
}

