<?php
include_once 'State.php';
class Neww implements State {
    
    public function doAction($ticket) {
       // $ticket->setState(new Neww());
       $ticket->state_description = "new ticket";
       $ticket->setState(new On_hold());
       
    }
}
