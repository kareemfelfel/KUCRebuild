<?php

class Tomb extends BasicPlotInfo{
    public $lotNumber;
    public $hasOpenPlots;
    public $longitude;
    public $latitude;
    
    function __construct($row) {
        parent::__construct($row);
        $this -> lotNumber = $row['LOT_NUMBER'];
        $this -> hasOpenPlots = $row['HAS_OPEN_PLOTS'];
        $this -> longitude = $row['LONGITUDE'];
        $this -> latitude = $row['LATITUDE'];
    }
    
    function addAttachment($row){
        if(!isset($this -> attachments)){
            $this -> attachments = array();
        }
        $updatedRow['ID'] = $row['TOMB_ID'];
        $updatedRow['LINK'] = $row['LINK'];
        array_push($this -> attachments, new Attachment($row));
    }
}
