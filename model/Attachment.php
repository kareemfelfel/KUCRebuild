<?php

Class Attachment{ // NOTE this class encapsulates both tables 'columbarium_attachments' and 'tomb_attachments'
    public $id;
    public $link;
    
    function __construct($row) {
        $this -> id = $row['ID'];
        $this -> link = $row['LINK'];
    }
}

