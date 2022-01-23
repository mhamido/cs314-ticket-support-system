<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/litera/bootstrap.min.css">
    <title>Compound Help Desk System - Error </title>
</head>

<?php
require_once "../model/entity.php";
require_once "../model/database.php";
header('Content-Type: text/html; charset=utf-8');

$_SESSION["errs"] = $this;
$languages = LookupTable::fetch("languages");
?>

<body style="
    background-image: url('../images/valley.jpg'); 
    background-repeat:no-repeat; 
    max-width: 100%;
    overflow-x: hidden;">

    <div class="row d-flex justify-content-center">
        <div class="jumbotron alert alert-danger mt-4 col-md-6">
            <h1>
                Error:
                <small style="color:lightsalmon;">(<?php echo (count($this->errors)); ?> encountered)</small>
            </h1>
            <br>
            <ul class="list-group">
                <?php foreach ($this->messages() as $err) { ?>
                    <li class="list-group-item list-group-item-danger"><strong>
                            <?php echo ($err); ?>
                        </strong></li>
                <?php } ?>
            </ul>
            <br>
            <h3>
                <label for="language">Language:</label>
            </h3>
            <form action="./changeLanguage.php" method="post">
                <select name="language" id="language" onchange="this.form.submit()">
                    <?php foreach ($languages as $language) { ?>
                        <?php [$id, $name] = $language; ?>
                        <?php if ($id !== $this->language) { ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $id; ?>" selected><?php echo $name; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </form>
        </div>
    </div>
</body>

</html>