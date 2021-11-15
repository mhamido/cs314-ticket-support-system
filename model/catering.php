<?php 
    require_once "housekeepingdecorator.php";

    class catering extends housekeepingdecorator
    {
        public $food;
        public $softdrinks;
        private $housekeeping;

        public function __construct($housekeeping)
        {
            $this->housekeeping=$housekeeping;
        }

        public function description ()
        {
            return "catering serves"+ $this->housekeeping->description();
        }
        
        public function price ()
        {
            return 5 + $this->housekeeping->price();
        }
    }
?>