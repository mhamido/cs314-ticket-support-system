<?php
require_once 'ticket.php';
require_once 'user.php';
require_once 'subject.php';
require_once 'database.php';

interface mpdf
{
    public function Output($user, $ticket);
}
class createpdf implements mpdf
{
    public function Output($user, $ticket)
    {
        $stmt=DatabaseConnection::getInstance()->query
        ("SELECT messages.messagetemplate 
        FROM messages, languages 
        WHERE messages.typeid=languages.id");
        $now = date('Y-m-d-H-i-s');
        $fileName = "$user->email-$now";
        $file = fopen("../mail/$fileName.txt", 'w');
        $messg = sprintf($stmt->fetch_assoc()["messagetemplate"],$user->displayName,$ticket->title,$ticket->id,$ticket->service->description,$ticket->service->price);
        fwrite($file, $messg);
        fclose($file);
    }
}
class mpdfadapter extends Ticket
{
    private $mpdf, $user, $ticket;

    public function __construct(mpdf $mpdf, $user, $ticket)
    {
        $this->mpdf = $mpdf;
        $this->user = $user;
        $this->ticket = $ticket;
    }

    public function notify()
    {
        $this->mpdf->Output($this->user, $this->ticket);
    }
}
