<?php
require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/user.php';
require_once '../model/database.php';
session_start();

$errs = new ErrorPage();
$email = $_POST["e_mail"];
$password = $_POST["Password"];
$displayName = $_POST["DisplayName"];
$confirmPassword = $_POST["ConfirmPassword"];

if (isNullOrEmpty($displayName)) {
    $errs->add("Display name cannot be empty.");
}

if (isNullOrEmpty($email) || !isValidEmail($email)) {
    $errs->add("Invalid email address: $email.");
}

if (isNullOrEmpty($password) || isNullOrEmpty($confirmPassword)) {
    $errs->add("Passwords cannot be empty!");
} elseif ($password !== $confirmPassword) {
    $errs->add("Passwords do not match.");
}

if ($errs->empty()) {
    // Ensure that such a user doesn't exist already.
    $stmt = DatabaseConnection::getInstance()->prepare(
        "SELECT user.id FROM user WHERE user.email=?"
    );

    $stmt->bind_param('s', $email);
    $result = $stmt->execute();

    if ($result) {
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            User::create($email, $password, $displayName);
            $usr = User::login($email, $password);
            $_SESSION["user"] = $usr;
        } else {
            $errs->add(
                "User with email '$email' already exists."
            );
        }
    }
}

$errs->redirect("../index.php");
