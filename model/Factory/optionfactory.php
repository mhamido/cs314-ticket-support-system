<?php
require_once "SortingStrategy/sortinterface.php";
require_once "SortingStrategy/sortbydate.php";
require_once "SortingStrategy/sortbyid.php";
require_once "SortingStrategy/sortbyname.php";
require_once "SortingStrategy/sortbypriority.php";
require_once "SortingStrategy/sortinterface.php";

class OptionFactory
{
    public function createsort($type)
    {
        switch ($type) {
            case "name":
                $sorter = new SortByName();
                break;
            case "id":
                $sorter = new SortById();
                break;
            case "date":
                $sorter = new SortByDate();
                break;
            case "priority":
                $sorter = new SortByPriority();
                break;
        }
        return $sorter;
    }
}
