<?php
    //#####Скрипт для добавления отзывов#####
    if (!empty($_POST['review'])) {
        define("NO_KEEP_STATISTIC", true);
        define("NOT_CHECK_PERMISSIONS", true);

        require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
        set_time_limit(0);

        //Получение логина
        $userLogin = (string)$_COOKIE['cal_login'];

        //Подключение соединения с бд
        require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');
        //Подключение проверки аунтефикации
        require ($_SERVER['DOCUMENT_ROOT']. '/local/templates/tenoten_calenfar/includes/check_auth.php');

        if($checkAuthStatus){
            //Чтение информации о пользователе
            require ($_SERVER['DOCUMENT_ROOT']. '/local/templates/tenoten_calenfar/includes/get_account_info.php');

            $currentDateTime = date('d.m.y H:i:s');

            CModule::IncludeModule('iblock');
            $el = new CIBlockElement;

            //Свойства
            $PROP = array();
            $PROP['USER_LOGIN'] = $userLogin; //Логин
            $PROP['USER_NAME'] = $userName;
            $PROP['REVIEW_TEXT'] = Array("VALUE" => Array("TEXT" => htmlspecialchars($_POST['review'],ENT_NOQUOTES), "TYPE" => "text")); //Текст отзыва
            $PROP['REVIEW_DATETIME'] = $currentDateTime; //Свойство чекбокс

            $arLoadProductArray = Array(
                "CREATED_BY"    => $GLOBALS['USER']->GetID(), // элемент изменен текущим пользователем
                "DATE_CREATE" => date("d.m.Y H:i:s"),
                "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                "IBLOCK_ID"      => 15,
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => "Отзыв от " . $userName . " " . $currentDateTime,
                "ACTIVE"         => "Y",            // активен
            );

            if($PRODUCT_ID = $el->Add($arLoadProductArray)){
                $result = "success";
            }else{
                $result = "error";
            }
        }else{
            $result = "unregistered";
        }

        //если ругается на него php, то комментим и дальше пользуемся
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
    }else{
        $result = "incomplete data";
    }

    echo json_encode(['result' => $result]);
    //#####-----#####
?>