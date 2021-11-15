<?php

require_once 'service.php';

abstract class HouseKeeping implements Service
{
  public abstract function price();
  public abstract function perform();
  public abstract function description();
}
