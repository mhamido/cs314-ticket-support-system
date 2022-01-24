<?php

class Reciever
{
    private  $services;
    private $oldservice;
    
    public function setservice($services)
    {
        $this->services = $services;
    }

    public function setoldservice($oldservice)
    {
        $this->oldservice = $this->services;
    }


    public function update()
    {
        echo ("updated");
    }

    public function revertupdate()
    {
        echo ("unupdated");
    }
}
