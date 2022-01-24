<?php
include_once 'State.php';
class Resolved implements State {
    
    public function doAction($ticket) {
       // $ticket->setState(new Resolved());
        $ticket->state_description = "ticket resolved";
    }
}
