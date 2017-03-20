<!doctype html>
<html>
	<head>
		<title>Log In - Sample System</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	</head>
	<body>
		<div class="container" style="margin-top: 50px;">
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10">
					<div id="login-box" class="login-section">
					<h1 class="text-center">
						<a href="#">
							<img class="img-responsive" src="amv-logo.png" width="50%" heigh="50%" style="margin-left: auto; margin-right: auto;">
						</a>
					</h1>
					<?php
						if(!empty($_GET["login_error"])){
							echo ('<div class="alert alert-danger alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  <strong>Warning!</strong> You have entered an invalid username/password.
								</div>');
						}
						else{

						}
					?>
					<form id="login_form" role="form" method="POST" action="javascript:void(0);">
						<fieldset class="form-group"><legend>Log In</legend>
							<div id="username_group" class="form-group">
							   <div id="user_err" class="error"></div>
							   <input class="form-control" id="user_login" type="text" placeholder="Enter username" name="username">
							</div>
							<div id="pass_group" class="form-group">
							  <div id="pass_err" class="error"></div>
							  <input class="form-control" id="user_pass" type="password" placeholder="Enter password" name="password">
							</div>
							<div class="form-group">
								<a id="forgot" href="#">Forgot Password?</a>
								<button id="button_login" class="btn btn-primary" type="submit">Log In</button>
							</div>
						</fieldset> <!-- fieldset -->
					</form> <!-- form -->
					</div>
				</div> <!-- column -->
			</div><!-- row -->
		</div><!-- container -->
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>