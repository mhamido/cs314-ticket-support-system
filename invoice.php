<?php
require_once 'model/user.php';
require_once 'model/ticket.php';
session_start();
$ticket = $_SESSION["ticket"];
$user = $ticket->author;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Compound Help Desk System - Viewing <?php echo ($ticket->id); ?> </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="controller/manageTicket.php">
                    <span class="login100-form-title">
                        Thank You For The Ticket
                    </span>
                    <label for="unit"> Hi <?php echo ($user->displayName); ?>, Just to let you know - we have received your ticket #<?php echo ($ticket->id); ?>, and it's now being processed. </label>
                    <h5>[Ticket #<?php echo ($ticket->id) ?>] <input value="(<?php echo date('Y-m-d'); ?>)"></h5><br>
                    <label for="unit">Unit: <?php echo ($ticket->unit); ?></label><br>
                    <label for="title">Title: <?php echo ($ticket->title); ?></label><br>
                    <label for="description">Description: <?php echo ($ticket->description); ?></label><br>
                    <label for="priority">Priority: <?php echo ($ticket->priority->name()); ?></label><br>
                    <label for="status">Status: <?php echo ($ticket->status->name()); ?></label><br>
                    <!--<label for="myfile">File: <?php //echo ($ticket->Attachment_id); 
                                                    ?> </label><br>-->
                    <label for="email">E_mail: <?php echo ($user->email); ?></label><br>
                    <table>
                        <tr>
                            <th>Service</th>
                            <th>Price</th>
                        </tr>

                        <?php $sum = 0; ?>
                        <?php $service = $ticket->service; ?>
                        <?php while ($service != null) { ?>
                            <tr>
                                <td><?php echo $service->name; ?></td>
                                <td><?php echo $service->price; ?></td>
                            </tr>
                            <?php $sum += intval($service->price); ?>
                            <?php $service = $service->parent; ?>
                        <?php } ?>
                        <tr>
                            <td>Total Price</td>
                            <td><?php echo $sum; ?></td>
                        </tr>
                    </table><br>
                    <label>Thanks for using our service.</label><br>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            ok
                        </button>
                    </div><br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>