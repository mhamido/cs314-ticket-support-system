<?php
require_once '../model/user.php';
require_once '../model/database.php';
require_once '../model/BaseLandscape.php';
require_once '../model/basehousekeeping.php';

session_start();


$errs = array();
$user = $_SESSION["user"];

$unit = $_POST["unit"];
$title = $_POST["title"];
$description = $_POST["description"];
// $file = $_FILES["myfile"];

$landscaping = $_POST["landscaping"];
$pesticide = $_POST["pesticide"];

$canCreateTicket = false;

if (isset($landscaping) && isset($housekeeping)) {
    displayError(array(
        'Cannot choose more than 1 service.'
    ));
} elseif (isset($landscaping)) {
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
    $canCreateTicket = true;
} elseif (isset($housekeeping)) {
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
    $canCreateTicket = true;
}

if ($canCreateTicket) {
    $ticket = $user->createTicket(
        $unit,
        $title,
        $serv, 
        $description
    );

    $_SESSION["ticket"] = $ticket;
    header('Location: ../viewticket.php')
}


// var_dump($user, $unit, $title, $service, $file);
var_dump($_POST);
// var_dump($_FILES);