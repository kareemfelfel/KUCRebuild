<?php

class Tomb extends BasicPlotInfo{
    public $lotNumber;
    public $hasOpenPlots;
    public $longitude;
    public $latitude;
    
    function __construct($row) {
        parent::__construct($row);
        $this -> lotNumber = $row['LOT_NUMBER'];
        $this -> hasOpenPlots = ($row['HAS_OPEN_PLOTS'] == 1? true : false);
        $this -> longitude = floatVal($row['LONGITUDE']);
        $this -> latitude = floatVal($row['LATITUDE']);
    }
}
