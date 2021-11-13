<?php

require_once 'landscapingdecorator.php';


class Trimmer{

private $landscape;

public function __construct($landscape)
{
    $this->landscape=$landscape;
}


public function price(){
    return 15 + $this->landscape->price();
   
}

public function description(){
    return "Trimming;"+ $this->landscape->price();
}






}






?>