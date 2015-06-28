<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$mysqli->query('DELETE FROM base WHERE id=' . $_POST['index']);		
		$mysqli->close();
	}
	else
	{
		echo "error";
	}
?>