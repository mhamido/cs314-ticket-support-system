<?php
require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/user.php';
require_once '../model/database.php';
session_start();

$errs = new ErrorPage();
$email = $_POST["email"];
//$language = $_POST["language"];
$language=1;
$password = $_POST["password"];

if (Validation::isNullOrEmpty($email) || !Validation::isValidEmail($email)) {
       //  $errs->add("Invalid email address: '$email'");

    $msgid = DatabaseConnection::getInstance()->prepare(
        "SELECT error_message_id FROM joint_error_languages WHERE language_id=$language AND error_message_type_id=4"
    );
    $msgid->execute();
    $msgid=$msgid->get_result()->fetch_assoc()["error_message_id"];
    var_dump($msgid);
    $msg = DatabaseConnection::getInstance()->prepare(
        "SELECT * FROM error_messages WHERE id = $msgid"
    );


    $msg->execute();
      $msg=$msg->get_result()->fetch_assoc()["message"];
    $errs->add($msg);
}

if (Validation::isNullOrEmpty($password)) {
       // $errs->add("Invalid Password: '$password'");
    $msgid = DatabaseConnection::getInstance()->prepare(
        "SELECT error_message_id FROM joint_error_languages WHERE language_id=$language AND error_message_type_id=1"
    );
    $msgid->execute();
    $msgid=$msgid->get_result()->fetch_assoc()["error_message_id"];
    var_dump($msgid);
    $msg = DatabaseConnection::getInstance()->prepare(
        "SELECT * FROM error_messages WHERE id = $msgid"
    );


    $msg->execute();
      $msg=$msg->get_result()->fetch_assoc()["message"];
    $errs->add($msg);
}

if ($errs->empty()) {
    // echo "Attempted to login with $email and $password";
    $stmt = DatabaseConnection::getInstance()->prepare(
        "SELECT user.id FROM user
            WHERE user.email=? AND user.Password=?"
    );
    $password = sha1($password);
    $stmt->bind_param('ss', $email, $password);
    $result = $stmt->execute();

    if ($result) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $id = $result->fetch_assoc()["id"];
            $usr = new User($id);
            $_SESSION["user"] = $usr;
        } else {
                   $msgid = DatabaseConnection::getInstance()->prepare(
                "SELECT error_message_id FROM joint_error_languages WHERE language_id=$language AND error_message_type_id=5"
            );
            $msgid->execute();
            $msgid=$msgid->get_result()->fetch_assoc()["error_message_id"];
            var_dump($msgid);
            $msg = DatabaseConnection::getInstance()->prepare(
                "SELECT * FROM error_messages WHERE id = $msgid"
            );


            $msg->execute();
              $msg=$msg->get_result()->fetch_assoc()["message"];
            $errs->add($msg);
            //  $errs->add(
            //     "User with email '$email' does not exist or attempted to login with incorrect credentials."
            //  );
        }
    }
}

$errs->redirect("../view/viewall.php");
