<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$mysqli->query("DELETE FROM groups WHERE id='" . $_POST['index'] . "'");		
		$mysqli->close();
	}
	else
	{
        http_response_code(500);
		echo "error";
	}
?>