<?php
require_once 'option.php';
require_once '../entity.php';
require_once '../database.php';

/**
 * @deprecated ServiceOption.
 */

class ServiceOption extends Entity
{
    public $option;
    public $service;
    
    public function __construct($id)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT *
            FROM service_option
            WHERE id=?"
        );

        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($result = $stmt->get_result()->fetch_assoc()) {
            $this->service = new Service($result["service_id"]);
            $this->option = new Option($result["option_id"]);
        }

        $this->id = $id;
    }
}