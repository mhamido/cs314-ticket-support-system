<?php 
    require_once "housekeepingdecorator.php";
    
    class cleaning extends housekeepingdecorator
    {

        public $steamingprice;
        public $drycleaningprice;
        private $housekeeping;

        public function __construct($housekeeping)
        {
            $this->housekeeping=$housekeeping;
        }

        public function perform()
        {
            
        }

        public function description ()
        {
            return "cleaning;" . $this->housekeeping->description();
        }
        
        public function price ()
        {
           return 8 + $this->housekeeping->price();
        }
    }
?>
