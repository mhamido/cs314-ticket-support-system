<?php

require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/user.php';
require_once '../model/database.php';

$errs = array();
$email = $_POST["email"];
$password = $_POST["password"];
$displayName = $_POST["DisplayName"];
// $confirmPassword = $_POST[];

if (isNullOrEmpty($email) || !isValidEmail($email)) {
    $errs[] = "Invalid email address: $email.";
}

if (empty($errs)) {
    // Ensure that such a user doesn't exist already.
    $stmt = DatabaseConnection::getInstance()->prepare(
        "SELECT user.id WHERE user.email=?"
    );

    $stmt->bind_param('s', $email);
    $result = $stmt->execute();
    
    if (!$result) {
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            User::create($email, $password, $displayName);
            $usr = User::login($email, $password);
        } else {
            displayError(array(
                "User with email '$email' already exists."
            ));
        }
    }
} else {
    displayError($errs);
}