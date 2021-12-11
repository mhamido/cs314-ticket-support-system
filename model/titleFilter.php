<?php
require_once "filterDecorator.php";

class TitleFilter extends FilterDecorator
{
    public $title;
    private $Filter;
    public function __construct($Filter)
    {
        $this->Filter = $Filter;
    }

    public function generate()
    {

        //return "title".$this->Filter->generate();
    }
}
