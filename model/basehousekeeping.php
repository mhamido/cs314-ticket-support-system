<?php 
require_once "housekeepingdecorator.php";

class BaseHousekeeping extends Housekeeping
{
    public function __construct()
    {
    }

    public function description()
    {
        return "Base Housekeeping Fees";
    }
    
    public function price()
    {
        return 25;
    }

    public function perform()
    {
    }
}
