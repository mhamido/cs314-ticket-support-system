<?php
include_once '../user.php';

class SortByDate implements SortInterface{

  

public function Sort($tickets){

    usort($tickets, function($a, $b)
    {
        if ($a->dateCreated==$b->dateCreated)
        {
        
            return 0;
        }
        else if ($a->dateCreated > $b->dateCreated)
        {
            
            return -1;
        }
        else {
                      
            return 1;
        }
    });}
}
?>