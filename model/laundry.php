<?php 
    require_once "housekeepingdecorator.php";

    class laundry extends housekeepingdecorator
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
    }
?>