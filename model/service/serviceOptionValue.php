<?php
require_once 'option.php';

class Value extends Entity
{
    /**
     * @var object $value
     * @var Option $option
     */
    public $value;
    public $option;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT service_option_value.value as `value`,
                    service_option.option_id as `option_id`
            FROM service_option_value, service_option
            WHERE service_option_value.id=? AND 
                service_option_value.service_option_id = service_option.id"
        );
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        
        assert($result);
        $result = $stmt->get_result()->fetch_assoc();

        $this->value = $result["value"];
        $this->option = new Option($result["option_id"]);
    }

    /**
     * @return bool
     */
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

    public function __toString()
    {
        return strval($this->value);
    }
}
