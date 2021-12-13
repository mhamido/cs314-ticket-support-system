<?php 
require_once 'filter.php';
abstract class FilterDecorator extends Filter
{
        private $filter;
    abstract public function generate();
    
}
