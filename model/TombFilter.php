<?php


class TombFilter{
    public ?int $tombId = null;
    public ?int $sectionLetterId = null;
    public ?int $lotNumber = null;
    public ?bool $hasOpenPlots = null;
    public ?bool $forSale = null;
    public ?int $ownerId = null;
    public ?array $buriedIndividualIds = null;
    
    public function setTombId($id){
        $this -> tombId = $id;
    }
    public function setSectionLetterId($id){
        $this -> sectionLetterId = $id;
    }
    
    public function setLotNumber($num){
        $this -> lotNumber = $num;
    }
    
    public function setHasOpenPlots(bool $param){
        $this -> hasOpenPlots = ($param ? 1 : 0);
    }
    
    public function setForSale(bool $param){
        $this -> forSale = ($param ? 1 : 0);
    }
    
    public function setOwnerId($id){
        $this -> ownerId = $id;
    }
    
    public function setBuriedIndividualIds(array $ids){
        $this -> buriedIndividualIds = $ids;
    }
}

