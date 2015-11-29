<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$res = $mysqli->query('SELECT * FROM faculties ORDER BY faculty');
		$result = "<option value=''>Все факультеты</option>";
		while ($row = mysqli_fetch_assoc($res))
		{
			$result .= "<option class='".$row['stageOfStudying']."' value='".$row['class']."'>".$row['faculty']."</option>";
		}
		$mysqli->close();
	}
	else
	{
        http_response_code(500);
		echo "error";
	}
	echo $result;
?>