<?php
require_once(__DIR__ . "\..\\type.php");
require_once(__DIR__ . "\..\\entity.php");
require_once(__DIR__ . "\..\\database.php");
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

    /**
     * @param Type $type
     * @param string $name
     * @return Option
     */

    public static function create($typeid, $name)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO `options` (
                `type_id`, 
                `name`
            ) VALUES (?, ?)"
        );

        $stmt->bind_param('is', $typeid, $name);
        assert($stmt->execute());
        return new Option($stmt->insert_id);
    }

    public static function fetch()
    {
        $options = array();
        $stmt = DatabaseConnection::getInstance()->query(
            "SELECT * FROM options"
        );

        assert($stmt);

        while ($row = $stmt->fetch_assoc()) {
            $options[] = new Option($row["id"]);
        }

        return $options;
    }
}
