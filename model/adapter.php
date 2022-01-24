<?php
require_once 'ticket.php';
require_once 'user.php';
require_once 'subject.php';

interface mpdf
{
    public function Output($user, $ticket);
}
class createpdf implements mpdf
{
    public function Output($user, $ticket)
    {
        $now = date('Y-m-d-H-i-s');
        $fileName = "$user->email-$now";
        $file = fopen("../mail/$fileName.txt", 'w');
        fwrite($file, "Hello $user->displayName, the ticket titled '$ticket->title' (#$ticket->id) has been updated.\n");
        if (isset($ticket) && isset($ticket->service)) {
            fwrite($file, "Services: " . $ticket->service->description . "\n");
            fwrite($file, "Total Cost: " . $ticket->service->price . "\n");
        }
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
