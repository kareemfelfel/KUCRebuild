<?php

Class ColumbariumAttachment extends Attachment{
    function __construct($row) {
        $this -> id = $row['COLUMBARIUM_ID'];
        $this -> link = $row['LINK'];
    }
}

