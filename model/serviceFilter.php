<?php
require_once "filterDecorator.php";

class ServiceFilter extends FilterDecorator
{
    public $sname;
    public function __construct($filter,$sname)
    {
        $this->filter = $filter;
        $this->sname = $sname;
    }

    public function generate()
    {
        return  $this->filter->generate()." AND ticket.id IN (SELECT ticket.id FROM ticket, service WHERE ticket.service_id = service.id AND service.name LIKE '{$this->sname}'")
    }
}
