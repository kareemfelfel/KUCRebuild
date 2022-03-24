<?php

class Columbarium extends BasicPlotInfo{
    public $sectionNumber;
    public $nicheType;
    public $columbariumType; 
    
    
    function __construct($row){
        parent::__construct($row);
        $this -> sectionNumber = $row['SECTION_NUMBER'];
    }
    function setNicheType($row){
        $updatedRow['ID'] = $row['NT_ID'];
        $updatedRow['TYPE'] = $row['NT_TYPE'];
        $this -> nicheType = new Type($updatedRow);
    }
    function setColumbariumType($row){
        $updatedRow['ID'] = $row['CT_ID'];
        $updatedRow['TYPE'] = $row['CT_TYPE'];
        $this -> columbariumType = new Type($updatedRow);
    }
}

