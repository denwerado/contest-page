<?php
    //Подключение шапки
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
?>
    <main class="main">
        <section class="top">
            <div class="container">
                <div class="top__block">
                    <!--<h1 class="section__title top__title">
                        <span class="text_lightgreen">ТВОЙ НАСТРОЙ<br>НА ПРОДУКТИВНОСТЬ<br>С</span> ТЕНОТЕН 
                    </h1>-->
                    <h1 class="top__title">
                        <span class="text_lightgreen top__title_big">Стань продуктивной</span><br>
                        <span class="text_dargreen">с <span class="text_uppercase top__title_big">ТЕНОТЕН</span></span><br>
                        <span class="text_dargreen">даже в сложной ситуации!</span>
                    </h1>
                    <p class="top__subtitle">– советует психолог <span class="text__semibold">Даша Город</span></p>
                    <div class="top__info">
                        <p class="call text_dargreen">Получи шанс выиграть <span class="call_big">полезный приз:</span></p>
                        <div class="buttons">
                            <?php //Проверка аунтефикации
                                if($checkAuthStatus){ ?>
                                <button class="button cmp-button cmp-button_orange" data-modal="#main-test">Пройти тест</button>
                                <svg class="arrow_down"><use xlink:href="#arrow-down"></use></svg>
                                <a href="#calendar" class="link cmp-button cmp-button_green">Заполняй Календарь настроения</a>
                                <svg class="arrow_down"><use xlink:href="#arrow-down"></use></svg>
                                <button class="button cmp-button cmp-button_green" data-modal="#feedback">Напиши Отзыв</button>
                            <?php }else{ ?>
                                <button class="button cmp-button cmp-button_orange" data-modal="#authentication">Пройти тест</button>
                                <svg class="arrow_down"><use xlink:href="#arrow-down"></use></svg>
                                <a href="#calendar" class="link cmp-button cmp-button_green">Заполняй Календарь настроения</a>
                                <svg class="arrow_down"><use xlink:href="#arrow-down"></use></svg>
                                <button class="button cmp-button cmp-button_green" data-modal="#authentication">Напиши Отзыв</button>
                            <?php } ?>
                        </div>
                        
                        <!--<div class="top__name">
                            <span class="text">Меня зовут</span>
                            <div class="signature">
                                <svg><use xlink:href="#signature"></use></svg>
                                <span>Даша Город</span>
                            </div>
                        </div>
                        <p class="section__description description">Я психолог с большим опытом работы.<br>Я расскажу, как быть спокойной, уверенной и обреcти настрой на успех!</p>
                        <div class="section__description description text_dargreen">А если ты будешь упорна в работе над собой, то получишь шанс выиграть<br><a href="/konkurs/info/" class="">полезный приз</a></div>
                        <div class="buttons">
                            <a href="#calendar" class="link cmp-button cmp-button_orange">Календарь<br>настроения</a>
                        </div>
                        <p class="section__description description desctop"><span class="text_dargreen">Тенотен</span> станет твоим спутником на пути к эффективности и завидной работоспособности!</p>-->
                    </div>    
                </div>
            </div>

            <div class="top__preview">
                <!--<div class="hashtags">
                    <p class="text_dargreen">Будь</p>
                    <p class="text_orange">#вресурсе</p>
                    <p class="text_orange">#вмоменте</p>
                </div>-->
                <div class="overlap">
                    <img class="top__woman" src="/konkurs/assets/images/backgrounds/top_woman.png" alt="">
                </div>
                <div class="background">
                    <svg><use xlink:href="#encircle1"></use></svg>
                    <svg><use xlink:href="#encircle2"></use></svg>
                    <svg><use xlink:href="#encircle29"></use></svg>

                    <?php /* if($checkAuthStatus){ ?>
                        <button class="button cmp-button cmp-button__test" data-modal="#main-test">
                            <div class="ellipse">
                                <div class="ellipse">
                                    <div class="button">Тест</div>
                                </div>
                            </div>
                            <span class="text">оцени свой настрой<br>и узнай, что делать!</span>
                        </button>
                    <?php }else{ ?>
                        <button class="button cmp-button cmp-button__test" data-modal="#authentication">
                            <div class="ellipse">
                                <div class="ellipse">
                                    <div class="button">Тест</div>
                                </div>
                            </div>
                            <span class="text">оцени свой настрой<br>и узнай, что делать!</span>
                        </button>
                    <?php } */ ?>
                </div>

                <div class="cmp-packaging">
                    <p class="top__slogan">
                        <span class="text_dargreen text__bold">Тенотен</span> станет твоим спутником на пути к эффективности и завидной работоспособности!
                    </p>
                    <img src="/konkurs/assets/images/pack1.png" alt="">
                    <span class="text">ру №: ЛП-n (000029)-(рг-ru) от 18.12.19</span>
                </div>
            </div>
        </section>


        <section class="irritants">
            <div class="container">
                <div class="irritants__block">
                    <h2 class="section__title irritants__title">
                        <span class="text_orange">ЧТО МЕШАЕТ ТВОЕЙ</span><br>
                        ПРОДУКТИВНОСТИ?
                    </h2>
                    <div class="irritants__preview">
                        <div class="indication">
                            <svg><use xlink:href="#exclamation_point"></use></svg>
                            <span class="text">ЭТО ВСЕ<br>ВОЛНЕНИЯ,<br>СТРЕССЫ,<br>НЕРВОЗНОСТЬ…</span>
                        </div>  
                        <img class="irritants__background" src="/konkurs/assets/images/backgrounds/irritants__woman.png" alt="">
                    </div>
                    
                </div>
            </div>
 
            <div class="irritants__preview">
                <div class="cmp-encircle">
                    <img src="/konkurs/assets/images/_svg/encircle4.svg" alt="">
                    <p class="cmp-encircle__text"><span class="text_orange">Знакомо?</span><br>Это то, что лишает тебя главного, что необходимо для успеха!</p>
                </div>
                <div class="cmp-encircle">
                    <svg><use xlink:href="#encircle5"></use></svg>
                    <p class="cmp-encircle__text"><span class="text_orange">Ты</span> чувствуешь усталость, никак не можешь приняться за дела, агрессивно реагируешь на всякую неважную ерунду</p>
                </div>
                <div class="cmp-encircle">
                    <img src="/konkurs/assets/images/_svg/encircle6.svg" alt="">
                    <p class="cmp-encircle__text"><span class="text_orange">О</span>ни делают твою голову «шумной» - наполняют ее ненужными мыслями, не дают сосредоточиться на деле, заставляют тратить максимум сил на пустяки…</p>
                </div>
            </div>
        </section>


        <section class="mood">
            <div class="mood__block">
                <h2 class="section__title mood__title"><span class="text_orange">тебе нужен</span> правильный<br>настрой!</h2>
                <div class="mood__preview">
                    <p class="mood__preview-text">Современные исследования показывают: правильный настрой делает успешным. Остальное – не так важно!</p>
                    <img class="mood__background" src="/konkurs/assets/images/backgrounds/mood_woman.png" alt=""> 
                    <div class="cmp-encircle">
                        <img src="/konkurs/assets/images/_svg/encircle7.svg" alt="">
                        <p class="cmp-encircle__text"><span class="text_dargreen">Главное – настрой!</span></p>
                    </div>
                    <div class="cmp-encircle">
                        <img src="/konkurs/assets/images/_svg/encircle8.svg" alt="">
                        <p class="cmp-encircle__text"><span class="text_dargreen">К</span>огда есть правильный настрой – ты чувствуешь уверенность в себе и не выгораешь на рутинных задачах. Успех словно сам плывет в руки!</p>
                    </div>
                    <div class="cmp-encircle">
                        <svg><use xlink:href="#encircle9"></use></svg>
                        <p class="cmp-encircle__text"><span class="text_dargreen">К</span>огда человек<br>спокоен, холоднокровен,  психологически настроен на работу, настроен на успех и достижения, может отрешиться и взять себя в руки -  организм буквально меняет свою физиологию ради результата! </p>
                    </div>
                    <img class="other__encircle" src="/konkurs/assets/images/_svg/encircle15.svg"></img>
                </div>

                <div class="mood__preview">
                    <div class="container">
                        <p class="description">
                            У тебя часто бывает, что начинаешь что-то делать, а оно <span class="text_orange">«не идет»…</span> Пытаешься заставлять себя, но все <span class="text_orange">через силу</span>, словно сама себе делаешь больно!<br>
                            <span class="text_dargreen">Не заставляй себя! Это неправильно и даже вредно!</span>
                        </p>
                        <p class="description">
                            <span class="text_dargreen">Пройди специальный психологический тест</span>
                            , который поможет тебе понять, насколько ты готова прямо сейчас решать свои задачи. Если все окей, - то вперед в бой.<br>
                            <span class="text_dargreen">Ты лучше всех!</span>
                            А если обнаружится проблема, то ты сможешь <span class="text_dargreen">получить рекомендации</span> о том, как ее решать. Причем именно в твоем конкретном случае. 
                        </p>
                    </div>

                    <?php if($checkAuthStatus){ ?>
                        <button class="button cmp-button cmp-button__test" data-modal="#main-test">
                            <div class="ellipse">
                                <div class="ellipse">
                                    <div class="button">Тест</div>
                                </div>
                            </div>
                            <span class="text">оцени свой настрой<br>и узнай, что делать!</span>
                        </button>
                    <?php }else{ ?>
                        <button class="button cmp-button cmp-button__test" data-modal="#authentication">
                            <div class="ellipse">
                                <div class="ellipse">
                                    <div class="button">Тест</div>
                                </div>
                            </div>
                            <span class="text">оцени свой настрой<br>и узнай, что делать!</span>
                        </button>
                    <?php } ?>

                    <img class="mood__background" src="/konkurs/assets/images/backgrounds/mood_woman-rope.png" alt="">
                </div>
            </div>
        </section>


        <section class="recommendations">
            <div class="container">
                <div class="recommendations__block">
                    <img class="recommendations__background" src="/konkurs/assets/images/backgrounds/recommendations_woman.png" alt="">
                    <div class="recommendations__info">
                        <h2 class="section__title recommendations__title">Я рекомендую календарь настроения</h2>
                        <p class="section__description description">
                            <span class="text_dargreen">
                            С помощью календаря настроения ты сможешь вести себя к тому настрою, который тебе нужен, и к успеху, которого заслуживаешь!
                            </span> 
                        </p>
                        <div class="cmp-packaging">
                            <img src="/konkurs/assets/images/pack1.png" alt="">
                            <span class="text">ру №: ЛП-n (000029)-(рг-ru) от 18.12.19</span>
                        </div>
                        <p class="section__description description">
                            <span class="text_dargreen">Тенотен</span> – может быть твоим источником спокойствия и правильного настроя. Но важно, чтобы ты не оставляла работу над собой!</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="stages">
            <div class="container">
                <div class="stages__block">
                    <h2 class="section__title stages__title"><span class="text_orange">как работает</span><br>календарь настроения</h2>
                </div>  
            </div>
            <div class="stages__preview">
                <div class="cmp-encircle">
                    <img src="/konkurs/assets/images/_svg/encircle7.svg" alt="">
                    <div class="cmp-encircle__info">
                        <span class="number">1</span>
                        <div class="cmp-encircle__wrap">
                            <p class="title text_dargreen">Зарегистрируйся</p>  
                            <p class="description">Тебе будут приходить на напоминания о заполнении календаря на электронную почту.</p>
                        </div>
                    </div>
                </div>

                <div class="cmp-encircle">
                    <svg><use xlink:href="#encircle10"></use></svg>
                    <div class="cmp-encircle__info">
                        <span class="number">2</span>
                        <div class="cmp-encircle__wrap">
                            <p class="title text_dargreen">Отметь в календаре своё настроение и делай это каждый день</p>
                            <ul class="ul cmp-encircle__flex">
                                <li class="item">
                                    <svg class="smile"><use xlink:href="#smile_upset"></use></svg>
                                </li>
                                <li class="item">
                                    <svg class="smile"><use xlink:href="#smile_sad"></use></svg>
                                </li>
                                <li class="item">
                                    <svg class="smile"><use xlink:href="#smile_uncertain"></use></svg>
                                </li>
                                <li class="item">
                                    <svg class="smile"><use xlink:href="#smile_smiling"></use></svg>
                                </li>
                                <li class="item">
                                    <svg class="smile"><use xlink:href="#smile_happy"></use></svg>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="cmp-encircle">
                    <svg><use xlink:href="#encircle11"></use></svg>
                    <div class="cmp-encircle__info">
                        <span class="number">3</span>
                        <div class="cmp-encircle__wrap">
                            <p class="title text_dargreen">Проведи анализ результатов минимум через неделю</p>
                            <p class="description">Если видишь, что в твоем календаре много красных ячеек – это признак проблемы. Возможно, это не просто стресс и тебе нужно задуматься о более серьезной работе с депрессивным настроем. </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a name="calendar"></a>
        <section class="calendar">
            <div class="calendar__encircles">
                <svg class="encircle"><use xlink:href="#encircle13"></use></svg>
                <img src="/konkurs/assets/images/_svg/encircle14.svg" alt="" class="encircle">
                <img src="/konkurs/assets/images/_svg/encircle16.svg" alt="" class="encircle">
                <img src="/konkurs/assets/images/_svg/encircle17.svg" alt="" class="encircle">
            </div>
            
            <!--<div class="container">-->
                <div class="calendar__block">
                    <div class="cmp-calendar">
                        <svg class="encircle"><use xlink:href="#encircle12"></use></svg>
                        <img src="/konkurs/assets/images/backgrounds/calendar__woman.png" alt="" class="calendar__note">
                        <p class="section__title cmp-calendar__title">календарь настроения</p>
                        <div class="cmp-calendar__interactive">
                            <div class="cmp-calendar__wrap">
                                <div class="cmp-calendar__numbers" id="cmp-calendar-main"></div>  
                                <div class="cmp-calendar__panel">
                                    <p class="message">Выбери день и нажми на соответствующий твоему настроению смайлик</p>
                                    <div class="cmp-calendar__panel-popup">
                                        <ul class="ul cmp-calendar__panel-interactive">
                                            <li class="cmp-calendar__panel-item" data-prefixclass="bad" data-moodname="Плохое">
                                                <svg class="smile"><use xlink:href="#smile_upset"></use></svg>
                                                <span class="mood">Я на грани</span>
                                            </li>
                                            <li class="cmp-calendar__panel-item" data-prefixclass="sad" data-moodname="Грустное">
                                                <svg class="smile"><use xlink:href="#smile_sad"></use></svg>
                                                <span class="mood">Как-то не очень</span>
                                            </li>
                                            <li class="cmp-calendar__panel-item" data-prefixclass="normal" data-moodname="Нормальное">
                                                <svg class="smile"><use xlink:href="#smile_uncertain"></use></svg>
                                                <span class="mood">Нормально, ни то ни сё</span>
                                            </li>
                                            <li class="cmp-calendar__panel-item" data-prefixclass="positive" data-moodname="Позитивное">
                                                <svg class="smile"><use xlink:href="#smile_smiling"></use></svg>
                                                <span class="mood">На позитиве</span>
                                            </li>
                                            <li class="cmp-calendar__panel-item" data-prefixclass="joyful" data-moodname="Радостное">
                                                <svg class="smile"><use xlink:href="#smile_happy"></use></svg>
                                                <span class="mood">Радуюсь жизни</span>
                                            </li>
                                            <li class="cmp-calendar__panel-button">
                                                <button class="button cmp-button cmp-button_orange-reverse cmp-calendar__reset_day">Сброс дня</button>
                                            </li>
                                            <li class="cmp-calendar__panel-button">
                                                <button class="button cmp-button cmp-button_orange-reverse cmp-calendar__reset_mounth">Сброс месяца</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                             
                            <div class="cmp-calendar__buttons">
                                <?php 
                                    //Проверка аунтефикации
                                    if($checkAuthStatus){ 
                                ?>
                                    <button class="button cmp-button cmp-button_green" id="calendar_result">Подведем итоги</button>
                                <?php 
                                    }else{ 
                                ?> 
                                    <button class="button cmp-button cmp-button_green" data-modal="#authentication">Подведем итоги</button>
                                <?php } ?>

                                <button class="button cmp-button cmp-button_orange-reverse cmp-calendar__reset_day">Сброс дня</button>
                                <button class="button cmp-button cmp-button_orange-reverse cmp-calendar__reset_mounth">Сброс месяца</button>
                            </div>
                        </div>

                        <p class="cmp-calendar__afterword text_dargreen">
                            <!--<span class="text__bold">Держи курс на успех!</span> Работай над собой с <span class="text__bold">Тенотен</span>, заполняй Календарь настроения каждый день и выиграй годовую подписку на Яндекс.Музыку и Кинопоиск HD. <span class="text__bold">Победителями станут 10 самых активных в календаре настроения по итогам месяца.</span>-->
                            <?php if($checkAuthStatus){ ?>
                                <button class="button" data-modal="#feedback">Напишите отзыв</button><br>
                            <?php }else{ ?>
                                <button class="button" data-modal="#authentication">Напишите отзыв</button><br>
                            <?php } ?>
                            Напишите отзыв, как Тенотен и Календарь настроения изменил вашу жизнь и получите возможность выиграть приз!
                        </p>

                        <a href="/konkurs/info/" class="link cmp-button cmp-button_orange">Хочу приз!</a>                   
                    </div> 
                <!--</div>-->
            </div>
            
        </section>
    </main>

    <footer class="footer">
        <div class="footer__preview">
            <img class="footer__flower" src="/konkurs/assets/images/flower.png" alt="">
            <img src="/konkurs/assets/images/slogan.png" alt="" class="footer__slogan">

            <div class="cmp-packaging">
                <img src="/konkurs/assets/images/pack1.png" alt="">
                <span class="text">ру №: ЛП-n (000029)-(рг-ru) от 18.12.19</span>
            </div>
        </div> 
    </footer>

    <div class="cmp-warning">
        <span>ИМЕЮТСЯ ПРОТИВОПОКАЗАНИЯ. ПЕРЕД ПРИМЕНЕНИЕМ ОЗНАКОМЬТЕСЬ С ИНСТРУКЦИЕЙ</span>
    </div>

    <div class="cmp-popup cmp-popup_green" id="results">
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
        <div class="cmp-popup__block">
            <div class="cmp-popup__scroll">
                <p class="cmp-popup__title text_dargreen">Ваше настроение:</p>
                <div class="cmp-popup__flex">
                    <div class="cmp-segencircle">
                        <svg viewBox="-160 -160 320 320">
                            <circle r="138"  class="cmp-segencircle__base"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                        </svg>
                        <p class="cmp-segencircle__text">за&nbsp;неделю</p>
                    </div>

                    <div class="cmp-segencircle">
                        <svg viewBox="-160 -160 320 320">
                            <circle r="138"  class="cmp-segencircle__base"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                        </svg>
                        <p class="cmp-segencircle__text">за&nbsp;месяц</p>
                    </div>

                    <div class="cmp-segencircle">
                        <svg viewBox="-160 -160 320 320">
                            <circle r="138"  class="cmp-segencircle__base"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                            <circle r="138"  class="severity"/>
                        </svg>
                        <p class="cmp-segencircle__text">за&nbsp;год</p>
                    </div>
                </div>
                <ul class="ul cmp-popup__smiles">
                    <li class="item" data-prefixclass="bad" data-moodname="Плохое">
                        <svg class="smile"><use xlink:href="#smile_upset"></use></svg>
                        <span class="mood">Я на грани</span>
                    </li>
                    <li class="item" data-prefixclass="sad" data-moodname="Грустное">
                        <svg class="smile"><use xlink:href="#smile_sad"></use></svg>
                        <span class="mood">Как-то не очень</span>
                    </li>
                    <li class="item" data-prefixclass="normal" data-moodname="Нормальное">
                        <svg class="smile"><use xlink:href="#smile_uncertain"></use></svg>
                        <span class="mood">Нормально, ни то ни сё</span>
                    </li>
                    <li class="item" data-prefixclass="positive" data-moodname="Позитивное">
                        <svg class="smile"><use xlink:href="#smile_smiling"></use></svg>
                        <span class="mood">На позитиве</span>
                    </li>
                    <li class="item" data-prefixclass="joyful" data-moodname="Радостное">
                        <svg class="smile"><use xlink:href="#smile_happy"></use></svg>
                        <span class="mood">Радуюсь жизни</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<?php
    //Подключение подвала
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>