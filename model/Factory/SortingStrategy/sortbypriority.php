<?php
include_once '../user.php';

class SortByPriority implements SortInterface{

  
public function Sort($tickets){

    usort($tickets, function($a, $b)
    {
        if ($a->priority==$b->priority)
        {
        
            return 0;
        }
        else if ($a->priority > $b->priority)
        {
            
            return -1;
        }
        else {
                      
            return 1;
        }
    });}
}
?>