<?php
include_once './Command.php';
class Invoker{

private  $command;

public function setCommand(Command $command){

$this->command=$command;

}

public function run()
{

$this->command->execute();

}


}







?>