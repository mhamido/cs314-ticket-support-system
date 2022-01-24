<?php
include_once '../user.php';
class SortByName implements SortInterface{


  



public function Sort($tickets){

    usort($tickets, function($a, $b)
    {
        if ($a->name==$b->name)
        {
        
            return 0;
        }
        else if ($a->name > $b->name)
        {
            
            return -1;
        }
        else {
                      
            return 1;
        }

    });}

    
}

?>