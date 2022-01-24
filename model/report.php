<?php

require_once "entity.php";
require_once "database.php";
require_once "user.php";

class Report extends NamedEntity
{
    public $user;
    public $sql;
    private $tickets;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM report WHERE id=?"
        );

        $stmt->bind_param('i', $id);
        assert($stmt->execute());

        $result = $stmt->get_result()->fetch_assoc();
        $this->id = $id;
        $this->user = new User($result["user_id"]);
        $this->name = $result["name"];
        $this->sql = $result["sql_stmt"];
        $this->tickets = array();
    }

    public static function create($name, $user, $sql)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO report (
                `name`,
                `user_id`,
                sql_stmt
            ) VALUES (?, ?, ?)"
        );

        $stmt->bind_param('sis', $name, $user->id, $sql);
        assert($stmt->execute());
        return new Report($stmt->insert_id);
    }

    public static function fetch($userid)
    {
        $reports = array();
        $stmt = DatabaseConnection::getInstance()->prepare("SELECT id FROM report WHERE `user_id`=?");
        $stmt->bind_param('i', $userid);
        assert($stmt->execute());
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $reports[] = new Report($row["id"]);
        }
        return $reports;
    }

    public function run()
    {
        $rows = DatabaseConnection::getInstance()->query($this->sql);
        
        while ($row = $rows->fetch_assoc()) {
            $this->tickets[] = new Ticket($row["id"]);
        }
        include("../viewreport.php");
    }
}
