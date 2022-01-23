<?php

require_once "entity.php";

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

    public static function create(
        $name,
        $price,
        $description,
        $attributes = array(),
        $parent = NULL
    ) {
        $parentId = 0;
        $serviceId = -1;
        $errs = new ErrorPage();
    
        if ($parent != NULL) {
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

        foreach ($attributes as $optionName => $fields) {
            [$type, $value] = $fields;
            if (!$type->validate($value)) {
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

    public function perform()
    {
        throw new Error("TODO: Finish Service::perform");
    }

    protected function __update()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE `service` SET (
                `name`,
                `description`,
                price,
                parent_id
            ) VALUES (?, ?, ?, ?)"
        );

        throw new Error("TODO: Finish Service::__update");
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
    )
    {
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
