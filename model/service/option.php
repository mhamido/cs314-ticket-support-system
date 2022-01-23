<?php
require_once '../type.php';
require_once '../entity.php';
require_once '../database.php';

class Option extends NamedEntity
{
    public $type;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM options WHERE id=?"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        assert($result);

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        $this->name = $result["name"];
        $this->type = new Type($result["type_id"]);
    }
}
