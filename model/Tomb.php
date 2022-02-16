<?php

class Tomb extends BasicPlotInfo{
    public TombSectionLetter $sectionLetter;
    public $lotNumber;
    public $has_open_plots;
    public $longitude;
    public $latitude;
    public $buriedIndividuals; // list of BuriedIndividual datatype
}
