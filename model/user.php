<?php
require_once 'observer.php';
require_once 'ticket.php';
class User implements Observer
{
    public $id;
    public $email;
    public $password;
    public $displayName;

    public function __construct($id)
    {
        if (!$id) return;

        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM user WHERE user.id=? AND was_deleted=0"
        );

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if (!$result) {
            die("User with $id not found.");
            return;
        }

        $result = $stmt->get_result()->fetch_assoc();

        $this->id = $id;
        $this->displayName = $result["display_name"];
        $this->email = $result["email"];    
        $this->password = $result["password"];
    }


    public function send($ticket)
    {
        // mail(
        //     $this->email, 
        //     "Ticket ($ticket->id) has been updated.",
        //     "Hello $this->displayName, the ticket titled '$ticket->title' has been updated."
        // );

        $now = date('Y-m-d-H-i-s');
        $fileName = "$this->email-$now";
        $file = fopen("../mail/$fileName.txt", 'w');
        // fwrite($file, "Hello $this->displayName, the ticket titled '$ticket->title' has been updated.");
        fwrite($file, "Hello $this->displayName, the ticket titled '$ticket->title' (#$ticket->id) has been updated.\n");
        if (isset($ticket) && isset($ticket->service)) {
            fwrite($file, "Services: " . $ticket->service->description() . "\n");
            fwrite($file, "Total Cost: " . $ticket->service->price() . "\n");
        }
        fclose($file);
    }

    
    public function update()
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "UPDATE user SET 
                display_name=?, 
                email=?,
                `password`=?"
        );

        $stmt->bind_param("sss", $this->displayName, $this->email, $this->password);
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
            "SELECT id FROM ticket ORDER BY priority_id DESC"
        );

        // $stmt->bind_param('s', $this->id);

        $result = $stmt->execute();

        if (!$result) {
            return $tickets;
        }

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $tickets[] = new Ticket($row["id"]);
        }

        return $tickets;
    }

    public static function login($email, $password)
    {
        $stmt = DatabaseConnection::getInstance()->prepare(
            "SELECT * FROM user WHERE
                user.email=? AND
                user.`password`=?"
        );

        $stmt->bind_param(
            'ss',
            $email, 
            sha1($password)
        );

        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        $result = $stmt->get_result()->fetch_assoc();

        $obj = new User(false);
        $obj->id = $result["id"];
        $obj->displayName = $result["display_name"];
        $obj->email = $result["email"];
        $obj->password = $result["password"];
        return $obj;
    }

    public static function create($email, $password, $displayName)
    {
        $type_id = 1;
        $now = date_create()->format('Y-m-d H:i:s');
        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO user (
                email,
                `password`,
                display_name,
                user_type_id
            ) VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param(
            'sssi', 
            $email, 
            sha1($password),
            $displayName, 
            $type_id
        );

        return $stmt->execute();
    }

    public function createTicket($unit, $title,  $description, $status, $priority, $service = NULL)
    {
        $now = date_create()->format('Y-m-d H:i:s');

        $stmt = DatabaseConnection::getInstance()->prepare(
            "INSERT INTO ticket (
                unit,
                title,
                `description`,
                author,
                status_id,
                priority_id
            ) VALUES (?, ?, ?, ?, ?, ?)"
        );

        // TODO: add service.

        $sid = $status->id();
        $pid = $priority->id();

        $stmt->bind_param('isiissi',
            $unit,
            $title,
            $description,
            $this->id,
            $sid,
            $pid,
        );

        $result = $stmt->execute();
        
        if (!$result) 
            return false;

        $id = DatabaseConnection::getInstance()->insert_id;
        // Return an instance with the id of the inserted ticket.
        return new Ticket($id);
    }
}
