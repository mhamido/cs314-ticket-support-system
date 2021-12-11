<?php 
require_once 'filter.php';
abstract class FilterDecorator extends Filter
{
    abstract public function generate();
    
}
