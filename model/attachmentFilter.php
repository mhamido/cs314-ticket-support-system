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
          return  $this->filter->generate(). "SELECT * FROM tickets WHERE TRUE AND EXISTS (SELECT * FROM attachment WHERE Trueattachment.ticket_id='{$this->ticket->id}')";
          
    }
}
