<?php
require_once 'subject.php';
require_once 'comment.php';
require_once 'status.php';
require_once 'comment.php';
require_once 'priority.php';

class Ticket implements Subject
{
    public $id;
    public $unit;
    public $title;
    public $status;
    public $service;
    public $priority;
    public $author;
    public $description;
    public $dateCreated;
    public $comments;
    public $observers = array();


    public function __construct($id)
    {
        $this->observers = array();
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM ticket WHERE ticket.T_id=?"
        );

        $stmt->bind_param('s', $id);
        $result = $stmt->execute();

        if (!$result) return;

        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) return;

        // var_dump($result);
        $this->id = $id;
        $this->unit = $result["unit"];
        $this->title = $result["title"];

        $this->status = new Status($result["S_id"]);
        $this->priority = new Priority($result["P_id"]);
        $this->description = $result["description"];
        $this->author = new User($result["Author_id"]);
        $this->dateCreated = $result["create_date"];
        $comment = Comment::get($result["C_id"]);

        if ($comment) {
            $this->comments = array($comment);
        } else {
            $this->comments = array();
        }

        $result = $stmt->execute();

        if (!$result) return;

        $result = $stmt->get_result();

        $this->comments = array();

        while ($commentID = $result->fetch_row()) {
            // $this->comments[] = new Comment($commentID);
        }
    }

    public function update()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE ticket SET 
                ticket.unit=?,
                ticket.title=?,
                ticket.description=?
            WHERE ticket.T_id=?"
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

    public function delete()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "DELETE FROM ticket WHERE ticket.T_id = ?"
        );

        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }

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
}
