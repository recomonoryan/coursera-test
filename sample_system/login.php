<?php
	$username = "";
	$password = "";

	include("db_config.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		function adjust_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$username = adjust_input($_POST["username"]);
		$password = adjust_input($_POST["password"]);

		$password = hash("sha512", $password);

		$sql = "SELECT * FROM smp_users WHERE user_login='$username' AND user_pass='$password'";
		
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1){
			echo ("SUCCESS");
		}
		else{
			header ("Location: index.php?login_error=true");
		}
	}
?>