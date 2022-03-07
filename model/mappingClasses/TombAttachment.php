<?php

Class TombAttachment extends Attachment{
    function __construct($row) {
        $this -> id = $row['TOMB_ID'];
        $this -> link = $row['LINK'];
    }
}
