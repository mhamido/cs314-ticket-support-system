<?php


class Attachment
{
    public $id;
    public $url;

    public function __construct($id)
    {
        if (!$id) return;

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM attachment WHERE Attachment_id=?"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) {
            die("Attachment with $id not found.");
            return;
        }

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        $this->url = $result["URL"];
    }

    public function update()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE attachment SET 
                `URL`=?, "
        );

        $stmt->bind_param("s", $this->url);
        return $stmt->execute();
    }

    public function delete()
    {
        $stmt = DatabaseConnection::getInstance()->prepare("DELETE FROM attachment WHERE  Attachment_id=?");
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    public static function create($url)
    {
        $type_id = 1;
        $now = date_create()->format('Y-m-d H:i:s');
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO attachment (
                `URL`
            ) VALUES (?)"
        );

        $stmt->bind_param('s', $url);
        return $stmt->execute();
    }
}
