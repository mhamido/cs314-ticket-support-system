<?php

require_once 'landscapingdecorator.php';


class Trimmer{

public $material;
public $materialcost;

private $landscape;

public function trimgrass(){

echo("trimmed grass");


}

public function __construct($landscape)
{
    $this->landscape=$landscape;
}


public function price(){
    return 15 + $this->landscape->price();
   
}

public function description(){
    return "Trimming;"+ $this->landscape->description();
}






}






?>