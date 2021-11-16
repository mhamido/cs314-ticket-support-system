<?php
require_once 'subject.php';

function serviceFromId($id)
{
    $stmt = DatabaseConnection::getInstance()->prepare(
        "SELECT service_type_name FROM `service type` WHERE `service type`.serv_id=?"
    );

    $stmt->bind_param('i', $id);
    $result = $stmt->execute();

    if (!$result) return NULL;

    $result = $stmt->get_result()->fetch_assoc()["service_type_name"];

    switch ($result) {
        case 'BaseLandscape':

            break;
        case 'BaseHousekeeping':
            
            break;
        case 'Garden':
            
            break;
        case 'Trimmer':
            
            break;
        case 'Pesticide':
            
            break;
        case 'Catering':
            
            break;
        case 'Laundry':
            
            break;
        case 'Cleaning':
            break;
        default: 
            return NULL;
    }
}
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
    // private $assignee;
    private $observers = array();


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

        $this->id = $id;
        $this->unit = $result["unit"];
        $this->title = $result["title"];

        $this->status = new Status($result["S_ID"]);
        $this->priority = new Priority($result["P_ID"]);
        $this->description = $result["description"];
        $this->author = new User($result["Author_id"]);
        $this->dateCreated = $result["create_date"];
        $this->service = serviceFromId($id);
        $this->comments = array(new Comment($result["C_id"]));

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
                ticket.description=?"
        );

        $stmt->bind_param(
            'sss',
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
        foreach ($this->observers as $obs) {
            $obs->send($this);
        }
    }
}
