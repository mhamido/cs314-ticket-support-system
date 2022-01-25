<?php

require_once '../errorPage.php';
require_once '../model/service.php';
require_once '../model/service/option.php';

$errs = new ErrorPage();
$serviceID = $_POST["service"];
$optionID = $_POST["option"];

if ($errs->empty()) {
    $option = new Option($optionID);
    $service = new Service($serviceID);

    $stmt = DatabaseConnection::getInstance()->prepare(
        "INSERT INTO service_option (service_id, option_id) VALUES (?, ?)"
    );
    
    $stmt->bind_param('ii', $serviceID, $optionID);
    $stmt->execute();
}

$errs->redirect("../view/viewall.php");
