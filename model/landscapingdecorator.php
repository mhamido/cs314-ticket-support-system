<?php
require_once 'landscaping.php';
class LandscapingDecorator extends Landscaping
{
    public function price()
    {
        return 0;
    }

    public function description()
    {
        return "";
    }
}
