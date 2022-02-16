<?php

class NicheType{
    public $id;
    public $type;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> type = $row['TYPE'];
    }
}
class ColumbariumType{
    public $id;
    public $type;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> type = $row['TYPE'];
    }
}
class ColumbariumSectionLetter{
    public $id;
    public $letter;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> letter = $row['SECTION_LETTER'];
    }
}
class TombSectionLetter{
    public $id;
    public $letter;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> letter = $row['SECTION_LETTER'];
    }
}
