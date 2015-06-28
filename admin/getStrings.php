<?php
	include('../functions.php');

	$mysqli = connectDB();
	if($mysqli)
	{
		
		$fio = $_POST['fio'];

		$pattern = '/[\s,]+/';
		$matches = preg_split($pattern, $fio, -1, PREG_SPLIT_NO_EMPTY);

		$request = '';

		print_r($matches[0]);
		$nmatches = count($matches);
		switch ($nmatches) {
			case 0:
				$request = "SELECT * FROM base";
				break;
			case 1:	
				$request = "SELECT * FROM base WHERE firstName_value Like '%" . $matches[0] . "%' OR familyName_value Like '%" . $matches[0] . "%' OR lastName_value Like '%" . $matches[0] . "%'";
				break;
			default:
				$counter = 0;
				foreach ($matches as $word) {
					if (!$counter) {
						$request = "SELECT id FROM base WHERE firstName_value Like '%" . $word . "%' OR familyName_value Like '%" . $word . "%' OR lastName_value Like '%" . $word . "%'";
					}
					else{
						if($counter + 1 == $nmatches){
							$request = "SELECT * FROM base WHERE id IN ( " . $request . " ) AND (firstName_value Like '%" . $word . "%' OR familyName_value Like '%" . $word . "%' OR lastName_value Like '%" . $word . "%')";
						}
						else{
							$request = "SELECT id FROM base WHERE id IN ( " . $request . " ) AND (firstName_value Like '%" . $word . "%' OR familyName_value Like '%" . $word . "%' OR lastName_value Like '%" . $word . "%')";
						}
					}

					$counter++;
				}
				break;
		}
	
		
		if (!$nmatches){
		
			$request .= " WHERE"; 
		}
		else{
			$request .= " AND";
		}
		$request .= " stageOfStudying_value Like '%" . $_POST['stageOfStudying'] . "%'AND faculty_value Like '%" . $_POST['faculty'] . "%' AND group_value Like '%" . $_POST['group'] . "%'";
		if ($_POST['phone']) {
			$request .=  " AND phone_value Like '%" . (int) $_POST['phone'] . "%'";
		}
		$request .= " AND email_value Like '%" . $_POST['email'] . "%' ORDER BY familyName_value LIMIT " . $_POST['start'] . ",30";
		//echo $request;
		$res = $mysqli->query($request);
		$result = '';
		while ($row = mysqli_fetch_assoc($res))
		{
			$result .= "<tr>
							<td class='index'>" . $row['id'] . " </td>
							<td>" . $row['familyName_value'] . "</td>
							<td>" . $row['firstName_value'] . "</td>
							<td>" . $row['lastName_value'] . "</td>
							<td>" . $row['birthDate_value'] . "</td>
							<td>" . $row['phone_value'] . "</td>
							<td>" . $row['faculty_value'] . "</td>
							<td>" . $row['group_value'] . "</td>
							<td>" . $row["lastYearStWorkplace_value"] . "</td>
                            <td>" . $row["lastYearStPost_value"] . "</td>
                            <td>" . $row["currentTimeWorkplace_value"] . "</td>
                            <td>" . $row["currentTimePost_value"] . "</td>
							<td><img class='delete' src='img/delete.png'></td>
						</tr>";
		}
		$mysqli->close();
	}
	else
	{
		$mysqli->close();
		echo "error";
	}
	echo $result;
?>