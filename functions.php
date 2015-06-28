<?php
	function connectDB()
	{
	  	//$mysqli = new mysqli("localhost", "u850348182_anket", "uT53DUDS75ITiN", "u850348182_anket");
	  	$mysqli = new mysqli("mysql.hostinger.ru", "u816687978_anket", "uT53DUDS75ITiN", "u816687978_anket");
        //mysql_select_db("u850348182_anket");
	  	//mysql_select_db("u816687978_anket");

        $mysqli->query('set character_set_client="utf8"');
		$mysqli->query('set character_set_results="utf8"');
		$mysqli->query('set collation_connection="utf8_unicode_ci"');


	  	if ($mysqli->connect_errno)
	  	{
	    	echo "Подключение невозможно: ".$mysqli->connect_errno;
	    	$mysqli->close();
	    	return false;
  		}
  		return $mysqli;

		/*$connect = mysql_connect("mysql.hostinger.ru", "u850348182_anket", "uT53DUDS75ITiN");
		mysql_select_db("u850348182_anket") or die(mysql_error());
		return $connect;*/
	}

	function createBaseTable(){
		$post = json_decode($_POST['json']);
		//echo $post;
		
	}

	function generateCode($length=6){

	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

	    $code = "";

	    $clen = strlen($chars) - 1;  
	    while (strlen($code) < $length) {

	        $code .= $chars[mt_rand(0,$clen)];  
	    }

	    return $code;

	}

	function delete_cookie(){
	 setcookie("id", "", time() - 3600*24*30*12, "/admin/");

     setcookie("hash", "", time() - 3600*24*30*12, "/admin/");

	
	}

	function check_user($mysqli){
		if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){   

		    $query = $mysqli->query("SELECT *,INET_NTOA(user_ip) FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");

		    $userdata = mysqli_fetch_assoc($query);


		    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
		 //or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== 0)))

		    {
				print $userdata['user_ip'] . "       " . $_SERVER['REMOTE_ADDR'];

		        setcookie("id", "", time() - 3600*24*30*12, "/admin/");

		        setcookie("hash", "", time() - 3600*24*30*12, "/admin/");

		        echo "Хм, что-то не получилось";

		    }

		    else{

		        echo "success";

		    }

		}
		else{

    		print "<script>window.location.reload();</script>";
		}
		$mysqli->close();
	}

    function fillBaseHeader($sheet){//строит шапку таблицы в xls файле, куда выгружается база

        $sheet->setCellValue("A1", '№');
        $sheet->getStyle('A1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("B1", "Фамилия");
        $sheet->getStyle('B1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("C1", "Имя");
        $sheet->getStyle('C1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('C1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("D1", "Отчество");
        $sheet->getStyle('D1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('D1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("E1", "Дата рождения");
        $sheet->getStyle('E1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('E1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("F1", "Уровень обучения");
        $sheet->getStyle('F1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('F1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("G1", "Факультет");
        $sheet->getStyle('G1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('G1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("H1", "Группа");
        $sheet->getStyle('H1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('H1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("I1", "Телефон");
        $sheet->getStyle('I1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('I1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("J1", "E-mail");
        $sheet->getStyle('J1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('J1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("K1", "Трудоустроен");
        $sheet->getStyle('K1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('K1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("L1", "Текущее трудоустройство: Компания");
        $sheet->getStyle('L1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('L1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("M1", "Текущее трудоустройство: Должность");
        $sheet->getStyle('M1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('M1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("N1", "Трудоустройство на последнем курсе");
        $sheet->getStyle('N1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('N1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("O1", "Место работы на последнем курсе: Должность");
        $sheet->getStyle('O1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('O1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("P1", "Место работы на последнем курсе: Должность");
        $sheet->getStyle('P1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('P1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("Q1", "Планирует поступать в магистратуру ВШЭ НН");
        $sheet->getStyle('Q1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('Q1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("R1", "Планирует поступать в магистратуру ВШЭ Москва");
        $sheet->getStyle('R1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('R1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("S1", "Планирует поступать в магистратуру другого ВУЗа");
        $sheet->getStyle('S1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('S1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("T1", "Планирует трудоустроиться(Компания : Должность)");
        $sheet->getStyle('T1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('T1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("U1", "Другое");
        $sheet->getStyle('U1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('U1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("V1", "Согласен на рассылку");
        $sheet->getStyle('V1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('V1')->getFill()->getStartColor()->setRGB('EEEEEE');

        $sheet->setCellValue("W1", "Согласен на обработку персональных данных");
        $sheet->getStyle('W1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('W1')->getFill()->getStartColor()->setRGB('EEEEEE');





    }

    function setColumnParameters($sheet){
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setAutoSize(true);
        $sheet->getColumnDimension('W')->setAutoSize(true);
    }

?>