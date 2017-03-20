<!doctype>
<html>
	<head>
		<title>Semester - Sample System</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<style>
		.input-error{
			color: #ff3333;
		}
	</style>
	<body>
		<h1>Semester</h1>
		<fieldset style="width: 45%;">
			<legend>Add Semester</legend>
			<form id="sem_form" role="form" method="POST" action="javascript:void(0);">
				<p>Semester: <select name="semester">
					<option value="1st Semester">1st Semester</option>
					<option value="2nd Semester">2nd Semester</option>
					<option value="Special">Special Semester</option>
				</select></p>
				<p>School Year: <input id="year_from" type="number" style="width: 100px;" name="year_from"> - <input id="year_to" type="number" style="width: 100px;" name="year_to"><span id="year_err"></span>
				</p>
				<p>From: <input id="range_from" type="date" name="range_from"> To: <input id="range_to" type="date" name="range_to"><span id="range_err"></span>
				</p>
				<p><input id="enable" type="checkbox" name="active" value="enabled"> Enable to active semester?
				</p>
				<p><input id="form_submit" type="submit" value="Submit"></p>
			</form>
		</fieldset>
		<script>
			document.addEventListener("DOMContentLoaded", function(event){
				var fromDate = new Date().toISOString();
				var fromResult = fromDate.split("T");
				var real_fromDate = fromResult[0];

				var toDate = new Date();
				var addToDate = toDate.setDate(toDate.getDate() + 28);
				var toResult = toDate.toISOString().split("T");
				var real_toDate = toResult[0];

				var date = new Date();
				var fromYear = date.getFullYear() - 1;
				var toYear = date.getFullYear();

				var range_from = document.getElementById("range_from");
				var range_to = document.getElementById("range_to");
				var range_flag = true;
				var year_from = document.getElementById("year_from");
				var year_to = document.getElementById("year_to");
				var year_flag = true;
				var yearErr_elem = document.getElementById("year_err");
				var yearErr_class = yearErr_elem.className;
				var rangeErr_elem = document.getElementById("range_err");
				var rangeErr_class = rangeErr_elem.className;
				var enable_active = document.getElementById("enable");

				function validateForm(event){
					if(year_from.value === "" || year_to.value === ""){
						if(year_flag){
							yearErr_class += "input-error";
							yearErr_elem.className = yearErr_class;
							yearErr_elem.textContent = "* Missing field/s";
							year_flag = false;
						}
						else{
							yearErr_elem.textContent = "* Missing field/s";
						}
					}
					else if((year_to.value - year_from.value) >= 2){
						if(year_flag){
							yearErr_class += "input-error";
							yearErr_elem.className = yearErr_class;
							yearErr_elem.textContent = "* Invalid School Year Format!";
							year_flag = false;
						}
						else{
							yearErr_elem.textContent = "* Invalid School Year Format!";
						}
					}
					else{
						if(year_flag === false){
							yearErr_class = yearErr_class.replace(new RegExp("input-error", "g"), "");
							yearErr_elem.className = yearErr_class;
							yearErr_elem.textContent = "";
							year_flag = true;
						}
					}

					if(range_from.value === "" || range_to.value === ""){
						if(range_flag){
							rangeErr_class += "input-error";
							rangeErr_elem.className = rangeErr_class;
							rangeErr_elem.textContent = "* Missing field/s";
							range_flag = false;
						}
						else{
							rangeErr_elem.textContent = "* Missing field/s";
						}
					}
					else{
						if(range_flag === false){
							rangeErr_class = rangeErr_class.replace(new RegExp("input-error", "g"), "");
							rangeErr_elem.className = rangeErr_class;
							rangeErr_elem.textContent = "";
							range_flag = true;
						}
					}

					if(range_flag && year_flag){
						if(enable_active.checked){
							var ans = confirm("The current active semester will be changed to the one you are adding right now. Proceed?");

							if(ans){
								document.getElementById("sem_form").action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>";
								document.getElementById("sem_form").submit();
							}
						}
						else{
							document.getElementById("sem_form").action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>";
							document.getElementById("sem_form").submit();	
						}
					}
				}
	
				range_from.addEventListener("focus", function(event){
					this.min = real_fromDate;
				});

				range_to.addEventListener("focus", function(event){
					this.min = real_toDate;
				});

				year_from.addEventListener("focus", function(event){
					this.min = fromYear;
				});

				year_to.addEventListener("focus", function(event){
					this.min = toYear;
				});

				document.getElementById("form_submit").addEventListener("click", function(event){
					
					validateForm(event);
				});
			});
		</script>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include("db_config.php");
		include("functions.php");

		$semester = $year = $range = $active = "";

		$semester = $_POST["semester"];
		$year = $_POST["year_from"] . "-" . $_POST["year_to"];
		$range = $_POST["range_from"] . " / " . $_POST["range_to"];
		if(empty($_POST["active"])){
			$active = "INACTIVE";
		}
		else{
			$active = "ACTIVE";
			updateActiveSem($conn);
		}

		$sql = "INSERT INTO smp_semesters (semester_lbl, semester_year, semester_range, status) VALUES ('$semester', '$year', '$range', '$active')";
		
		if(mysqli_query($conn, $sql)){
			echo "New record added!";
		}
		else{
			echo "Error: ". $sql . " " .mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>