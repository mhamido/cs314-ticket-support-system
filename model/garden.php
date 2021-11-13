<?php


require_once 'landscapingdecorator.php';


class Garden{

private $landscape;

public function __construct($landscape)
{
    $this->landscape=$landscape;
}


public function price(){
    return 25 + $this->landscape->price();

}

public function description(){
    return;
}






}





?>