<?php
require_once 'landscapingdecorator.php';


class Pesticide{


public $pesticideamount;
public $brand;
private $landscape;

public function __construct($landscape)
{
    $this->landscape=$landscape;
}

public function spray(){


echo("spraying $this->pesticideamount of $this->brand");


}
public function price(){
    return 5.99+$this->landscape->price();

}

public function description(){
    return "Pesticide;"+ $this->landscape->description();
} 






}






?>