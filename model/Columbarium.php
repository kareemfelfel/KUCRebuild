<?php

class Columbarium extends BasicPlotInfo{
    public ColumbariumSectionLetter $sectionLetter; // Will need to be initialized seperately
    public $sectionNumber;
    public NicheType $nicheType; // Will need to be initialized seperately
    public ColumbariumType $columbariumType; // Will need to be initialized seperately
    public $buriedIndividuals; // Will need to be initialized seperately Array of BurriedIndividual type
    
    
    function __construct($row){
        parent::__construct($row);
        $this -> sectionNumber = $row['SECTION_NUMBER'];
    }
}

