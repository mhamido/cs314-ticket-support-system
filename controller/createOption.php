<?php
require_once "../errorPage.php";
require_once "../model/database.php";
require_once "../model/service/option.php";

$errs = new ErrorPage();
$type = $_POST["create_option_type"];
$name = $_POST["create_option_name"];

$name = filter_var($name, FILTER_SANITIZE_STRING);
$type = filter_var($type, FILTER_VALIDATE_INT);

if (!$name) {
    $errs->emit(ErrorMsg::INVALID_NAME);
}

if (!$type) {
    $errs->emit(ErrorMsg::INVALID_VALLUE);
}

if ($errs->empty()) {
    Option::create(
        $type, 
        $name
    );
}

$errs->redirect("../view/createService.php");