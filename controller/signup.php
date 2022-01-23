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

if (isset($_POST["language"])) {
    $errs = new ErrorPage($_POST["language"]);
} else {
    $errs = new ErrorPage();
}

if (Validation::isNullOrEmpty($displayName)) {
    // $errs->add("Display name cannot be empty.");
    $errs->emit(ErrorMsg::INVALID_NAME);
}

if (Validation::isNullOrEmpty($email) || !Validation::isValidEmail($email)) {
    $errs->emit(ErrorMsg::INVALID_EMAIL);
}

if (
    Validation::isNullOrEmpty($password) ||
    Validation::isNullOrEmpty($confirmPassword) ||
    $password !== $confirmPassword
) {
    $errs->emit(ErrorMsg::INVALID_PASSWORD);
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
            $errs->emit(ErrorMsg::USER_ALREADY_EXISTS);
            //   $errs->add(
            //     "User with email '$email' already exists."
            //);
        }
    }
}

$errs->redirect("../index.php");
