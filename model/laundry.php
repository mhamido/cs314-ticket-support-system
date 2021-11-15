<?php 
require_once "housekeepingdecorator.php";

class Laundry extends HousekeepingDecorator
{
    public $numberofclothes;
    public $laudryproducts;
    private $housekeeping;

    public function __construct($housekeeping)
    {
        $this->housekeeping=$housekeeping;
    }

    public function description ()
    {
        return "laundry serves"+ $this->housekeeping->description();
    }
    
    public function price ()
    {
        return 3 + $this->housekeeping->price();
    }
    public function perform(){


   throw new Exception("TODO:");

    }
}