<?php
require_once "../model/database.php";
require_once "../errorPage.php";
session_start();

$errs = $_SESSION["errs"];
$language = $_POST["language"];

if (!isset($_POST["language"])) $language = 1;

$errs->language = $language;
$errs->displayErrors();
