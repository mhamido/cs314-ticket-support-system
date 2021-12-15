<?php
require_once 'ticket.php';
class Attachment
{
    public $id;
    public $url;
    //public $ticket;

    public function __construct($id)
    {
        if (!$id) return;

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM attachment WHERE attachment.id=?"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) {
            die("Attachment with $id not found.");
            return;
        }

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        //$this->ticket = new Ticket($result["ticket_id"]);
        $this->url = $result["url"];
    }

   
}
