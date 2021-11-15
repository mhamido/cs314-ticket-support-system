<?php

require_once 'database.php';

class Priority
{
    private $id;
    private $name;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT `priority`.P_id FROM `priority` WHERE `priority`.P_id=?"
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

    public static function create($name)
    {
        
    }

    public static function delete($name)
    {

    }
}
