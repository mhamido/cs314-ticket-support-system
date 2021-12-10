<?php
require_once 'ticket.php';
class Comment
{
    public $id;
    public $parent;
    public $contents;
    public $author;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM comment WHERE comment.id=?"
        );
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) return NULL;

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {

            $this->id = $id;
          //  $this->ticket = new Ticket($row["ticket_id"]);
            if ($row["parent_id"] != 0) {
                $this->parent = new Comment($row["parent_id"]);
            } else {
                $this->parent = null;
            }
            $this->contents = $row["contents"];
            $this->author = $row["author"];
        }
    }

    
}
