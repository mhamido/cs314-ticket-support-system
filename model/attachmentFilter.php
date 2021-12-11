<?php
require_once "filterDecorator.php";

class AttachmentFilter extends FilterDecorator
{
    public $ticket;
    private $filter;
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function generate()
    {
          return  $this->filter->generate()."AND IF EXISTS (SELECT * FROM WHERE attachment.ticket_id='{$this->ticket->id}')";
          
    }
}
