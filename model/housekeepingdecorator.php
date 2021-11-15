<?php 
    abstract class housekeepingdecorator implements housekeeping
    {
        abstract public function description ();
        abstract public function price ();
    }
?>