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
    <form action="../controller/addValue.php" method="post">
        <?php foreach ($service->options() as $option) { ?>
            <?php $name = $option->id; ?>
            <label for="<?php echo $name; ?>">
                <?php echo $option->name; ?> (<?php echo $option->type->name; ?>)
            </label><br>
            <input type="text" name="<?php echo $name; ?>" required>
            <br>
        <?php } ?>
        <br><br>
        <input type="submit" value="submit">
    </form>
</body>

</html>