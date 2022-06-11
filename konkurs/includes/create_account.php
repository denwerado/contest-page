<?php
    //#####Скрипт создания аккаунта
    $userFullName = (string)$_POST["fullname"];
    $userEmail = (string)$_POST["email"];
    $userPassword = (string)$_POST["password"];

    $result;

    if($userFullName && $userEmail && $userPassword){
        //Подключение соединения с бд
        require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');

        $requestСheckAccount = $connect->prepare("SELECT `id` FROM `$tableLogin` WHERE `login` = ?");
        $requestСheckAccount->execute([$userEmail]);
        $checkId = ($requestСheckAccount->fetchAll())[0]["id"];

        if(!$checkId){
            //Первичная регистрация
            $requestCreateAccount = $connect->prepare("INSERT INTO `$tableLogin` (`login`,`password`,`name`) VALUES (?,'new_hash',?)");
            $requestCreateAccount->execute([$userEmail,$userFullName]);

            //Получение id для соли
            $requestCreateAccountId = $connect->prepare("SELECT `id` FROM `$tableLogin` WHERE `login` = '$userEmail'");
            $requestCreateAccountId->execute([$userEmail]);
            $checkId = ($requestCreateAccountId->fetchAll())[0]["id"];

            //Получение соли
            $userSalt = substr($userPassword,0,6) . 'tenoten' . (string)$checkId . $userPassword;
            //echo $userSalt;

            //Получение хэша
            $passHash = password_hash($userSalt,PASSWORD_DEFAULT);

            //Занесение хэша
            $requestCreateHash = $connect->prepare("UPDATE `$tableLogin` SET `password` = ? WHERE `login` = ?");
            $requestCreateHash->execute([$passHash,$userEmail]);

            setcookie('cal_login',$userEmail, time() + 60*60*24*30, '/');
            setcookie('cal_password',$passHash, time() + 60*60*24*30, '/');

            $result = "success"; 
            
        }else{
            $result = "exists"; 
        }
    }else{
        $result = "incompletedata";
    }

    //Отправка результата клиенту
    echo json_encode(['result' => $result]);
    //#####-----#####
?>