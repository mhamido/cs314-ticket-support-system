<?php 
    require_once "housekeepingdecorator.php";

    class catering extends housekeepingdecorator
    {
        private $HouseKeeping;

        public function __construct($HouseKeeping)
        {
            $this->HouseKeeping=$HouseKeeping;
        }

        public function description ()
        {

        }
        
        public function price ()
        {
           
        }
    }
?>