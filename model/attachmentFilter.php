<?php
require_once "filterDecorator.php";

class AttachmentFilter extends FilterDecorator
{
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function generate()
    {
        return  $this->filter->generate(). " AND EXISTS (SELECT * FROM attachment WHERE attachment.ticket_id=ticket.id')";
    }
}
