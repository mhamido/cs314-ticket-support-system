<?php

require_once '../model/service.php';
require_once '../model/database.php';
require_once '../errorPage.php';
session_start();

$errs = new ErrorPage();

$name = $_POST["name"];
$price = $_POST["price"];
$parent = $_POST["parent"];
$description = $_POST["description"];

$attributes = array();

if (filter_var($name, FILTER_SANITIZE_STRING) !== $name) {
    $errs->emit(ErrorMsg::INVALID_NAME);
}

if (filter_var($price, FILTER_VALIDATE_INT) !== intval($price)) {
    $errs->emit(ErrorMsg::INVALID_VALLUE);
}

if (filter_var($description, FILTER_SANITIZE_STRING) !== $description) {
    $errs->emit(ErrorMsg::INVALID_VALLUE);
}

if (filter_var($parent, FILTER_VALIDATE_INT) !== intval($parent)) {
    $errs->emit(ErrorMsg::INVALID_VALLUE);
}

if ($errs->empty()) {
    $service = Service::create(
        $name,
        $price,
        $description,
        $attributes,
        new Service($parent)
    );
    $_SESSION["service"] = $service;
}

$errs->redirect("../view/viewall.php");