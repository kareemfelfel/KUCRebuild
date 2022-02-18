<?php

class Columbarium extends BasicPlotInfo{
    public $sectionNumber;
    public Type $nicheType;
    public Type $columbariumType; 
    
    
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
    function addAttachment($row){
        if(!isset($this -> attachments)){
            $this -> attachments = array();
        }
        $updatedRow['ID'] = $row['COLUMBARIUM_ID'];
        $updatedRow['LINK'] = $row['LINK'];
        array_push($this -> attachments, new Attachment($row));
    }
}

