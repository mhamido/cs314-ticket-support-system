<?php
require_once '../errorPage.php';
require_once '../model/service.php';
require_once '../model/service/option.php';
session_start();

$errs = new ErrorPage();
$service = $_SESSION["service"];

$shouldUpdate = true;
foreach ($service->options() as $option) {
    if (!isset($_POST[strval($option->id)])) {
        $errs->emit(ErrorMsg::INVALID_VALLUE);
        $shouldUpdate = false;
        continue;
    }

    $value = $_POST[strval($option->id)];
    $isValid = $option->type->validate($value);
    
    if (!$isValid) {
        $errs->emit(ErrorMsg::INVALID_VALLUE);
        $shouldUpdate = false;
    }
}
if ($shouldUpdate && $errs->empty()) {
    foreach ($service->options() as $option) {
        $value = $_POST[strval($option->id)];
        $service->setValue($option, $value);
    }
    $service->update();
}

$errs->redirect("../invoice.php");
