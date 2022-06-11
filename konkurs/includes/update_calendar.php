<?php
    //#####Скрипт ввода в календарь#####
    $json = json_decode(file_get_contents('php://input'),true);

    //Подключение соединения с бд
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');
    //Проверка зарегестрированности пользователя
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/check_auth.php');

    //Данные для заноса на сервер
    $datesTransferServer = $json;

    //Выдача резульатов
    $result;
    $resultObj;

    if($checkAuthStatus){
        //Текущая дата
        $currentDate = date("d.m.Y");

        //Получение id пользователя
        $requestLoginId = $connect->prepare("SELECT `id` FROM `$tableLogin` WHERE `login` = ?");
        $requestLoginId->execute([$userLogin]);
        $receivingId = $requestLoginId->fetchAll()[0]["id"];

        //Запрос на получение id у настроения
        $requestMoodId = $connect->prepare("SELECT `id` FROM `$tableMoods` WHERE `mood` = ?");

        //Запрос на проверку старых дат
        $requestCheckOldDate = $connect->prepare("SELECT `date` FROM `$tableCalendar` WHERE DATE_FORMAT(`date`,'%d.%m.%Y') = ? AND `loginId` = ?");

        //Запрос на обновление настроения
        $requestUpdateOldDateMood = $connect->prepare("UPDATE `$tableCalendar` SET `moodId` = ?, dateUpdate = ?, display = ? WHERE DATE_FORMAT(`date`,'%d.%m.%Y') = ? AND `loginId` = ?");
        $requestUpdateOldDateDisplay = $connect->prepare("UPDATE `$tableCalendar` SET dateUpdate = ?, display = ? WHERE DATE_FORMAT(`date`,'%d.%m.%Y') = ? AND `loginId` = ?");


        //Запрос на добавление настроения
        $requestInsertMood = $connect->prepare("INSERT INTO `$tableCalendar` (`loginId`,`moodId`,`date`,`dateInsert`,`display`) VALUES (?,?,?,?,?)");


        foreach($datesTransferServer as $dateKey => $dateParametrs){
            if(strtotime(date("d.m.Y",$dateKey)) <= strtotime($currentDate)){

                //Получение id текущего настроения
                $requestMoodId->execute([$dateParametrs["moodname"]]);
                $moodId = $requestMoodId->fetchAll()[0]["id"];

                //Проверка старой даты
                $requestCheckOldDate->execute([$dateKey,$receivingId]);
                $checkOldDate = $requestCheckOldDate->fetchAll()[0]["date"];

                if($checkOldDate){
                    $insertDateUpdate = date("Y-m-d",strtotime($currentDate));

                    if($dateParametrs["display"]){
                        $requestUpdateOldDateMood->execute([$moodId,$insertDateUpdate,1,$dateKey,$receivingId]);
                    }else{
                        $requestUpdateOldDateDisplay->execute([$insertDateUpdate,0,$dateKey,$receivingId]);
                    }
                }else{
                    if($dateParametrs["display"]){
                        $insertDateKey = date("Y-m-d",strtotime($dateKey));
                        $insertDateInsert = date("Y-m-d",strtotime($currentDate));
                        $requestInsertMood->execute([$receivingId,$moodId,$insertDateKey,$insertDateInsert,1]);
                    }
                }
            }
        }



        //Выдача настроений
        $requestCalendarResults = $connect->prepare("SELECT `date`,`severity` FROM `$tableCalendar` INNER JOIN `$tableMoods` ON $tableCalendar.moodId = $tableMoods.id WHERE `loginId` = ? AND `display` > 0");
        $requestCalendarResults->execute([$receivingId]);
        $calendarResults = $requestCalendarResults->fetchAll();

        //Границы начала текущих промежутков
        $yearBorderBeg = strtotime("01" . '.' . "01" . '.' . date("Y"));
        $mounthBorderBeg = strtotime("01" . '.' . date("m") . '.' . date("Y"));
        $weekBorderBeg = strtotime(date("d.m.Y", strtotime('monday this week')));

        //Границы конца текущих промежутков
        $yearBorderEnd = strtotime("31" . '.' . "12" . '.' . date("Y"));
        $mounthBorderEnd = strtotime(date("t") . '.' . date("m") . '.' . date("Y"));
        $weekBorderEnd =  strtotime(date("d.m.Y", strtotime('sunday this week')));


        $bruteForceRules = [
            "year" => [$yearBorderBeg,$yearBorderEnd],
            "mounth" => [$mounthBorderBeg,$mounthBorderEnd],
            "week" => [$weekBorderBeg,$weekBorderEnd]
        ];
        
        foreach($calendarResults as $key => $calendarResultsValue){
            //Дата текущего настроения
            $calendarResultsDate = strtotime($calendarResultsValue["date"]);
            foreach ($bruteForceRules as $dateKey => $intervals) {
                if(($calendarResultsDate>=$intervals[0]) && ($calendarResultsDate<=$intervals[1])){
                    if(!$resultObj[$dateKey]["severity"][$calendarResultsValue["severity"]]){
                        $resultObj[$dateKey]["severity"][$calendarResultsValue["severity"]]["count"] = 0;
                        $resultObj[$dateKey]["severity"][$calendarResultsValue["severity"]]["percent"] = 0;
                    }
                    $resultObj[$dateKey]["severity"][$calendarResultsValue["severity"]]["count"]++;
                    $resultObj[$dateKey]["sum"]++;
                }
            }
        }

        foreach ($resultObj as $resultObjKey => $resultObjValue) {
            foreach ($resultObjValue["severity"] as $severityKey => $severityValue) {
                $severityCount = $resultObj[$resultObjKey]["severity"][$severityKey]["count"];
                
                $resultObj[$resultObjKey]["severity"][$severityKey]["percent"] =  round($severityCount / $resultObj[$resultObjKey]["sum"],4);
            }
        }

        
        $result = $resultObj;

    }else{
        $result = "unregistered";
    }

    //Отправка результата клиенту
    echo json_encode(['result' => $result]);
    //#####-----#####
?>