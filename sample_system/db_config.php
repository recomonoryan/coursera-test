<?php
	$servername = "localhost";
	$server_user = "root";
	$server_pass = "";
	$dbname = "sample";

	$conn = mysqli_connect($servername, $server_user, $server_pass, $dbname);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	
?>