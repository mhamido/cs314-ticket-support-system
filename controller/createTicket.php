<?php
require_once '../model/user.php';
require_once '../model/database.php';
require_once '../model/status.php';
require_once '../model/priority.php';
require_once '../validation.php';
require_once '../errorPage.php';
require_once '../model/service.php';

session_start();

$errs = new ErrorPage();
$user = $_SESSION["user"];
$unit = $_POST["unit"];
$title = $_POST["title"];
$description = $_POST["description"];
// $file = $_FILES["myfile"];

$services = array();
$canCreateTicket = false;

foreach (Service::fetch() as $service) {
    if (isset($_POST[$service->name])) {
        $services[] = $service;
    }
}

if (!empty($services)) {
    $errs->add("You must select >= 1 services!");
} else {
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
    header('Location: ../invoice.php');

    // var_dump($user, $unit, $title, $service, $file);
    // var_dump($_POST);
    // var_dump($_FILES);
}
