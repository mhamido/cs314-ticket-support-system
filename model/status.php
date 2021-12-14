<?php
require_once 'entity.php';

class Status extends LookupTable
{
    public function __construct($id)
    {
        parent::__construct($id, "status");
    }
}
