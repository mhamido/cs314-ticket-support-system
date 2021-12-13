<?php
require_once "filterDecorator.php";

class ServiceFilter extends FilterDecorator
{
    public $ticket;
    public function __construct($Filter)
    {
        $this->Filter = $Filter;
    }

    public function generate()
    {
        return  $this->filter->generate()."AND IF EXISTS (SELECT * FROM service WHERE service.id='{$this->ticket->id}')";
        
    }
}
