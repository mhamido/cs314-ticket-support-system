<?php
require_once 'entity.php';

class Type extends LookupTable
{
    public function __construct($id)
    {
        parent::__construct($id, "type");
    }

    public function validate($value) {
        switch (strtolower($this->name)) {
            case "integer":
                return ($value == 0) || filter_var($value, FILTER_VALIDATE_INT);
            case "double":
                return filter_var($value, FILTER_VALIDATE_FLOAT);
            case "string":
                return filter_var($value, FILTER_SANITIZE_STRING);
            case "boolean":
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }
    }
    
    // Common types, preinstantiated for ease of use.
    
    public static function int() {
        return new Type(1);
    }
    
    public static function double() {
        return new Type(2);
    }
    
    public static function string() {
        return new Type(3);
    }
    
    public static function boolean() {
        return new Type(4);
    }
}