<?php

class Ticket
{
    private $id;
    private $unit;
    private $title;
    private $status;
    private $service;
    private $priority;
    private $author;
    // private $assignee;
    private $description;
    private $dateCreated;
    private $comments;

    public function __construct($id)
    {
        throw new Exception('TODO');
    }
}
