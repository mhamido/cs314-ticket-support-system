<?php 
    require_once "housekeepingdecorator.php";
    
    class Cleaning extends housekeepingdecorator
    {
        private $housekeeping;

        public function __construct($housekeeping)
        {
            $this->housekeeping=$housekeeping;
        }

        public function description ()
        {
            
        }
        
        public function price ()
        {
           return 8 + $this->HouseKeeping;
        }
    }
?>