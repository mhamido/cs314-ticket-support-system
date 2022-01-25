<?php
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

    public static function create($user, $name, $contents, $parent)
    {
        $pid = 0;
        if ($parent != null) $pid = $parent->id;

        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO theme (`name`, `content`, `author_id`, `parent_id`)
            VALUES (?, ?, ?)"
        );

        $stmt->bind_param(
            'ssii',
            $name,
            $contents,
            $user->id,
            $pid
        );

        $stmt->execute();
        return new Theme($stmt->insert_id);
    }

    public static function get($user)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT id FROM theme WHERE author_id=? ORDER BY id DESC"
        );

        $uid = $user->id;
        $stmt->bind_param('i', $uid);
        assert($stmt->execute());
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Theme($row["id"]);
        }
        return null;
    }

    /**
     * @return string
     */
    public function linkStyle()
    {
        $theme = $this;
        $result = array();
        while ($theme != null) {
            $contents = str_replace(
                array("<style>", "</style>", "<script>", "</script>"),
                "",
                $theme->contents
            );
            $result[] = "<style>{$contents}</style>";
            $theme = $theme->parent;
        }
        return join("\n", array_reverse($result));
    }
}
