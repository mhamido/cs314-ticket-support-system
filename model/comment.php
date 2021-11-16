<?php
class Comment
{
    public $id;
    public $author;
    public $created;
    public $body;
    public $Ticket_id;

    public function __construct($id)
    {
        $query = "SELECT * FROM comment WHERE comment.C_id = $id";
        $result = DatabaseConnection::getInstance()->query($query);


        foreach ($result as $obj) {
            $this->id = $obj["C_id"];
            $this->author = $obj["Author"];
            $this->created = $obj["creationDate"];
            $this->body = $obj["body"];
            $this->Ticket_id = $obj["T_id"];
        }
    }

    public function update()
    {
        $query = "UPDATE comment SET comment.Author=?, ticket.creationDate=?, ticket.body=?,T_id=?";
        $result = DatabaseConnection::getInstance()->query($query); //singleton
    }

    public static function create()
    {
        $Allcomments = array();
        $Stmt = "SELECT comment.C_id FROM comment ORDER BY ticket.creationDate DESC";
        $result = DatabaseConnection::getInstance()->query($Stmt);
    }
    public function delete()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "DELETE FROM comment WHERE comment.C_id = ?"
        );

        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }
}
