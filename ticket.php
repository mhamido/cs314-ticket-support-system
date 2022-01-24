<?php
require_once 'subject.php';
require_once 'comment.php';
require_once 'status.php';
require_once 'priority.php';
require_once 'service.php';

class Ticket implements Subject
{
    public $id;
    public $unit;
    public $title;
    public $status;
    public $priority;
    public $description;
    public $service;
    public $author;
    public $comments;
    public $dateCreated;
    public $State;
    public $state_description;

    public $observers = array();
    public function __construct($id)
    {
        $this->observers = array();
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM ticket WHERE ticket.id=?"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) return;

        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) return;

        // var_dump($result);
        $this->id = $id;
        $this->unit = $result["unit"];
        $this->title = $result["title"];
        $this->description = $result["description"];
        $this->author = new User($result["author"]);
        $this->status = new Status($result["status_id"]);
        $this->priority = new Priority($result["priority_id"]);
        $this->service = new Service($result["service_id"]);
        // $this->dateCreated = $result["created_at"];
        $this->dateCreated = date('d/m/y', time());

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT comment.id FROM comment WHERE comment.ticket_id=?"
        );
        $stmt->bind_param('i', $id);
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
                ticket.description=?
            WHERE ticket.id=?"
        );

        $stmt->bind_param(
            'sssi',
            $this->unit,
            $this->title,
            $this->description,
            $this->id
        );

        return $stmt->execute();
    }

    // public function delete()
    // {
    //     $stmt = DatabaseConnection::getInstance()->prepare(
    //         "DELETE FROM ticket WHERE ticket.T_id = ?"
    //     );

    //     $stmt->bind_param('i', $this->id);
    //     return $stmt->execute();
    // }

    public function register($observer)
    {
        $this->observers[] = $observer;
    }

    public function remove($observer)
    {
        $i = 0;
        foreach ($this->observers as $current) {
            if ($current === $observer)
                unset($observers[$i]);
            $i++;
        }
    }

    public function notify()
    {
        // var_dump($this);
        foreach ($this->observers as $obs) {
            // var_dump($obs);
            $obs->send($this);
        }
    }

    public function setState($State)
    {
        $this->State = $State;
    }
    public function getState()
    {
        return $this->State;
    }
    public function getDescription()
    {
        return $this->description;
    }

}
