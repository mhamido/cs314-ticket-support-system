<?php
class Comment
{
    public $id;
    public $author;
    public $created;
    public $body;

    public function __construct($id)
    {
    }

    public static function get($id)
    {
        $obj = new Comment(false);
        $stmt = DatabaseConnection::getInstance()->prepare("SELECT * FROM comment WHERE comment.C_id=?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) return NULL;

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $obj->id = $id;
            $obj->author = new User($row["Author"]);
            $obj->created = $row["creationDate"];
            $obj->body = $row["body"];
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
