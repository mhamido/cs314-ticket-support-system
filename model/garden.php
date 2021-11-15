<?php


require_once 'landscapingdecorator.php';


class Garden{

private $landscape;
public $noOfFlowers;
public $flowerCost;
public $wateramount;
public $watercost;

public function plantflowers(){

echo("Planted $this->noOfFlowers");



}
public function waterflowers(){


echo("Watered flowers");


}
public function __construct($landscape)
{
    $this->landscape=$landscape;
}


public function price(){
    return 25 + $this->landscape->price();

}

public function description(){
    return "Gardening;"+ $this->landscape->price();
}






}





?>