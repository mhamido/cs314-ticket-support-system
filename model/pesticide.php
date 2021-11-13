<?php
require_once 'landscapingdecorator.php';


class Pesticide{

private $landscape;

public function __construct($landscape)
{
    $this->landscape=$landscape;
}


public function price(){
    return 5.99+$this->landscape->price();

}

public function description(){
    return "Pesticide;"+ $this->landscape->price();
} 






}






?>