<?php
    //Подключение шапки
    //require dirname(__FILE__) . '/../includes/templates/header.php';
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
?>

    <?php /*<main class="main">
        <section class="prizes">
            <div class="prizes__encircles">
            <img class="encircle" alt="" src="/konkurs/assets/images/_svg/encircle25.svg"></img>
            </div>
            <div class="container">
                <div class="prizes__block">
                    <h1 class="prizes__title">
                        <span class="text_dargreen">Заполняй свой <a href="/konkurs/">календарь настроения</a> как можно чаще и получи шанс</span>
                        <span class="text_orange">выиграть полезный приз!</span>
                    </h1>
                    <p class="section__description prizes__description">Самые активные и целеустремленные получат:</p>
                    <ul class="ul prizes__list">
                        <li class="item">
                            <div class="card">
                                <p class="place">1&nbsp;место</p>
                                <div class="preview">
                                    <div class="circle">
                                        <svg class="sector"><use xlink:href="#enc_sector"></use></svg>
                                        <img class="image" src="/konkurs/assets/images/prizes/phone.png" alt="">
                                        <img src="/konkurs/assets/images/prizes/logo.png" alt="" class="logo">
                                    </div>
                                </div>
                                <p class="title">Главный приз – 10 онлайн-сеансов с психологом на сервисе Ясно.Live</p>
                            </div>
                            <p class="description">Подробней о сервисе можете ознакомиться на сайте: www.yasno.live</p>
                        </li>
                        <li class="item">
                            <div class="card">
                                <p class="place">2&nbsp;и&nbsp;3&nbsp;место</p>
                                <div class="preview">
                                    <div class="circle">
                                        <svg class="sector"><use xlink:href="#enc_sector"></use></svg>
                                        <img class="image" src="/konkurs/assets/images/prizes/hoover.png" alt="">
                                    </div>
                                </div>
                                <p class="title">Пылесос<br>LG VK76A02NTL*</p>
                            </div>
                            <p class="description">Наводишь порядок в голове – наведи порядок и в доме!</p>
                            <p class="afterword"><sup>*</sup>Цвет модели может отличаться от изображенного на сайте</p>
                        </li>
                        <li class="item">
                            <div class="card">
                                <p class="place">3,&nbsp;4,&nbsp;5&nbsp;место</p>
                                <div class="preview">
                                    <div class="circle">
                                        <img class="image" src="/konkurs/assets/images/prizes/woman.png" alt="">
                                    </div>
                                </div>
                                <p class="title">Промокод на годовую подписку Mediatopia</p>
                            </div>
                            <p class="description">
                                <span class="text__bold">Meditopia</span> - это наиболее доступный и эффективный способ личностной трансформации в долгосрочной перспективе. Цель Meditopia – способствовать изменению как самих мыслей, так и поступков.<br><br> 
                                С подробностями можно ознакомиться на сайте: <a href="www.meditopia.com/ru/" class="link">www.meditopia.com/ru/</a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="terms">
            <div class="terms__encircles">
                <img class="encircle" alt="" src="/konkurs/assets/images/_svg/encircle26.svg"></img>
                <img class="encircle" alt="" src="/konkurs/assets/images/_svg/encircle27.svg"></img>
            </div>
            <div class="container">
                <div class="terms__block">
                    <h2 class="terms__title text_dargreen">Для участия в конкурсе вам нужно:</h2>
                    <ul class="ul terms__list">
                        <li class="item">
                            <div class="number"><span>1</span></div>
                            <span class="text">Пройти регистрацию</span>
                        </li>
                        <li class="item">
                            <div class="number"><span>2</span></div>
                            <span class="text">Пройти тест</span>
                        </li>
                        <li class="item">
                            <div class="number"><span>3</span></div>
                            <span class="text">Вести календарь настроения весь период конкурса с 10 февраля 2022 по 31 марта 2022 г.</span>
                        </li>
                        <li class="item">
                            <div class="number"><span>4</span></div>
                            <span class="text">
                                <?php if($checkAuthStatus){ ?>
                                    <button class="button text_dargreen" data-modal="#feedback">Написать отзыв</button>
                                <?php }else{ ?>
                                    <button class="button text_dargreen" data-modal="#authentication">Написать отзыв</button>
                                <?php } ?>
                                , как Тенотен и Календарь настроения изменили вашу жизнь</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="selecting-winners">
            <div class="selecting-winners__encircles">
                <img class="encircle" alt="" src="/konkurs/assets/images/_svg/encircle28.svg"></img>
            </div>
            <div class="container">
                <div class="selecting-winners__block">
                    <h2 class="selecting-winners__title text_dargreen">Как будут выбраны победители:</h2>
                    <p class="section__description selecting-winners__description">
                        <span class="text_orange">Первое место</span> займет самый активный участник, который выполнил два условия конкурса: прошел тест, на ежедневной основе заполняет календарь настроения и написал самый интересный отзыв.<br><br>
                        Если таких будет несколько – выбор будет случайным.<br><br>
                        <span class="text_orange">2 и 3 место</span> – для менее активных, но не менее целеустремленных участников!<br><br> 
                        Выбор будет среди участников не пропускающих заполнение анкеты более 3-х дней за весь период конкурса и написавший отзыв.<br><br> 
                        Если победителей будет несколько – выбор будет сделан Жюри по самому интересному отзыву.<br><br> 
                        <span class="text_orange">3, 4, 5 место</span> – будет разыгрываться среди всех участников, написавших самый интересный отзыв по мнению экспертного жюри.<br><br> 
                        Информация о результатах розыгрыша придет Вам на email указанный при регистрации Календаря настроения.<br><br> 
                        <span class="text__bold">Розыгрыш проводится</span> <span class="text_orange">с 10 февраля по 31 марта 2022 года.</span><br><br> 
                        <span class="text__bold">Результаты будут подведены</span> <span class="text_orange">12 апреля 2022.</span><br><br> 
                        Победителей выберет экспертное жюри организатора конкурса ООО «НПФ «МАТЕРИА МЕДИКА ХОЛДИНГ».<br><br> 
                        Отправка призов осуществляется за счет организатора конкурса только по территории РФ.<br><br>
                        <a target="_blank" href="/konkurs/files/Календарь%20настроения%20Тенотен_Правила%20Конкурса%20Календарь.pdf" class="text_dargreen">Полные условия конкурса</a> 
                    </p>
                </div>
            </div>
        </section>

        <section class="reviews">
            <div class="container">
                <div class="reviews__block">
                    <h2 class="reviews__title text_dargreen">Отзывы</h2>
                    <?php if($checkAuthStatus){ ?>
                        <button class="button cmp-button cmp-button_green" data-modal="#feedback">Оставить отзыв</button>
                    <?php }else{ ?>
                        <button class="button cmp-button cmp-button_green" data-modal="#authentication">Оставить отзыв</button>
                    <?php } 

                        global $arrFilter;
                        $arrFilter = Array(
                            "PROPERTY_REVIEW_DISPLAY_VALUE" => 'да',
                        );

                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "reviews",
                            Array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "Y",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array("",""),
                                "FILTER_NAME" => "arrFilter",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "15",
                                "IBLOCK_TYPE" => "content",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "25",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "pagination",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array("USER_NAME","REVIEW_DATETIME","REVIEW_TEXT",""),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N"
                            ),
                            false
                        );
                    ?>
                </div>
            </div>
        </section>
    </main>*/?>

    <main class="main">
        <section class="winners">
            <div class="container">
                <div class="winners__block">
                    <h1 class="winners__title text__bold text_dargreen">
                        Поздравляем победителей конкурса
                    </h1>

                    <div class="places">
                        <ul class="ul winners__list">
                            <li class="item">
                                <p class="place">1&nbsp;место</p>
                                <p class="name">Татьяна</p>
                                <p class="prize">
                                    <span class="text__semibold text_orange">получает главный приз</span><br>
                                    <span class="text__semibold">
                                        получает главный приз – 10 онлайн-сеансов с психологом на сервисе Ясно.Live
                                    </span>
                                </p>
                                <div class="card">
                                    <div class="preview">
                                        <div class="circle">
                                            <svg class="sector"><use xlink:href="#enc_sector"></use></svg>
                                            <img class="image" src="/konkurs/assets/images/prizes/phone.png" alt="">
                                            <img src="/konkurs/assets/images/prizes/logo.png" alt="" class="logo">
                                        </div>
                                    </div>
                                </div>
                                <p class="description">Календарь настроения настолько вдохновил Ольгу, что она создала целую серию художественных работ, одна из которых украсила эту страницу!</p>
                            </li>
                            <li class="item">
                                <p class="place">2&nbsp;и&nbsp;3&nbsp;место</p>
                                <p class="name">Виктория и Марина</p>
                                <p class="prize">
                                    <span class="text__semibold">
                                        Получают по пылесосу LG VK76A02NTL*
                                    </span>
                                </p>
                                <div class="card">
                                    <div class="preview">
                                        <div class="circle">
                                            <svg class="sector"><use xlink:href="#enc_sector"></use></svg>
                                            <img class="image" src="/konkurs/assets/images/prizes/hoover.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="afterword"><sup>*</sup>Цвет модели может отличаться от изображенного на сайте</p>
                            </li>
                            <li class="item">
                                <p class="place">4,&nbsp;5,&nbsp;6&nbsp;место</p>
                                <p class="name">Наталья, Наталья и Светлана</p>
                                <p class="prize">
                                    <span class="text__semibold">
                                        Получают промокод на годовую подписку Mediatopia
                                    </span>
                                </p>
                                <div class="card">
                                    <div class="preview">
                                        <div class="circle">
                                            <img class="image" src="/konkurs/assets/images/prizes/woman.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <p class="ps text_dargreen text__bold">
                            Жизнь прекрасна, когда настроен на успех!
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
    //Подключение подвала
    //require dirname(__FILE__) . '/../includes/templates/footer.php';
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>