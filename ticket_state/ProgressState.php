<?php

include_once 'State.php';
class ProgressState implements State {
     public function doAction($ticket) {
       // $ticket->setState(new ProgressState());
       $ticket->state_description = "ticket in progress";
       $ticket->setState(new Resolved());
       
    }
}
