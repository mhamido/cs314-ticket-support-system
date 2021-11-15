<?php
session_start();

require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/user.php';
require_once '../model/database.php';

$errs = array();
$email = $_POST["e_mail"];
$password = $_POST["Password"];
$displayName = $_POST["DisplayName"];
$confirmPassword = $_POST["ConfirmPassword"];

if (isNullOrEmpty($email) || !isValidEmail($email)) {
    $errs[] = "Invalid email address: $email.";
}

if (isNullOrEmpty($password) || isNullOrEmpty($confirmPassword)) {
    $errs[] = "Passwords cannot be empty!";
} elseif ($password !== $confirmPassword) {
    $errs[] = "Passwords do not match.";
}

if (empty($errs)) {
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
            header("Location: index.php");
        } else {
            displayError(array(
                "User with email '$email' already exists."
            ));
        }
    }
} else {
    // var_dump($errs);
    displayError($errs);
}