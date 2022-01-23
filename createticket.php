<?php 
require_once "model/service.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Compound Help Desk System - Signup</title>
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
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="controller/createTicket.php">
					<span class="login100-form-title">
						New Ticket
					</span>

					<label for="unit">Unit:</label>
					<input class="input100" type="text" name="unit" placeholder="Unit" required>

					<label for="title">Title:</label><br>
					<input class="input100" type="text" name="title" placeholder="Title" required>

					<label for="description">Description:</label><br>
					<input class="input100" type="text" name="description" placeholder="Description" required>

					<label for="priority">Priority:</label><br>
					<select name="priority" id="priority">
						<option value="1">Low</option>
						<option value="2">Medium</option>
						<option value="3">High</option>
					</select><br><br>

					<label for="status">Status:</label><br>
					<select name="status" id="status">
						<option value="1">New</option>
						<option value="3">On Hold</option>
						<option value="4">In Progress</option>
						<option value="13">Resolved</option>
					</select><br><br>

					<label for="myfile">Select a file:</label>
					<input type="file" id="myfile" name="myfile"><br><br>

					<label for="myfile">Choose your services:</label><br>

					<?php foreach (Service::fetch() as $service) { ?>
						<input type="checkbox" name="<?php echo($service->name) ?>" id="<?php echo($service->id) ?>">
						<label for="<?php echo($service->id) ?>"><?php echo($service->name) ?></label> <br>
					<?php } ?>
					<!-- <input type="checkbox" name="pesticide" id="pesticide">
					<label>Pesticide</label><br>
					<input type="checkbox" name="trimmer" id="trimmer">
					<label>Trimmer</label><br>
					<input type="checkbox" name="garden" id="garden">
					<label>Garden</label><br>
					<input type="checkbox" name="cleaning" id="cleaning">
					<label>Cleaning</label><br>
					<input type="checkbox" name="laundry" id="laundry">
					<label>Laundry</label><br>
					<input type="checkbox" name="catering" id="catering">
					<label>Catering</label><br> -->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onClick="createticket()">
							Create
						</button>
					</div><br>

					<!--
					<label for="email">E_mail:</label>
					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your email">
						<input class="input100" type="email" name="e_mail" placeholder="E_mail" required>
						<span class="focus-input100"></span>
					</div>

					<form action="" method="post">             
						<textarea name="msg" placeholder="Enter your comment..."></textarea>     	      
					</form>
					
					<form action="create.php" method="post">
        				<input type="text" name="title" placeholder="Title" id="title" required>
        				<input type="email" name="email" placeholder="johndoe@example.com" id="email" required>
        				<textarea name="msg" placeholder="Enter your message here..." id="msg" required></textarea>
        			
    				</form>
					-->

					<div class="flex-col-c p-b-40">
						<span class="txt1 p-b-9">
							Want to cancel?
						</span>

						<a href="view/viewall.php" class="txt3" onClick="cancelticket()">
							Cancel
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	function cancelticket() {
		alert("Your Ticket has been cancelled");
	}
	/*
	function createticket() {
		alert("Your Ticket has been created");
	}
	*/
</script>
<style type="text/css">
	/*
	#pesticide {
		display: none;
	}

	#trimmer {
		display: none;
	}

	#garden {
		display: none;
	}

	#landscaping:checked~#pesticide {
		display: block;
	}

	#landscaping:checked~#trimmer {
		display: block;
	}

	#landscaping:checked~#garden {
		display: block;
	}

	#cleaning {
		display: none;
	}

	#laundry {
		display: none;
	}

	#catering {
		display: none;
	}

	#housekeeping:checked~#cleaning {
		display: block;
	}

	#housekeeping:checked~#laundry {
		display: block;
	}

	#housekeeping:checked~#catering {
		display: block;
	}
	*/
</style>

</html>
