<?php
require_once '../model/user.php';
require_once '../model/database.php';
require_once '../model/BaseLandscape.php';
require_once '../model/basehousekeeping.php';
require_once '../model/laundry.php';
require_once '../model/catering.php';
require_once '../model/cleaning.php';
require_once '../model/garden.php';
require_once '../model/trimmer.php';
require_once '../model/pesticide.php';
require_once '../model/status.php';
require_once '../model/priority.php';
require_once '../validation.php';
require_once '../errorPage.php';

session_start();


$errs = array();

$user = $_SESSION["user"];

$unit = $_POST["unit"];
$title = $_POST["title"];
$description = $_POST["description"];
// $file = $_FILES["myfile"];

$service = NULL;
$canCreateTicket = false;

if (isset($_POST["landscaping"]) && isset($_POST["housekeeping"])) {
    displayError(array(
        'Cannot choose more than 1 service.'
    ));
} elseif (isset($_POST["landscaping"])) {
    $landscaping = new BaseLandscape();
    if (isset($_POST["pesticide"])) {
        $landscaping = new Pesticide($landscaping);
    }
    if (isset($_POST["trimmer"])) {
        $landscaping = new Trimmer($landscaping);
    }
    if (isset($_POST["garden"])) {
        $landscaping = new Garden($landscaping);
    }
    $service = $landscaping;
} elseif ($_POST["housekeeping"]) {
    $housekeeping = new BaseHousekeeping();
    if (isset($_POST["laundry"])) {
        $housekeeping = new Laundry($housekeeping);
    }
    if (isset($_POST["catering"])) {
        $housekeeping= new Catering($housekeeping);
    }
    if (isset($_POST["cleaning"])) {
        $housekeeping = new Cleaning($housekeeping);
    }
    $service = $housekeeping;
} else {
    displayError(array(
        'You must choose a service.'
    ));
}

$status = new Status(intval($_POST["status"]));
$priority = new Priority(intval($_POST["priority"]));


$ticket = $user->createTicket(
    $unit,
    $title,
    $description,
    $status,
    $priority
);

$ticket->service = $service;
$ticket->register($user);
$ticket->notify();

//var_dump($ticket);
//throw Exception("hi");
$_SESSION["ticket"] = $ticket;
header('Location: ../view/viewall.php');


// var_dump($user, $unit, $title, $service, $file);
// var_dump($_POST);
// var_dump($_FILES);