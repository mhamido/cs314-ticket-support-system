<?php
require_once '../model/user.php';
require_once '../model/database.php';
require_once '../model/status.php';
require_once '../model/priority.php';
require_once '../validation.php';
require_once '../errorPage.php';
require_once '../model/service.php';
require_once '../model/adapter.php';

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

if (empty($services) || sizeof($services) > 1) {
    $errs->emit(ErrorMsg::INVALID_SERVICES_SELECTED);
} else {
    $service = $services[0];
    $status = new Status(intval($_POST["status"]));
    $priority = new Priority(intval($_POST["priority"]));

    $ticket = $user->createTicket(
        $unit,
        $title,
        $description,
        $status,
        $priority,
        $service
    );

    $ticket->service = $service;
    $ticket->register($user);
    $ticket->notify();
    $_SESSION["ticket"] = $ticket;
    $_SESSION["service"] = $service;
    $createpdf = new createpdf();
    $mpdfadaptor = new mpdfadapter($createpdf, $user, $ticket);
    $mpdfadaptor->notify();
}

$errs->redirect("../view/fillOptions.php");
