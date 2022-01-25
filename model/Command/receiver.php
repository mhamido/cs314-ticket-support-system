<?php

class Reciever
{
    private  $services;
    private $oldservice;
    
    public function __construct($id)
    {
        $this->id=$id;
    }
    public function setservice($services)
    {
        $this->services = $services;
    }

    public function setoldservice($oldservice)
    {
        $this->oldservice = $this->services;
    }


    public function Delete()
    {
        DatabaseConnection::getInstance()->query  ("UPDATE ticket SET ticket.was_deleted=1 
        WHERE ticket.id=$this->id");
    }

    public function RevertDelete()
    {
        DatabaseConnection::getInstance()->query  ("UPDATE ticket SET ticket.was_deleted=0 
        WHERE ticket.id=$this->id");
    }
}
