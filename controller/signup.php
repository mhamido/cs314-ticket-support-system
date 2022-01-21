<?php
require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/user.php';
require_once '../model/database.php';
session_start();

$errs = new ErrorPage();
$email = $_POST["e_mail"];
//$language = $_POST["language"];
$language=1;
$password = $_POST["Password"];
$displayName = $_POST["DisplayName"];
$confirmPassword = $_POST["ConfirmPassword"];

if (isNullOrEmpty($displayName)) {
       // $errs->add("Display name cannot be empty.");
   $msgid = DatabaseConnection::getInstance()->prepare(
    "SELECT error_message_id FROM joint_error_languages WHERE language_id=$language AND error_message_type_id=2"
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

if (isNullOrEmpty($email) || !isValidEmail($email)) {
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

if (isNullOrEmpty($password) || isNullOrEmpty($confirmPassword)) {
     //  $errs->add("Passwords cannot be empty!");
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
} elseif ($password !== $confirmPassword) {
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
 //   $errs->add("Passwords do not match.");
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
                $msgid = DatabaseConnection::getInstance()->prepare(
                "SELECT error_message_id FROM joint_error_languages WHERE language_id=$language AND error_message_type_id=3"
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
          
            
         //   $errs->add(
           //     "User with email '$email' already exists."
            //);
        }
    }
}

$errs->redirect("../index.php");
