<?php
require_once 'entity.php';

class Type extends LookupTable
{
    public function __construct($id)
    {
        parent::__construct($id, "type");
    }
}