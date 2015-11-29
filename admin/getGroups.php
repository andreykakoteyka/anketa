<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$res = $mysqli->query("SELECT * FROM groups WHERE facultyClass='" . $_GET['faculty'] . "' ORDER BY name");
		$result = '';
		while ($row = mysqli_fetch_assoc($res))
		{
			$result .= "<tr class='".$row['facultyClass']."' value='".$row['name']."'>
							<td class='index hide'>".$row['id']."</td>
							<td>".$row['name']."</td>
							<td><img class='deleteGroup' src='img/delete.png'></td>
						</tr>";
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