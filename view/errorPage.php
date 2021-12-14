<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/litera/bootstrap.min.css">
    <title>Compound Help Desk System - Error </title>
</head>

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
                <?php foreach ($this->errors as $err) { ?>
                    <li class="list-group-item list-group-item-danger"><strong>
                            <?php echo ($err); ?>
                        </strong></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>

</html>