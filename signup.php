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
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="controller/signup.php">
					<span class="login100-form-title">
						Sign Up
					</span>

					<input class="input100" type="text" name="DisplayName" placeholder="DisplayName" required>
					<span class="focus-input100"></span><br>

					<input class="input100" type="password" name="Password" placeholder="Password" required>
					<span class="focus-input100"></span><br>

					<input class="input100" type="password" name="ConfirmPassword" placeholder="ConfirmPassword" required>
					<span class="focus-input100"></span><br>

					<input class="input100" type="email" name="e_mail" placeholder="E_mail" required>
					<span class="focus-input100"></span><br>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onclick="compare()">
							Sign Up
						</button>
					</div><br>

					<div class="flex-col-c p-b-40">
						<span class="txt1 p-b-9">
							Have an account?
						</span>

						<a href="index.php" class="txt3">
							Log In now
						</a>
					</div>

			</div>
			</form>
			<script>
				function compare() {
					var passValue = document.getElementById("Password");
					var confpassValue = document.getElementById("ConfirmPassword");
					if (passValue != confpassValue) {
						window.alert("Passwords do not match!");
					}
				}
			</script>
		</div>
	</div>
	</div>
</body>

</html>