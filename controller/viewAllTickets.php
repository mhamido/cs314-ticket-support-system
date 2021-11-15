<?php
session_start();

$usr = $_SESSION["user"];
$tickets = $usr->getVisibleTickets();

foreach ($tickets as $ticket) {
}
