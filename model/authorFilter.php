<?php
require_once "filterDecorator.php";

class AuthorFilter extends FilterDecorator
{
    public $name;
    public function __construct($filter,$name)
    {
        $this->name = $name;
        $this->filter = $filter;
    }
    public function generate()
    {
        return  $this->filter->generate()." AND ticket.id IN (SELECT ticket.id FROM ticket, user WHERE ticket.author = user.id AND user.display_name LIKE '{$this->name}')";
    }
}
