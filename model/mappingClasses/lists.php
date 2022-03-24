<?php

class Type{ // This class encapsulates both tables 'columbarium_types' and 'niche_types'
    public $id;
    public $type;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> type = $row['TYPE'];
    }
}
class SectionLetter{ // This class encapsulates both tables 'columbarium_section_letters' and 'tomb_section_letters'
    public $id;
    public $letter;
    
    function __construct($row){
        $this -> id = $row['ID'];
        $this -> letter = $row['SECTION_LETTER'];
    }
}
