<?php
include_once 'State.php';
class On_hold implements State {
    
    public function doAction($ticket) {
       // $ticket->setState(new On_hold());
       $ticket->state_description = "ticket on hold";
       $ticket->setState(new ProgressState());
        
    }
}
