<?php 
require_once "housekeepingdecorator.php";

class BaseHousekeeping extends Housekeeping
{
    public function description()
    {
        return "Base Housekeeping Fees";
    }
    
    public function price()
    {
        return 0.5 + $this->housekeeping->price();
    }

    public function perform()
    {
        throw new Exception("TODO:");
    }
}
