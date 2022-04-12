<?php

class Tomb extends BasicPlotInfo{
    public $lotNumber;
    public $hasOpenPlots;
    public $longitude;
    public $latitude;
    public $notes;
    public $plotNums;
    
    function __construct($row) {
        parent::__construct($row);
        $this -> lotNumber = $row['LOT_NUMBER'];
        $this -> hasOpenPlots = ($row['HAS_OPEN_PLOTS'] == 1? true : false);
        $this -> longitude = floatVal($row['LONGITUDE']);
        $this -> latitude = floatVal($row['LATITUDE']);
        if(isset($row['PLOT_NUMS'])){
            $stringPlotNums = str_replace(" ", "", $row['PLOT_NUMS']);
            $plotNums = array_map("intval", explode(",", $stringPlotNums));
            $this->plotNums = $plotNums;
        }
        else{
            $this->plotNums = array();
        }
        $this->notes = $row['NOTES'];
    }
}
