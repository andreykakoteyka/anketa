<?php 

	include("../functions.php");
	$mysqli = connectDB();
	if($mysqli)
	{
		$query = $mysqli->query('SELECT * FROM base WHERE id=' . $_GET['index']);		
		$result = mysqli_fetch_assoc($query);
		$mysqli->close();
		if($result){
			echo json_encode($result);
		}
		else{
			echo "error";
		}
	}
	else
	{
		echo "error";
	}
	//echo $result;

?>