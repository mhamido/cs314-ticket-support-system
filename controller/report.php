<?php
require_once "../model/user.php";
require_once "../model/database.php";
require_once "../errorPage.php";
require_once "../model/filter.php";
require_once "../model/report.php";

session_start();
var_dump($_POST);

$errs = new ErrorPage();
$user = $_SESSION["user"];
$filter = $user->filter;

$reportName = $_POST["report_name"];

foreach (LookupTable::fetch("status") as $status) {
    [$id, $name] = $status;
    if (isset($_POST[$status->name])) {
        // $filter = new StatusF
        // TODO: Status filter
    }
}

foreach (LookupTable::fetch("priority") as $priority) {
    [$id, $name] = $priority;
    if (isset($_POST[$priority->name])) {
        // TODO: Priority filter
    }
}

if (isset($_POST["ticket_author_name"])) {
    $name = filter_var(
        $_POST["ticket_author_name"],
        FILTER_SANITIZE_STRING
    );
    $filter = new AuthorFilter($filter, $name);
}

if (isset($_POST["services"])) {
    
}