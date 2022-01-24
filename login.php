<?php
require_once '../errorPage.php';
require_once '../validation.php';
require_once '../model/logincheckmodel.php';
require_once '../model/user.php';
require_once '../model/database.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

if (isset($_POST["language"])) {
    $language = $_POST["language"];
    $errs = new ErrorPage($_POST["language"]);
} else {
    $language = 1;
    $errs = new ErrorPage();
}

if (Validation::isNullOrEmpty($email) || !Validation::isValidEmail($email)) {
    $errs->emit(ErrorMsg::INVALID_EMAIL);
}

if (Validation::isNullOrEmpty($password)) {
       // $errs->add("Invalid Password: '$password'");
    $errs->emit(ErrorMsg::INVALID_PASSWORD);
}

if ($errs->empty()) {
     $proxyi=new ProxyDP($email,$password);
           echo("yady el nela");
      
          
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
            $errs->emit(ErrorMsg::USER_DOES_NOT_EXIST);
            //  $errs->add(
            //     "User with email '$email' does not exist or attempted to login with incorrect credentials."
            //  );
        }
    }



}


$errs->redirect("../view/viewall.php");
