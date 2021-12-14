<?php
require_once "filterDecorator.php";

class AttachmentFilter extends FilterDecorator
{
    public $ticket;
    public function __construct($filter, $ticket)
    {
        $this->filter = $filter;
        $this->ticket = $ticket;
    }

    public function generate()
    {
          return  $this->filter->generate(). " AND EXISTS (SELECT * FROM attachment WHERE attachment.ticket_id='{$this->ticket->id}')";

    }
}
