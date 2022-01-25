<?php
require_once "../model/ticket.php";
require_once "../model/service.php";
session_start();

$ticket = $_SESSION["ticket"];
$ticket->nextState();
echo("Ticket is now at state: " . $ticket->getDescription());

?>

<form action="../view/viewall.php" method="POST">
    <input type="submit" value="Homepage">
</form>
