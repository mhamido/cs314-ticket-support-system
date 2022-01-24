<?php
require_once 'filter.php';
class DispatcherFilter extends Filter
{
    public function __construct()
    {

    }
    public function generate()
    {
        return "SELECT * FROM ticket WHERE TRUE";
    }
}
