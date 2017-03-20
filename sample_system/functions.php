<?php
	function updateActiveSem($conn){
		$sql = "UPDATE smp_semesters SET status='INACTIVE' WHERE status='ACTIVE'";

		if(mysqli_query($conn, $sql)){
			echo 'Record Updated Successfully!';
		}
		else{
			echo "Error updating record: " . mysqli_error($conn);
		}
	}

	function selectActiveSem($conn){
		$sql = "SELECT ID FROM smp_semesters WHERE status='ACTIVE'";
		$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		return $row;
	}
?>