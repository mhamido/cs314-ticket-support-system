<?php

require_once "entity.php";
require_once "service/option.php";
require_once "service/serviceOptionValue.php";

class Service extends ModifiableEntity
{
    public $price;
    public $parent;
    public $description;
    public $values;

    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM `service` WHERE id=?"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        assert($result);

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        $this->name = $result["name"];
        $this->price = $result["price"];
        $this->description = $result["description"];
        $this->parent = null;

        if ($result["parent_id"] != 0) {
            $this->parent = new Service($result["parent_id"]);
        }
        assert(!($this->parent instanceof stdClass));

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT service_option_value.id
                FROM service_option, service_option_value
                WHERE service_option.service_id=?
                AND service_option.id = service_option_value.service_option_id"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        assert($result);

        $result = $stmt->get_result();

        $this->values = array();

        while ($row = $result->fetch_assoc()) {
            $this->values[] = new Value($row["id"]);
        }
    }

    public function options()
    {
        $options = array();
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT option_id FROM `service_option` WHERE service_id=?"
        );
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        // var_dump($result->fetch_assoc());
        // exit(0);

        assert($result);
        
        while ($row = $result->fetch_assoc()) {
            $options[] = new Option($row["option_id"]);
        }

        return $options;
    }

    public static function create(
        $name,
        $price,
        $description,
        $values = array(),
        $parent = null
    ) {
        $parentId = 0;
        $serviceId = -1;
        $errs = new ErrorPage();

        if ($parent != null) {
            $parentId = $parent->id;
        }

        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO `service` (
                `name`,
                `description`,
                price,
                parent_id
            ) VALUES (?, ?, ?, ?)"
        );

        foreach ($values as $value) {
            if (!$value->type->validate($value)) {
                // TODO: Validate fields here, too.
                throw new Exception("TODO: Validation Error.");
            }
        }

        // Only execute the query if the
        // attributes & values are actually
        // valid.

        if ($errs->empty()) {
            $stmt->bind_param(
                'ssii',
                $name,
                $description,
                $price,
                $parentId
            );

            assert($stmt->execute());
            $serviceId = $stmt->insert_id;

            return new Service($serviceId);
        }

        $errs->displayErrors();
    }

    /**
     * @param Option $option
     * @param object $value
     * @return void
     */

    public function setValue($option, $newValue)
    {
        // See if this option already exists.
        $updated = false;
        foreach ($this->values as $attribute) {
            // This attribute is being modified.
            
            if ($attribute->option->id === $option->id) {
                // Validate the new value.
                $option = $attribute->option;
                $type = $option->type;
            
                if (!$attribute->set($newValue)) {
                    // Invalid value, return.
                    return false;
                }
            
                $updated = true;
            }
        }

        if ($updated) {
            $this->update();
            return true;
        }

        // Proclaim that this service now has 
        // the following option.

        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO `service_option` (
                service_id,
                option_id
            ) VALUES (?, ?)"
        );

        $stmt->bind_param('ii', $this->id, $option->id);
        assert($stmt->execute());

        $serviceOptionId = $stmt->insert_id;

        // Create a new value associated with
        // the option and this service.

        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO `service_option_value` (
                service_option_id,
                `value`
            ) VALUES (?, ?)"
        );

        // NOTE: Validate $value is Type
        $stmt->bind_param(
            'is', 
            $serviceOptionId, 
            strval($newValue)
        );
        
        assert($stmt->execute());

        $this->values[] = new Value($stmt->insert_id);
        return true;
    }

    public function perform()
    {
        throw new Error("TODO: Finish Service::perform");
    }

    protected function __update()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE `service` SET
                `name`=?,
                `description`=?,
                price=?,
                parent_id=?
            WHERE id=?"
        );

        $stmt->bind_param(
            'ssiii',
            $this->name,
            $this->description,
            $this->price,
            $this->parent->id,
            $this->id
        );

        foreach ($this->values as $value) {
            $stmt = DatabaseConnection::getInstance()->prepare(
                "UPDATE `service_option_value` SET
                    `value`=? WHERE id=?"
            );

            $stmt->bind_param(
                'si',
                strval($value),
                $value->id
            );

            assert($stmt->execute());
        }
    }

    public function isBase()
    {
        return $this->parent == null;
    }

    /**
     * @return Service[]
     */

    public static function fetch()
    {
        $services = array();

        $result = DatabaseConnection::getInstance()->query(
            "SELECT id FROM `service`"
        );

        while ($row = $result->fetch_assoc()) {
            $services[] = new Service($row["id"]);
        }

        return $services;
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "price":
                $this->price = /*intval*/ ($value);
                break;
            case "parent":
                $this->parent = $value;
                break;
            case "description":
                $this->description = $value;
                break;
            default:
                foreach ($this->values as $val) {
                    if (strcasecmp($val->option->name, $name) == 0) {
                        $val->set($value);
                        break;
                    }
                }
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case "price":
                return $this->price;
            case "parent":
                return $this->parent;
            case "description":
                return $this->description;
            default:
                foreach ($this->values as $val) {
                    if (strcasecmp($val->option->name, $name) == 0) {
                        return $val->get();
                    }
                }
        }
        return null;
    }

    public function summarize(
        &$result,
        &$visited
    ) {
        // We've already added this service 
        // to the itemized bill.

        foreach ($visited as $service) {
            if ($this->id == $service->id) return;
        }

        $visited[] = $this->id;

        // Include the base price
        $result[] = array($this->name, $this->price);

        return $result;
    }
}
