<?php
    //#####Скрипт аунтефикации#####
    $json = json_decode(file_get_contents('php://input'),true);

    //Получение логина и пароля с экранированием спец символов
    $userLogin = (string)$_POST["login"];
    $userPassword = (string)$_POST["password"];

    //Запрос на выход
    $exit = $json["exit"];

    //*Если пришел запрос на вход
    if($userLogin && $userPassword){
        
        //Подключение соединения с бд
        require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');

        //Поиск id для соли
        $authRequestId = $connect->prepare("SELECT `id` FROM `$tableLogin` WHERE `login` = ?");
        $authRequestId->execute([$userLogin]);
        $checkId = ($authRequestId->fetchAll())[0]["id"];

        if($checkId){ 
            //Соль
            $userSalt = substr($userPassword,0,6) . 'tenoten' . (string)$checkId . $userPassword;

            //Поиск логина и пароля
            $authRequest = $connect->prepare("SELECT `login`,`password` FROM `$tableLogin` WHERE `login` = ?");
            $authRequest->execute([$userLogin]);
            $checkAuth = $authRequest->fetchAll();

            $checkLogin = $checkAuth[0]["login"];
            $checkPassword = $checkAuth[0]["password"];

            //echo $checkLogin;
            if(password_verify($userSalt,$checkPassword)){
                $result = 'success';

                setcookie('cal_login',$checkLogin, time() + 60*60*24*30, '/');
                setcookie('cal_password',$checkPassword, time() + 60*60*24*30, '/');
            }else{
                $result = 'error';
            }
        }else{
            $result = 'error';
        }
    }else{
        $result = 'error';
    }



    //*Если пришел запрос на выход
    if($exit){
        setcookie('cal_login','', time() - 3600,'/');
        setcookie('cal_password','', time() - 3600,'/');

        $result = 'exit';
    }

    echo json_encode(['result' => $result]);
    //#####-----#####
?>