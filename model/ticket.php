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
    private $description;
    private $dateCreated;
    private $comments;
    // private $assignee;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM ticket WHERE ticket.T_id=?"
        );

        $stmt->bind_param('s', $id);
        $result = $stmt->execute();

        if (!$result) return;

        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) return;

        $this->id = $result["id"];
        $this->unit = $result["unit"];

        throw new Exception("TODO:");

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM ticketcomment WHERE ..."
        );

        $stmt->bind_param('s', $id);

        $result = $stmt->execute();

        if (!$result) return;

        $result = $stmt->get_result();

        $this->comments = array();

        while ($commentID = $result->fetch_row()) {
            $this->comments[] = new Comment($commentID);
        }
    }

    public function update()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE ticket SET 
                ticket.unit=?,
                ticket.title=?,
                ticket.description=?"
        );

        $stmt->bind_param(
            'ssss',
            $this->unit,
            $this->title,
            $this->description
        );

        return $stmt->execute();
    }

    public function delete()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "DELETE FROM ticket WHERE ticket.T_id = ?"
        );

        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }
}
