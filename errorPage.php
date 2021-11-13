<?php
function displayError($errs)
{
    // var_dump($errs);
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '   <meta charset="UTF-8">';
    echo '   <meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '   <meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '   <link rel="icon" type="image/png" href="images/icons/favicon.ico" />';
    echo '   <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">';
    echo '   <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">';
    echo '   <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">';
    echo '   <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">';
    echo '   <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">';
    echo '   <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">';
    echo '   <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">';
    echo '   <link rel="stylesheet" type="text/css" href="css/util.css">';
    echo '   <link rel="stylesheet" type="text/css" href="css/main.css">';
    echo '   <title>Error - </title>';
    echo '</head>';
    echo '<body>';
    echo '   <div class="limiter">';
    echo '       <div class="container-login100 red">';
    echo '           <div class="wrap-login100">';
    echo '               <h1>Error:</h1>';
    echo '               <ul>';

    foreach ($errs as $err) {
        echo "<li>$err</li>";
    }

    echo '               </ul>';
    echo '           </div>';
    echo '       </div>';
    echo '   </div>';
    echo '</body>';
    echo '</html>';
}
