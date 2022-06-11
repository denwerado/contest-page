<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    /**
     * Шаблон аунтефикации
    */
?>
    <div class="cmp-popup cmp-popup_green" id="authentication">
        <div class="cmp-popup__close">
            <svg><use xlink:href="#close"></use></svg>
        </div>
        <div class="cmp-popup_green-encircles">
           <img src="/konkurs/assets/images/_svg/encircle19.svg" alt="" class="encircle">
           <img src="/konkurs/assets/images/_svg/encircle20.svg" alt="" class="encircle">
           <img src="/konkurs/assets/images/_svg/encircle22.svg" alt="" class="encircle">
           <img src="/konkurs/assets/images/_svg/encircle21.svg" alt="" class="encircle">
           <img src="/konkurs/assets/images/_svg/encircle23.svg" alt="" class="encircle">
           <img src="/konkurs/assets/images/_svg/encircle24.svg" alt="" class="encircle">
           <img src="/konkurs/assets/images/_svg/encircle18.svg" alt="" class="encircle">
        </div>

        <?php if($userLogin == "adminTenoten@tenoten.ru"){ ?>
            <div class="cmp-popup__block" style="max-width:none;">
        <?php }else{ ?>
            <div class="cmp-popup__block">
        <?php } ?>

            <div class="cmp-popup__scroll">
                <?php 
                    //Если человек зарегестрирован
                    if($checkAuthStatus){ 
                ?>
                    <p class="cmp-popup__title">Вы вошли в аккаунт!</p>
                    <?php 
                        if($userLogin == "adminTenoten@tenoten.ru"){
                            $requestUsersInfo = $connect->prepare("SELECT `login`,`name`,`check_test` FROM `$tableLogin`");
                            $requestUsersInfo->execute([]);
                            $usersInfoData = $requestUsersInfo->fetchAll();

                            foreach($usersInfoData  as $keyUser => $valueUser){
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

                                $requestCalendarActivity = $connect->prepare("SELECT `dateInsert`, COUNT(*) as count FROM `tenoten_logins` INNER JOIN `tenoten_calendar` ON tenoten_logins.id = tenoten_calendar.loginId WHERE tenoten_logins.login = ? GROUP BY `dateInsert`,`loginId`");
                                $requestCalendarActivity->execute([$valueUser['login']]);
                                $calendarActivityData = $requestCalendarActivity->fetchAll();
                            ?>
                                <div class="cmp-sql-info">
                                    <ul class="ul sql-head">
                                        <li class="item big">
                                            Логин
                                        </li>
                                        <li class="item medium">
                                            Имя
                                        </li>
                                        <li class="item small">
                                            Дата доб. настр.
                                        </li>
                                        <li class="item small">
                                            Кол-во доб. настр.
                                        </li>
                                        <li class="item small">
                                            Прохожд. теста
                                        </li>
                                        <li class="item big">
                                            Отзывы
                                        </li>
                                    </ul>
                                    <ul class="ul sql-body">

                                        <li class="item big"><?php echo $valueUser['login']?></li>
                                        <li class="item medium"><?php echo $valueUser['name']?></li>
                                        <li class="item small">
                                            <ul class="ul sql-nested">
                                                <?php 
                                                    foreach($calendarActivityData as $keyDateInsert => $valueDateInsert){
                                                ?>
                                                    <li class="item"><?php echo date('d.m.Y',strtotime($valueDateInsert["dateInsert"]))?></li>
                                                <?php }?>
                                            </ul>
                                        </li>
                                        <li class="item small">
                                            <ul class="ul sql-nested">
                                                <?php 
                                                    foreach($calendarActivityData as $keyCountMood => $valueCountMood){
                                                ?>
                                                    <li class="item"><?php echo $valueCountMood["count"];?></li>
                                                <?php }?>
                                            </ul>
                                        </li>
                                        <li class="item small">
                                            <?php
                                                if($valueUser['check_test']){
                                            ?>
                                                Да
                                            <?php }else{ ?>
                                                Нет
                                            <?php } ?>
                                        </li>
                                        <li class="item big">
                                            <ul class="ul sql-nested">
                                                <?php foreach ($reviewsArr as $keyText => $textValue) { ?> 
                                                    <li class="item"><?php echo $textValue;?></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            <?php   
                            }
                        }
                    ?>
                    <button class="button cmp-form__button" id="account_exit">Выйти из аккаунта</button>
                <?php }else{ ?>
                    <p class="cmp-popup__title">Чтобы начать, зарегистрируйтесь или войдите</p>
                    <div class="cmp-form">
                        <div class="cmp-form__toggle">
                            <form id="registration_form">
                                <div class="cmp-form__elements">
                                    <input type="text" name="fullname" class="input cmp-form__input" placeholder="Имя Фамилия" required>
                                    <input type="email" name="email" class="input cmp-form__input" placeholder="Email" required>
                                    <input type="password" name="password" class="input cmp-form__input" placeholder="Введите пароль" minlength="5" required >
                                    <div class="cmp-check">
                                        <label class="cmp-check__label">
                                            <input type="checkbox">
                                            <span class="cmp-check__checkmark"></span>
                                            <span class="cmp-check__message">I have read and agree to the</span>
                                        </label>
                                        <a target="_blank" href="/policity.pdf" class="link cmp-check__agreement">Terms of Service</a>
                                    </div>
                                </div>
                                <button class="button cmp-form__button" disabled>Создать аккаунт</button>
                                <p class="cmp-form__redirect">Уже есть аккаунт? <span class="redirect">Войдите</span></p>
                            </form>
                        </div>
                        <div class="cmp-form__toggle cmp-form__toggle_disabled">
                            <form id="login_form">
                                <div class="cmp-form__elements">
                                    <input type="email" name="login" class="input cmp-form__input" placeholder="Email" required>
                                    <input type="password" name="password" class="input cmp-form__input" placeholder="Введите пароль" required>
                                </div>
                                <button class="button cmp-form__button">Войти</button>
                                <p class="cmp-form__redirect">Нет аккаунта? <span class="redirect">Зарегестрируйтесь</span></p>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>