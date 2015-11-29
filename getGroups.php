<?php
	include('functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$res = $mysqli->query('SELECT * FROM groups ORDER BY name');
		$result = '';
		while ($row = mysqli_fetch_assoc($res))
		{
			$result .= "<option class='".$row['facultyClass']."' value='".$row['name']."'>".$row['name']."</option>";
		}
		$mysqli->close();
	}
	else
	{
        http_response_code(500);
		echo "error";
        return;
	}
	echo $result;
?>