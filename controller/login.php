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
    $stmt = DatabaseConnection::getInstance()->prepare(
        "SELECT user.id FROM user
            WHERE user.email=? AND user.Password=?"
    );
    $stmt->bind_param('ss', $email, $password);
    $result = $stmt->execute();

    if ($result) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $id = $result->fetch_assoc()["id"];
            $usr = new User($id);
        }
    }
} else {
    foreach ($errs as $err) {
        echo "Error: $err <br>";
    }
}
