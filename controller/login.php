<?php

require_once '../validation.php';
require_once '../model/database.php';

$errs = array();
$email = $_POST["email"];
$password = $_POST["password"];

if (isNullOrEmpty($email) || !isValidEmail($email)) {
    $errs[] = "Invalid email address: '$email'";
}

if (isNullOrEmpty($password)) {
    $errs[] = "Invalid Password: '$password'";
}

if (empty($errs)) {
    echo "Attempted to login with $email and $password";
} else {
    foreach ($errs as $err) {
        echo "Error: $err <br>";
    }
}
