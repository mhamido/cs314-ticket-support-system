<?php
require_once '../model/user.php';
require_once '../model/database.php';
require_once "../model/report.php";
session_start();

$user = $_SESSION["user"];
$tickets = $user->getVisibleTickets();
// var_dump($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
  <!--  All snippets are MIT license http://bootdey.com/license -->
  <title>View Tickets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  </a>
  <div class="d-flex justify-content-between align-items-center">
    <div><i class="fa fa-tag mr-1 text-muted"></i>
      <div class="d-inline-block font-weight-medium text-uppercase">My Tickets</div>
    </div>
    </a>
    </nav>
  </div>
  </div>


  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Ticket Title</th>
          <th>Date Issued</th>
          <th>Status</th>
          <th>Priority</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($tickets as $ticket) { ?>
          <tr>
            <td>
              <!-- <a class="navi-link" href="../controller/manageTicket.php?ticket_id=<?php echo ($ticket->id); ?>" data-toggle="modal">7<?php echo ($ticket->id) ?></a> -->
              <form action="../controller/editTicket.php" method="get">
                <input type="submit" name="ticket_id" value="<?php echo ($ticket->id); ?>">
              </form>
            </td>
            <td><?php echo ($ticket->title) ?></td>
            <td><?php echo ($ticket->dateCreated) ?></td>
            <?php if ($ticket->status->id() === 13) { ?>
              <td><span class="badge badge-danger m-0"><?php echo ($ticket->status->name()) ?></span></td>
            <?php } elseif ($ticket->status->id() === 3 || $ticket->status->id() === 4) { ?>
              <td><span class="badge badge-info m-0"><?php echo ($ticket->status->name()) ?></span></td>
            <?php } else { ?>
              <td><span class="badge badge-success m-0"><?php echo ($ticket->status->name()) ?></span></td>
            <?php } ?>

            <?php if ($ticket->priority->id() === 3) { ?>
              <td><span class="badge badge-danger m-0"><?php echo ($ticket->priority->name()) ?></span></td>
            <?php } elseif ($ticket->priority->id() === 1) { ?>
              <td><span class="badge badge-success m-0"><?php echo ($ticket->priority->name()) ?></span></td>
            <?php } else {  ?>
              <td><span class="badge badge-info m-0"><?php echo ($ticket->priority->name()) ?></span></td>
            <?php } ?>
          </tr>
        <?php  } ?>
      </tbody>
    </table>
    <span class="container" style="display: inline;">
      <form action="../createticket.php" method="post" style="display: inline;">
        <button class="button button1" style="display: inline;">Create Ticket</button>
      </form>
      <form action="../logout.php" method="post" style="display: inline;">
        <button class="button button badge-danger" style="display: inline;">Logout</button>
      </form>
    </span>
  </div>
  </div>
  </div>
  </div>


  <body>
      <script type="text/javascript">
        function selects() {
          var ele = document.querySelectorAll('input[type=checkbox]');
          for (var i = 0; i < ele.length; i++) {

            ele[i].checked = true;
          }
        }

        function deSelects() {
          var ele = document.querySelectorAll('input[type=checkbox]');
          for (var i = 0; i < ele.length; i++) {

            ele[i].checked = false;

          }
        }
      </script>

      <style type="text/css">
        .button {
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }



        .button:focus {
          border: none;
          outline: none;
        }

        .button:focus {
          outline: none !important;
        }

        .button1 {
          background-color: #4CAF50;
        }

        body {
          background: #eee;
        }

        .main-container {
          margin-top: 40px;
        }

        .widget-author {
          margin-bottom: 58px;
        }

        .author-card {
          position: relative;
          padding-bottom: 48px;
          background-color: #fff;
          box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
        }

        .author-card .author-card-cover {
          position: relative;
          width: 100%;
          height: 100px;
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }

        .author-card .author-card-cover::after {
          display: block;
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          content: '';
          opacity: 0.5;
        }

        .author-card .author-card-cover>.btn {
          position: absolute;
          top: 12px;
          right: 12px;
          padding: 0 10px;
        }

        .author-card .author-card-profile {
          display: table;
          position: relative;
          margin-top: -22px;
          padding-right: 15px;
          padding-bottom: 16px;
          padding-left: 20px;
          z-index: 5;
        }

        .author-card .author-card-profile .author-card-avatar,
        .author-card .author-card-profile .author-card-details {
          display: table-cell;
          vertical-align: middle;
        }

        .author-card .author-card-profile .author-card-avatar {
          width: 85px;
          border-radius: 50%;
          box-shadow: 0 8px 20px 0 rgba(0, 0, 0, .15);
          overflow: hidden;
        }

        .author-card .author-card-profile .author-card-avatar>img {
          display: block;
          width: 100%;
        }

        .author-card .author-card-profile .author-card-details {
          padding-top: 20px;
          padding-left: 15px;
        }

        .author-card .author-card-profile .author-card-name {
          margin-bottom: 2px;
          font-size: 14px;
          font-weight: bold;
        }

        .author-card .author-card-profile .author-card-position {
          display: block;
          color: #8c8c8c;
          font-size: 12px;
          font-weight: 600;
        }

        .author-card .author-card-info {
          margin-bottom: 0;
          padding: 0 25px;
          font-size: 13px;
        }

        .author-card .author-card-social-bar-wrap {
          position: absolute;
          bottom: -18px;
          left: 0;
          width: 100%;
        }

        .author-card .author-card-social-bar-wrap .author-card-social-bar {
          display: table;
          margin: auto;
          background-color: #fff;
          box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .11);
        }

        .btn-style-1.btn-white {
          background-color: #fff;
        }

        .list-group-item i {
          display: inline-block;
          margin-top: -1px;
          margin-right: 8px;
          font-size: 1.2em;
          vertical-align: middle;
        }

        .mr-1,
        .mx-1 {
          margin-right: .25rem !important;
        }

        .list-group-item.active:not(.disabled) {
          border-color: #e7e7e7;
          background: #fff;
          color: #ac32e4;
          cursor: default;
          pointer-events: none;
        }

        .list-group-flush:last-child .list-group-item:last-child {
          border-bottom: 0;
        }

        .list-group-flush .list-group-item {
          border-right: 0 !important;
          border-left: 0 !important;
        }

        .list-group-flush .list-group-item {
          border-right: 0;
          border-left: 0;
          border-radius: 0;
        }

        .list-group-item.active {
          z-index: 2;
          color: #fff;
          background-color: #007bff;
          border-color: #007bff;
        }

        .list-group-item:last-child {
          margin-bottom: 0;
          border-bottom-right-radius: .25rem;
          border-bottom-left-radius: .25rem;
        }

        a.list-group-item,
        .list-group-item-action {
          color: #404040;
          font-weight: 600;
        }

        .list-group-item {
          padding-top: 16px;
          padding-bottom: 16px;
          -webkit-transition: all .3s;
          transition: all .3s;
          border: 1px solid #e7e7e7 !important;
          border-radius: 0 !important;
          color: #404040;
          font-size: 12px;
          font-weight: 600;
          letter-spacing: .08em;
          text-transform: uppercase;
          text-decoration: none;
        }

        .list-group-item {
          position: relative;
          display: block;
          padding: .75rem 1.25rem;
          margin-bottom: -1px;
          background-color: #fff;
          border: 1px solid rgba(0, 0, 0, 0.125);
        }
      </style>
    </div>
  </body>

</html>