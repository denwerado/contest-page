<?php
    //#####Скрипт получения информации по аккаунту#####
    if($checkAuthStatus){
        //Получение id пользователя
        $requestUserInfo = $connect->prepare("SELECT `name` FROM `$tableLogin` WHERE `login` = ?");
        $requestUserInfo->execute([$userLogin]);
        $userName = ($requestUserInfo->fetchAll())[0]["name"];
    } 
    //#####-----######
?>