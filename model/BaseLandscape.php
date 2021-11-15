<?php
require_once '../model/landscaping.php';
class BaseLandscape extends Landscaping
{
    public function __construct()
    {
    }

    public function price()
    {
        // TODO: Load values dynamically from
        // the database perhaps?
        return 20;
    }

    public function description()
    {
        return "Basic Landscaping Services";
    }
}
