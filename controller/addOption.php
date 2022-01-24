<?php

require_once '../errorPage.php';
require_once '../model/service.php';
require_once '../model/service/option.php';

$errs = new ErrorPage();
$serviceID = $_POST["service"];
$optionID = $_POST["option"];
$value = $_POST["value"];

if (!($value = filter_var($value, FILTER_SANITIZE_STRING))) {
    $errs->emit(ErrorMsg::INVALID_VALLUE);
}

if ($errs->empty()) {
    $option = new Option($optionID);
    $service = new Service($serviceID);

    if (!$option->type->validate($value)) {
        $errs->emit(ErrorMsg::INVALID_VALLUE);
    } else {
        $service->setValue($option, $value);
    }
}

$errs->redirect("../view/viewall.php");
