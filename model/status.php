<?php

require_once 'database.php';

class Status
{
    private $id;
    private $name;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT `status`.`Name` FROM `status` WHERE `status`.S_id=?"
        );

        $result = $stmt->execute();

        if (!$result) return;

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        $this->name = $result["Name"];
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }
}
