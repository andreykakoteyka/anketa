<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$result = "<option value=''>Все группы</option>";

		$res = $mysqli->query('SELECT * FROM groups ORDER BY name');
		while ($row = mysqli_fetch_assoc($res))
		{
			$result .= "<option class='".$row['facultyClass']."' value='".$row['name']."'>".$row['name']."</option>";
		}
		$mysqli->close();
	}
	else
	{
		echo "error";
	}
	echo $result;
?>