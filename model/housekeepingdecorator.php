<?php 
require_once 'houseKeeping.php';
abstract class HousekeepingDecorator extends Housekeeping
{
    abstract public function price();
    abstract public function description();
}
