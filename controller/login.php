<?php
require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/user.php';
require_once '../model/database.php';
session_start();

$errs = new ErrorPage();
$email = $_POST["email"];
$password = $_POST["password"];

if (Validation::isNullOrEmpty($email) || !Validation::isValidEmail($email)) {
    $errs->add("Invalid email address: '$email'");
}

if (Validation::isNullOrEmpty($password)) {
    $errs->add("Invalid Password: '$password'");
}

if ($errs->empty()) {
    // echo "Attempted to login with $email and $password";
    $stmt = DatabaseConnection::getInstance()->prepare(
        "SELECT user.id FROM user
            WHERE user.email=? AND user.Password=?"
    );
    $stmt->bind_param('ss', $email, sha1($password));
    $result = $stmt->execute();

    if ($result) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $id = $result->fetch_assoc()["id"];
            $usr = new User($id);
            $_SESSION["user"] = $usr;
        } else {
            $errs->add(
                "User with email '$email' does not exist or attempted to login with incorrect credentials."
            );
        }
    }
}

$errs->redirect("../view/viewall.php");