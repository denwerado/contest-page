<?php
    //#####Скрипт проверки аунтефикации#####

    //Получение логина и пароля с экранированием спец символов
    $userLogin = (string) $_COOKIE['cal_login'];
    $userPassword = addslashes((string) $_COOKIE['cal_password']);

    $checkAuthStatus = true;

    if($userLogin && $userPassword){
        //Поиск id
        $authRequestId = $connect->prepare("SELECT `id` FROM `$tableLogin` WHERE `login` = ?");
        $authRequestId->execute([$userLogin]);
        $checkId = ($authRequestId->fetchAll())[0]["id"];

        if($checkId){
            //Поиск логина и пароля
            $authRequest = $connect->prepare("SELECT `login`,`password` FROM `$tableLogin` WHERE `login` = ?");
            $authRequest->execute([$userLogin]);
            $checkAuth = $authRequest->fetchAll();

            $checkLogin = $checkAuth[0]["login"];
            $checkPassword = $checkAuth[0]["password"];

            if(!hash_equals($userPassword,$checkPassword)){
                setcookie('cal_login','', time() - 3600,'/');
                setcookie('cal_password','', time() - 3600,'/');

                //header('Location: /login/');
                $checkAuthStatus = false;
            }
        }else{
            setcookie('cal_login','', time() - 3600,'/');
            setcookie('cal_password','', time() - 3600,'/');

            //header('Location: /login/');
            $checkAuthStatus = false;
        }
    }else{
        setcookie('cal_login','', time() - 3600,'/');
        setcookie('cal_password','', time() - 3600,'/');

        //header('Location: /login/');
        $checkAuthStatus = false;
    }

    //#####-----#####
?>