<?php

require_once "entity.php";
require_once "database.php";
require_once "user.php";

class Report extends NamedEntity
{
    public $user;
    public $sql;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM report WHERE id=?"
        );

        $stmt->bind_param('i', $id);
        assert($stmt->execute());

        $result = $stmt->get_result()->fetch_assoc();
        $this->user = new User($result["user_id"]);
        $this->sql = $result["sql_stmt"];
    }

    /**
     * @return mysqli_result|bool
     */

    public function run()
    {
        return DatabaseConnection::getInstance()->query($this->sql);
    }
}
