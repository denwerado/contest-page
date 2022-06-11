<?php
    //#####Скрипт для отправки клиенту уже полученных дат#####
    $json = json_decode(file_get_contents('php://input'),true);

    //Подключение соединения с бд
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');
    //Проверка зарегестрированности пользователя
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/check_auth.php');


    if($checkAuthStatus){
        //Получение id пользователя
        $requestLoginId = $connect->prepare("SELECT `id` FROM `$tableLogin` WHERE `login` = ?");
        $requestLoginId->execute([$userLogin]);
        $receivingId = $requestLoginId->fetchAll()[0]["id"];

        if($json["request"] == 'oldDates'){
            $requestCalendarOldDates = $connect->prepare("SELECT `date`,`mood` FROM `$tableCalendar` INNER JOIN `$tableMoods` ON $tableCalendar.moodId = $tableMoods.id WHERE `loginId` = ? AND `display` > 0");
            $requestCalendarOldDates->execute([$receivingId]);

            $result = $requestCalendarOldDates->fetchAll();
        }else{
            $result = "error";
        }
    }else{
        $result = "unregistered";
    }

    echo json_encode(['result' => $result]);
    //#####-----#####
?>