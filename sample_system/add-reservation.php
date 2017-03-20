<!doctype>
<html>
	<head>
		<title>Reservation - Sample System</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<style>
		.input-error{
			color: #ff3333;
		}
	</style>
	<body>
		<h1>Room Reservation</h1>
		<fieldset style="width: 45%;">
			<legend>Add Reservation</legend>
			<form id="sem_form" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<input type="hidden" value="<?php echo $_GET['room_id'];?>" name="room">
				<input type="hidden" value="<?php echo $_GET['user_id'];?>" name="user">
				<p>Section: <input type="text" name="section"></p>
				<p>Preferred Date: <input id="range_from" type="date" name="date"><span id="range_err"></span>
				</p>
				<p>From: <input id="year_from" type="time" style="width: 100px;" name="time_from">To: <input id="year_to" type="time" style="width: 100px;" name="time_to" min=1 max=12><span id="year_err"></span>
				</p>
				<p><input id="form_submit" type="submit" value="Submit"></p>
			</form>
		</fieldset>
	</body>
</html>

<?php
	/*include("db_config.php");
	$sql = "SELECT * FROM smp_semesters";
	$result = mysqli_query($conn, $sql);
	$array = array();
	$x = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$array[$x] = $row;
		$x++;
	}
	echo json_encode($array);*/
	//echo json_encode($row);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include("db_config.php");
		include("functions.php");

		$room = $user = $sem = $section = $date = $time = "";

		$room = $_POST["room"];
		$user = $_POST["user"];
		$section = $_POST["section"];
		$date = $_POST["date"];
		$time = $_POST["time_from"]." - ".$_POST["time_to"];

		$row = selectActiveSem($conn);
		$sem = $row['ID'];

		$sql = "INSERT INTO smp_reserve (reserve_room_ID, reserve_user_ID, reserve_semester_ID, section, preferred_date, preferred_time, status) VALUES ('$room', '$user', '$sem', '$section', '$date', '$time', 'PENDING')";
		
		if(mysqli_query($conn, $sql)){
			echo "New record added!";
		}
		else{
			echo "Error: ". $sql . " " .mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>