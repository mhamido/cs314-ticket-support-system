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
        $result = $result->fetch_assoc();

        if (!$result) {
            die("User with $id not found.");
            return;
        }

        $this->id = $id;
        $this->displayName = $result["DisplayName"];
        $this->email = $result["email"];
        $this->password = $result["Password"];
        $this->lastLogin = $result["LastLogin"];
        $this->signupDate = $result["SignupDate"];
    }

    public function update()
    {
        $last_login = $this->lastLogin->format('Y-m-d H:i:s');
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE user SET 
                DisplayName=?, 
                email=?,
                LastLogin=?,
                `Password`=?"
        );

        $stmt->bind_param("ssss", $this->displayName, $this->email, $last_login, $this->password);
        $stmt->execute();
    }

    public function delete()
    {
        $stmt = DatabaseConnection::getInstance()->prepare("DELETE FROM user WHERE user.id=?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
    }


    public static function login($email, $password)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT user.id WHERE
                user.email=? AND
                user.Password=?"
        );

        $stmt->bind_param('ss', $email, $password);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        $id = $result["id"];
        return new User($id);
    }

    public static function create($email, $password, $displayName)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO user (
                DisplayName,
                email,
                LastLogin,
                SignupDate,
                `Password`
            ) VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param('sssss', $displayName, $email, $now, $now, $password);
        return $stmt->execute();
    }
}
