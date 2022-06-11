<?php
    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);

    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
    set_time_limit(0);

    //Подключение соединения с бд
    require($_SERVER['DOCUMENT_ROOT'].'/local/templates/tenoten_calenfar/includes/db_connect.php');
    //Подключение проверки аунтефикации
    require ($_SERVER['DOCUMENT_ROOT']. '/local/templates/tenoten_calenfar/includes/check_auth.php');

    if($checkAuthStatus){
        //Чтение информации о пользователе
        require ($_SERVER['DOCUMENT_ROOT']. '/local/templates/tenoten_calenfar/includes/get_account_info.php');

        /**
        * Если админ
        */
        if($userLogin == "adminTenoten@tenoten.ru"){
            //header("Cache-Control: private",false);
            header('Content-Type: application/vnd.ms-excel; charset=utf-8;');
 
            header('Content-disposition: attachment; filename=xls-tenoten_'.date("d-m-Y").'.xls');
            
            header("Content-Transfer-Encoding: binary ");
            header('Expires: 0');
            header('Pragma: no-cache');
            ?>
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
                <head>
                        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                        <meta name="author" content="tenoten" />
                        <title>Tenoten xls</title>
                    </head>
                    <body>
            <?php

            /**
             * Чтение информации о пользователях
            */
            $requestUsersInfo = $connect->prepare("SELECT `login`,`name`,`check_test` FROM `$tableLogin`");
            $requestUsersInfo->execute([]);

            $usersInfoData = $requestUsersInfo->fetchAll();

            foreach($usersInfoData  as $keyUser => $valueUser){
                /**
                * Получение информации о комментариях
                */
                CModule::IncludeModule('iblock');
                $arSelect = Array('PROPERTY_REVIEW_TEXT');
                $arFilter = array(
                    'IBLOCK_ID' => 15, // ID инфоблока
                    "PROPERTY_USER_LOGIN" => $valueUser['login'], //Сортировка по полю
                );
                $reviewsObj = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

                $reviewsArr = Array();

                while($currentReviewObj = $reviewsObj->GetNextElement())
                {
                    $reviewText = ($currentReviewObj->GetFields())['PROPERTY_REVIEW_TEXT_VALUE']['TEXT'] ;
                    array_push($reviewsArr,$reviewText);
                }


                /**
                * Чтение активности календаря
                */
                $requestCalendarActivity = $connect->prepare("SELECT `dateInsert`, COUNT(*) as count FROM `tenoten_logins` INNER JOIN `tenoten_calendar` ON tenoten_logins.id = tenoten_calendar.loginId WHERE tenoten_logins.login = ? GROUP BY `dateInsert`,`loginId`");
                $requestCalendarActivity->execute([$valueUser['login']]);
                $calendarActivityData = $requestCalendarActivity->fetchAll();

                $rowspan = count($calendarActivityData) > count($reviewsArr) ? count($calendarActivityData): count($reviewsArr);
                if(!$rowspan){
                    $rowspan = 1;
                }
                ?>
                    <table>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;margin-top:50px;text-align:center;">
                        <thead>
                            <tr style="background-color: rgba(230,252,172,.6);">
                                <td style="border:1px solid #ffb157;">Логин</td>
                                <td style="border:1px solid #ffb157;">Имя</td>
                                <td style="border:1px solid #ffb157;">Дата доб. настр.</td>
                                <td style="border:1px solid #ffb157;">Кол-во доб. настр.</td>
                                <td style="border:1px solid #ffb157;">Прохожд. теста</td>
                                <td style="border:1px solid #ffb157;">Отзывы</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border:1px solid #ffb157;" rowspan="<?php echo $rowspan;?>">
                                    <?php echo $valueUser['login'];?>
                                </td>
                                <td style="border:1px solid #ffb157;" rowspan="<?php echo $rowspan;?>">
                                    <?php echo $valueUser['name']; ?>
                                </td> 

                                <?php 
                                    //foreach($calendarActivityData as $keyActivityData => $valueActivityData){
                                    if($calendarActivityData){
                                ?>
                                    <td style="border:1px solid #ffb157;" rowspan="1">
                                        <?php echo date('d.m.Y',strtotime($calendarActivityData[0]['dateInsert']));?>
                                    </td>
                                    <td style="border:1px solid #ffb157;" rowspan="1">
                                        <?php echo $calendarActivityData[0]['count'];?>
                                    </td>
                                <?php }else{ ?>
                                    <td style="border:1px solid #ffb157;" rowspan="<?php echo $rowspan;?>"></td>
                                    <td style="border:1px solid #ffb157;" rowspan="<?php echo $rowspan;?>"></td>
                                <?php } ?>

                                <td style="border:1px solid #ffb157;" rowspan="<?php echo $rowspan;?>">
                                    <?php
                                        if($valueUser['check_test']){
                                    ?>
                                        Да
                                    <?php 
                                        }else{
                                    ?>
                                        Нет
                                    <?php } ?>
                                </td>

            
                                <?php 
                                    if($reviewsArr){
                                ?>
                                    <td style="border:1px solid #ffb157;" rowspan="1">
                                        <?php echo $reviewsArr[0];?>
                                    </td>
                                <?php }else{ ?>
                                    <td style="border:1px solid #ffb157;" rowspan="<?php echo $rowspan;?>"></td>
                                <?php } ?>
                            </tr>

                            <?php 
                                foreach($calendarActivityData as $keyActivityData => $valueActivityData){
                                    if($keyActivityData>0){
                            ?>
                                <tr>
                                    <td style="border:1px solid #ffb157;" rowspan="1">
                                        <?php echo date('d.m.Y',strtotime($valueActivityData['dateInsert']));?>
                                    </td>
                                    <td style="border:1px solid #ffb157;" rowspan="1">
                                        <?php echo $valueActivityData['count'];?>
                                    </td>

                                    <?php if($reviewsArr[$keyActivityData]){?>
                                        <td style="border:1px solid #ffb157;" rowspan="1">
                                            <?php echo $reviewsArr[$keyActivityData];?>
                                        </td>
                                    <?php } ?>
                                    
                                </tr>
                                
                            <?php   
                                    }
                                } 

                                if(count($calendarActivityData) < count($reviewsArr)){
                                    for ($index=count($calendarActivityData); $index < count($reviewsArr); $index++) { 
                                        ?>
                                        <tr>
                                            <td style="border:1px solid #ffb157;" rowspan="1"></td>
                                            <td style="border:1px solid #ffb157;" rowspan="1"></td>
                                            <td style="border:1px solid #ffb157;" rowspan="1">
                                                <?php echo $reviewsArr[$index];?>
                                            </td>
                                    </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                <?php
            }
            ?>              
                </body>
            </html>
            <?php
        }else{
            echo "unregistered";
        }
    }else{
        echo "unregistered";
    }

    //если ругается на него php, то комментим и дальше пользуемся
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>