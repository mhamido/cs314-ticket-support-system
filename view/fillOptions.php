<?php 
require_once "../model/service.php";
require_once "../model/service/option.php";
session_start();
$service = $_SESSION["service"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill Options</title>
</head>
<body>
    <?php foreach ($service->options() as $option) { ?>
        <label for=""><?php echo $option-></label>
        <input type="text">
    <?php } ?>
    <input type="submit" value="options">
</body>
</html>