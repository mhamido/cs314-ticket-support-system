<?php

require_once "./entity.php";
require_once "./database.php";

class Theme extends NamedEntity
{
    public $contents;
    public $parent;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM theme where id=?"
        );

        $stmt->bind_param('i', $id);
        assert($stmt->execute());

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        $this->name = $result["name"];
        $this->contents = $result["contents"];
        $this->parent = null;

        if ($result["parent"] != 0) {
            $this->parent = new Theme($result["parent"]);
        }
    }

    /**
     * @return string
     */
    public function link() {
        $theme = $this;
        $result = array();
        while ($theme != null) {
            $contents = str_replace("<style>$theme->contents;
            if ($contents->contain)
            $result[] = "<s>{$contents}</style>";
        }
    }
}