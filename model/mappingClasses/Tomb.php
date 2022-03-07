<?php

class Tomb extends BasicPlotInfo{
    public int $lotNumber;
    public bool $hasOpenPlots;
    public $longitude;
    public $latitude;
    
    function __construct($row) {
        parent::__construct($row);
        $this -> lotNumber = $row['LOT_NUMBER'];
        $this -> hasOpenPlots = ($row['HAS_OPEN_PLOTS'] == 1? true : false);
        $this -> longitude = $row['LONGITUDE'];
        $this -> latitude = $row['LATITUDE'];
    }
}
