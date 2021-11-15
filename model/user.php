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
        if (!$id) return;

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM user WHERE user.id=?"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) {
            die("User with $id not found.");
            return;
        }

        $result = $stmt->get_result()->fetch_assoc();

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

    public function getVisibleTickets()
    {
        // TODO: `user` should probably only see
        // tickets that they've created.
        $tickets = array();

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT T_id FROM ticket"
        );

        // $stmt->bind_param('s', $this->id);

        $result = $stmt->execute();

        if (!$result) {
            return $tickets;
        }

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $tickets[] = new Ticket($row["T_id"]);
        }

        return $tickets;
    }

    public static function login($email, $password)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM user WHERE
                user.email=? AND
                user.Password=?"
        );

        $stmt->bind_param('ss', $email, $password);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        $result = $stmt->get_result()->fetch_assoc();

        $obj = new User(false);
        $obj->id = $result["id"];
        $obj->displayName = $result["DisplayName"];
        $obj->email = $result["email"];
        $obj->password = $result["Password"];
        $obj->lastLogin = $result["LastLogin"];
        $obj->signupDate = $result["SignupDate"];

        return $obj;
    }

    public static function create($email, $password, $displayName)
    {
        $type_id = 1;
        $now = date_create()->format('Y-m-d H:i:s');
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO user (
                DisplayName,
                email,
                LastLogin,
                SignupDate,
                `Password`,
                UserType_id
            ) VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param('sssssi', $displayName, $email, $now, $now, $password, $type_id);
        return $stmt->execute();
    }

    public function createTicket($unit, $title, $service, $description)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO ticket (
                unit,
                title,
                S_id,
                P_id,
                `description`,
                create_date,
                Author_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param('isiissi',
            $unit,
            $title,
            // $service,
            $status
        );
    }
}
