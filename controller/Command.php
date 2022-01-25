
<?php
require_once "../model/Command/command.php";
require_once "../model/database.php";
require_once "../model/ticket.php";
require_once "../model/Command/receiver.php";
require_once "../model/Command/invoker.php";
require_once "../model/Command/deploycommand.php";
require_once "../model/Command/revertcommand.php";
session_start();
if (isset($_POST["deleteticket"]) && isset($_POST["deletecommand"]))
{
$_SESSION["deleteticket"]=$_POST["deleteticket"];
$receiver= new Reciever($_POST["deleteticket"]);
$command= new DeployCommand($receiver);
$invoker=new Invoker();
$invoker->setCommand($command);
$invoker->run();
echo("done");

}
else if(isset($_POST["undocommand"]))

{
    $receiver= new Reciever($_SESSION["deleteticket"]);
    $command= new RevertCommand($receiver);
    $invoker=new Invoker();
    $invoker->setCommand($command);
    $invoker->run();
 
}

header("Location:../view/viewall.php ");
?>
