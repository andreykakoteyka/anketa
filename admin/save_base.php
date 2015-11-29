<?php

    require_once("../functions.php");
    // Подключаем класс для работы с excel
    require_once('../Classes/PHPExcel.php');
    // Подключаем класс для вывода данных в формате excel
    require_once('../Classes/PHPExcel/Writer/Excel2007.php');
    $mysqli = connectDB();
    if($mysqli){
        $query = $mysqli->query("SELECT * FROM base ORDER BY familyName_value");
        // Создаем объект класса PHPExcel
        $xls = new PHPExcel();

        // Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
        // Получаем активный лист
        $sheet = $xls->getActiveSheet();
        // Подписываем лист
        $sheet->setTitle('База выпускников');

        fillBaseHeader($sheet);
        setColumnparameters($sheet);






        $sheet->getRowDimension(1)->setRowHeight(36);

        $counter = 1;
        while($row = mysqli_fetch_assoc($query)){
            ++$counter;
            $sheet  ->setCellValue("A".$counter, $row["id"])
                    ->setCellValue("B".$counter, $row["familyName_value"])
                    ->setCellValue("C".$counter, $row["firstName_value"])
                    ->setCellValue("D".$counter, $row["lastName_value"])
                    ->setCellValue("E".$counter, $row["birthDate_value"])
                    ->setCellValue("F".$counter, $row["stageOfStudying_value"])
                    ->setCellValue("G".$counter, $row["faculty_value"])
                    ->setCellValue("H".$counter, $row["group_value"])
                    ->setCellValue("I".$counter, $row["phone_value"])
                    ->setCellValue("J".$counter, $row["email_value"])
                    ->setCellValue("K".$counter, $row["haveAJobNow_value"])
                    ->setCellValue("L".$counter, $row["currentTimeWorkplace_value"])
                    ->setCellValue("M".$counter, $row["currentTimePost_value"])
                    ->setCellValue("N".$counter, $row["hadAJobAtLastYearSt_value"])
                    ->setCellValue("O".$counter, $row["lastYearStWorkplace_value"])
                    ->setCellValue("P".$counter, $row["lastYearStPost_value"]);
            if($row["hsenn_value"] != ""){
                $sheet->setCellValue("Q".$counter, "Да");
            }
            else{
                $sheet->setCellValue("Q".$counter, "Нет");
            }

            if($row["hseMoscow_value"] != ""){
                $sheet->setCellValue("R".$counter, "Да");
            }
            else{
                $sheet->setCellValue("R".$counter, "Нет");
            }

            if($row["otherHE_value"] != ""){
                $string = trim($row["otherHE_value"]);
                $HE = substr($string, 100);
                $sheet->setCellValue("S".$counter, "Да");
            }
            else{
                $sheet->setCellValue("S".$counter, "Нет");
            }

            if($row["goingToGetAJob_value"] != ""){
                $sheet->setCellValue("T".$counter, "Да"."(".$row["goingToGetAJobWorkplace_value"]. ":" . $row["goingToGetAJobPost_value"] .")");
            }
            else{
                $sheet->setCellValue("T".$counter, "Нет");
            }

            if($row["otherCheckbox_value"] != ""){
                $other = substr($row["otherCheckbox_value"], 54, strlen($row["otherCheckbox_value"]) - 55);
                $sheet->setCellValue("U".$counter, $other);
            }

            if($row["weeklyNewsletter_value"] != ""){
                $sheet->setCellValue("V".$counter, "Да");
            }
            else{
                $sheet->setCellValue("V".$counter, "Нет");
            }

            if($row["savingHandlingData_value"] != ""){
                $sheet->setCellValue("W".$counter, "Да");
            }
            else{
                $sheet->setCellValue("W".$counter, "Нет");
            }

            $sheet->getRowDimension($counter)->setRowHeight(18);
        }
        // Выводим HTTP-заголовки
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=Base". date("dmyhis") . ".xls" );

        // Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');

    }
    else{
        print "Error";
    }
?>