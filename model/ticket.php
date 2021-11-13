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
        $query = "SELECT * FROM ticket WHERE ticket.T_id = $id";
        $result = DatabaseConnection::getInstance()->query($query);

        // TODO: Create if not exists.
        foreach ($result as $obj) {
            $this->id = $obj["id"];
            $this->unit = $obj["unit"];
            // $this->title = $obj["title"];
            // $this->status = $obj["status"];
            // $this->service = $obj["service"];
            // $this->priority = $obj["id"];
            // $this->author
            $this->description = $obj["description"];
            $this->dateCreated = $obj["create_date"];
        }
    }

    public function update()
    {
        $query = "UPDATE ticket SET ticket.unit=?, ticket.title=?, ticket.description=?, ticket.create_date=?";
        $result = DatabaseConnection::getInstance()->query($query);

        
    }

    public static function fetchAll()
    {
        $tickets = array();
        // Fetch tickets, most recently created first.
        $fetchStmt = "SELECT ticket.T_id FROM ticket ORDER BY ticket.create_date DESC";
        $result = DatabaseConnection::getInstance()->query($fetchStmt);

        if (!$result) {
            return $tickets;
        }

        foreach ($result as $id) {
            $tickets[] = new Ticket($id);
        }

        return $tickets;
    }
}
