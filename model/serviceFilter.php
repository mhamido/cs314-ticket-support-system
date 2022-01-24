<?php
require_once "filterDecorator.php";

class ServiceFilter extends FilterDecorator
{
    public $serviceId;
    public function __construct($filter,$serviceId)
    {
        $this->filter = $filter;
        $this->serviceId = $serviceId;
    }

    public function generate()
    {
        return  $this->filter->generate()." AND ticket.service_id={$this->serviceId}";
    }
}
