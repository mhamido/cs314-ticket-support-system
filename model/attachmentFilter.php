<?php
require_once "filterDecorator.php";

class AttachmentFilter extends FilterDecorator
{
    public $ticket;
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function generate()
    {
          return  $this->filter->generate(). " AND EXISTS (SELECT * FROM attachment WHERE attachment.ticket_id='{$this->ticket->id}')";
          
    }
}
