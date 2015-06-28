<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		$res = $mysqli->query("SELECT * FROM faculties WHERE stageOfStudying='" . $_GET['stageOfStudying'] ."' ORDER BY faculty");
		$result = '';
		while ($row = mysqli_fetch_assoc($res))
		{
			$result .= "<tr class='".$row['stageOfStudying']."' value='".$row['class']."'>
							<td class='index hide'>".$row['id']."</td>
							<td>".$row['faculty']."</td>
							<td><img class='deleteFaculty' src='img/delete.png'></td>
						</tr>";
		}
		$mysqli->close();
	}
	else
	{
		echo "error";
	}
	echo $result;
?>