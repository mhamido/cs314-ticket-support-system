<?php
require_once 'option.php';
require_once '../entity.php';

class Value extends Entity
{
    public $value;
    public $option;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM service_option_value WHERE id=?"
        );
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        
        assert($result);
        $result = $stmt->get_result()->fetch_assoc();

        $this->value = $result["value"];
        $this->option = new Option($result["service_option_id"]);
    }

    private function validate($value)
    {
        return $this->option->type->validate($value);
    }

    /** @return bool */
    public function set($value)
    {
        if (!$this->validate($value)) {
            return false;
        }

        $this->value = $value;
        return true;
    }

    public function get()
    {
        return $this->value;
    }
}
