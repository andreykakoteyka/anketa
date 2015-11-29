<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$query = $mysqli->query("INSERT INTO groups (facultyClass, name) VALUES ('" . $_POST['facultyClass'] . "','" . $_POST['groupName'] . "')");
		if (!$query) {
			echo "error";
		}
		mysql_close();
	}
	else
	{
        http_response_code(500);
		echo "error";
	}
?>