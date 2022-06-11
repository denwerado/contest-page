<?php
    //#####Скрипт обновления статуса прохождения теста#####
    $json = json_decode(file_get_contents('php://input'), true);

    //Подключение соединения с бд
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');
    //Проверка зарегестрированности пользователя
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/check_auth.php');

    if($checkAuthStatus){
        if($json["update"] == 'updateTest'){
            $requestUpdateTest = $connect->prepare("UPDATE `$tableLogin` SET `check_test` = ? WHERE `login` = ?");
            $requestUpdateTest->execute([1,$userLogin]);
        }else{
            $result = "invalid request";
        }
    }else{
        $result = "unregistered";
    }

    //Отправка результата клиенту
    echo json_encode(['result' => $result]);
    //#####-----#####

?>