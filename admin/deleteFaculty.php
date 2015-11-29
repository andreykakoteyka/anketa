<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$query = $mysqli->query('SELECT class FROM faculties WHERE id=' . $_POST['index']);
		while($faculty = mysqli_fetch_assoc($query)){
			$mysqli->query("DELETE FROM groups WHERE facultyClass='" . $faculty['class'] . "'");
		}
		$mysqli->query('DELETE FROM faculties WHERE id=' . $_POST['index']);		
		$mysqli->close();
	}
	else
	{
        http_response_code(500);
		echo "error";
	}
?>