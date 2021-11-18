<?php
require_once '../model/ticket.php';
require_once '../model/user.php';
session_start();

// var_dump($_GET);
$ticket_id = $_GET["ticket_id"];
$_SESSION["ticket"] = new Ticket($ticket_id);
header('Location: ../viewticket.php');