<?php 
    require_once "housekeepingdecorator.php";
    
    class Cleaning extends housekeepingdecorator
    {

        public $steamingprice;
        public $drycleaningprice;
        private $housekeeping;

        public function __construct($housekeeping)
        {
            $this->housekeeping=$housekeeping;
        }

        public function description ()
        {
            return "cleaning serves"+ $this->housekeeping->description();
        }
        
        public function price ()
        {
           return 8 + $this->housekeeping->price();
        }
    }
?>