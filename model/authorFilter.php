<?php
require_once "filterDecorator.php";

class AuthorFilter extends FilterDecorator
{
    public $name;
    private $filter;
    public function __construct($filter)
    {
        $this->name = $name;
        $this->filter = $filter;
    }
    public function generate()
    {
 
        return  $this->filter->generate()." AND user.display_name LIKE '{$this->name}'";
    }
}
