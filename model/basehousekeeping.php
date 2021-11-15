<?php 
    require_once "housekeepingdecorator.php";

    class basehousekeeping extends housekeeping
    {

        function description ()
        {
            return "Housekeeping fees";
        }
        
        function price ()
        {
           return 0.5 + $this->housekeeping->price();
        }
    }
?>