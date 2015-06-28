<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$class = 'c' . md5(uniqid(rand(),1));
		$query = $mysqli->query("INSERT INTO faculties (faculty, stageOfStudying, class) VALUES ('" . $_POST['facultyName'] . "','" . $_POST['addFacultyStageOfStudyingSelect'] . "','" . $class . "')");
		if ($query) {
			echo $class;
		}
		else{
			echo "error";
		}
		$mysqli->close();
	}
	else
	{
		echo "error";
	}
?>