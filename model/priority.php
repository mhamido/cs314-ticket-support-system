<?php
require_once 'entity.php';

class Priority extends LookupTable
{
    public function __construct($id)
    {
        parent::__construct($id, "priority");
    }
}
