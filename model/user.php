<?php

class User
{
    private $id;
    private $email;
    private $password;
    private $lastLogin;
    private $signupDate;
    private $displayName;

    public function __construct($id)
    {
        $stmt = "SELECT * FROM user WHERE user.id=$id";
        $result = DatabaseConnection::getInstance()->query($stmt);

        if (!$result) {
            echo "User with $id not found.";
            return;
        }

        $this->id = $id;
        $this->displayName = $result["DisplayName"];
        $this->email = $result["email"];
        $this->password = $result["Password"];
        $this->lastLogin = $result["LastLogin"];
        $this->signupDate = $result["SignupDate"];
    }

    public static function login($email, $password)
    {
        $stmt = "SELECT user.id WHERE user.email=$email AND user.Password=$password";
        $result = DatabaseConnection::getInstance()->query($stmt);

        if (!$result) {
            echo 'Invalid email/password.';
            return;
        }
        
        $id = $result["id"];
        return new User($id);
    }

    public static function signup()
    {
    }
}
