<?php
require_once '../model/database.php';
require_once '../model/ticket.php';

session_start();

$errs = array();
$ticket = $_SESSION["ticket"];
$user = $_SESSION["user"];


$unit = $_POST["unit"];
$title = $_POST["title"];
$description = $_POST["description"];

if (isset($unit))
    $ticket->unit = $unit;

if (isset($title))
    $ticket->title = $title;

if (isset($description))
    $ticket->description = $description;

if (isset($_POST["edit"])) {
    // var_dump($_POST);
    $ticket->update();
    $ticket->notify();
} elseif (isset($_POST["delete"])) {
    $ticket->notify();
    $ticket->delete();
}

header('Location: ../view/viewall.php');