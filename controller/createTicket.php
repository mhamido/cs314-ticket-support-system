<?php
session_start();

require_once '../model/database.php';

$errs = array();
$user = $_SESSION["user"];

$unit = $_POST["unit"];
$title = $_POST["title"];
$service = $_POST["description"];

if (isset($user, $unit, $title, $service)) {

}

$tickets = $user->getVisibleTickets();
