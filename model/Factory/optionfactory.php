<?php

include_once '../user.php';
class OptionFactory{

public function createsort($type){

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





?>