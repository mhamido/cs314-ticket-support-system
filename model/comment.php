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
            $this->created= $obj["creationDate"];
            $this->body = $obj["body"];
            $this->Ticket_id = $obj["T_id"];
        }
    }

    

    
}
?>
