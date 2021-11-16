<?php
require_once '../model/database.php';
require_once '../model/ticket.php';

session_start();

$errs = array();
$user = $_SESSION["user"];
$ticket = $_SESSION["ticket"];

$unit = $_POST["unit"];
$title = $_POST["title"];
$description = $_POST["description"];

$edit = $_POST["edit"];
$delete = $_POST["delete"];

if (isset($unit))
    $ticket->unit = $unit;

if (isset($title))
    $ticket->title = $title;

if (isset($description))
    $ticket->description = $description;

if ($edit) {
    $ticket->update();
    $ticket->notify();
} elseif ($delete) {
    $ticket->delete();
}