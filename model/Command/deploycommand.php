<?php
include_once './receiver.php';
class DeployCommand implements Command{

private $recievers;

public function __construct(Reciever $recievers)
{
    $this->recievers=$recievers;
}

public function execute(){

$this->recievers->update();

}



}









?>