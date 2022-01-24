<?php

require_once "./database.php";
require_once "./entity.php";

class Language extends LookupTable
{
    public function __construct($id)
    {
        parent::__construct($id, "language");
    }
}