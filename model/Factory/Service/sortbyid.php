<?php
include_once '../user.php';

class SortById implements SortInterface{

public function Sort($tickets){


    usort($tickets, function($a, $b)
    {
        if ($a->id==$b->id)
        {
        
            return 0;
        }
        else if ($a->id > $b->id)
        {
            
            return -1;
        }
        else {
                      
            return 1;
        }
    });}

}

?>