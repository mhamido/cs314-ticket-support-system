<?php

require_once 'database.php';

class LookupClass 
{
    private $tableName;
    public function id() {}
    public function name() {}
}

class Priority extends LookupClass
{
    private $id;
    private $name;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM `priority` WHERE `priority`.P_id=?"
        );

        $stmt->bind_param('i', $id);

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
