<?php
        include('functions.php');
        $mysqli = connectDB();
        if(!$mysqli)
        {
          http_response_code(500);
          echo 'error';

          return;
        };
        $json = json_decode(stripslashes($_POST['json']), JSON_BIGINT_AS_STRING); 
   		//$query = "CREATE TABLE base (";
		$query = "INSERT INTO base SET ";
        $i = 0;
		foreach($json as $element)
		{
           
            //$query .= (!($i)?"\n":",\n").$element['name']."_value varchar(10)";
            $query .= (!($i)?"":",\n").$element['name']."_value="."'".$element['value']."'";
            $i++;
		};
        //$query .= ')';
        echo $query;
        $mysqli->query($query) or trigger_error($mysqli->error);
		echo $query;
        
?>