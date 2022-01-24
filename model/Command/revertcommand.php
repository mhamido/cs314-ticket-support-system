<?php
include_once './receiver.php';
class RevertCommand implements Command{


    private $recievers;

    public function __construct(Reciever $recievers)
    {
        $this->recievers=$recievers;
    }



    public function execute(){
        $this->recievers->revertupdate();

    }


    
}
















?>