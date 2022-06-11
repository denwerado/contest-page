jQuery(document).ready(function($){
    //#####Глобальный объект#####
    let globalObj = new Object;

    //Цвет настроения и само настроение
    globalObj["moodname"] = "";
    globalObj["prefixClass"] = "";
    globalObj["selectedDate"] = "";
    //#####-----#####

    //Высота окна
    globalObj["windowHeight"] = window.innerHeight;
    $(window).resize(function() {
        globalObj["windowHeight"] = window.innerHeight;
    });




    //######Включение фона у меню######
    $(window).on('scroll', function(e){
        if($(this).scrollTop() > 70){
            $('.header').addClass('header_scrolled');
        }else{
            $('.header').removeClass('header_scrolled');
        }
    });

    if($(window).scrollTop() > 70){
        $('.header').addClass('header_scrolled');
    }
    //#####-----#####





    //#####Верхнее меню######
    if($('.header__burger')){
        $('.header__burger').on('click',()=>{
            $('.header__menu').toggleClass('header__menu_active');
            $('.header__burger').toggleClass('header__burger_active');
        });

        $(window).on('click',function(e){
            let element = $(e.target);
            if(!element.closest('.header__burger').length && !element.closest('.header__menu').length){
                $('.header__menu').removeClass('header__menu_active');
                $('.header__burger').removeClass('header__burger_active');
            }
        });
    }
    //#####-----#####





    //######Плавность якорей на странице######
    $('a[href*="#"]').on("click", function(e){
        //e.preventDefault();
        let anchor = $(this);
        let href = anchor.attr('href').split('#')[1];

        let anchorEl = $('[name="' + href + '"]');

        $('html, body').stop().animate({
            scrollTop: anchorEl.offset().top - 60
        }, 1000);
    });
    //#####-----#####



    

    //######Модальные окна######
    $('[data-modal*="#"]').on("click", function(event){
        let button = event.target;
        let dataModal = button.dataset.modal;

        while(!dataModal){
            button = button.parentElement
            dataModal = button.dataset.modal;
        }

        let modal = $(dataModal);
        modal.addClass('cmp-popup_active');

        $('html, body').css('overflow', 'hidden');
    });

    $(document).on('click','.cmp-popup__close',function(e){
        let modal = $(e.target).closest('.cmp-popup_active');

        modal.removeClass('cmp-popup_active');
        $('html, body').css('overflow', 'visible');
    });
    //#####-----#####





    //!#-#РАБОТА С INPUT-АМИ и Формами#-#
    //#####Функция проверки заполненности полей#####
    function checkFullnessInputs (checkInputs, ignoredInputs){
        //Заполненность по умолчанию true
        let checkSwith = true;

        //Массив для проверки радиокнопок
        let checkRadioValues = new Array();

        $.each(checkInputs,function(index,input){
            //?Если данный input не игнорируется
            if(ignoredInputs.indexOf(index) == -1){
                
                //Если не заполнен, не readonly, type - не радокнопка
                if(!input.value && !$(input).attr("readonly") && input.type != "radio"){
                    checkSwith  = false;
                }

                //Если type - радиокнопка
                if(input.type == "radio" && !$(input).attr("disabled")){
                    if(input.checked){
                        checkRadioValues[input.name] = true;
                    }else{
                        if(checkRadioValues[input.name] != true){
                            checkRadioValues[input.name] = false;
                        }
                    }
                }
            }
        });

        //*Обработка радиокнопок
        for(radioInput in checkRadioValues){
            if(!checkRadioValues[radioInput]){
                checkSwith  = false;
            }
        }

        //Возрат валидности (false или true)
        return checkSwith;
    }
    //#####-----#####



    //#####Чекбокс соглашения#####
    $('.cmp-check__label input[type="checkbox"]').on('change', function(event){
        let button = $(event.target).closest('form').find('button');
        if (!$(this).prop('checked')) {
            button.prop('disabled', true)
        }else{
            button.prop('disabled', false)
        }
    });
    //#####-----#####



    //#####Переключение форм#####
    $('.cmp-form__redirect .redirect').on('click', function (event){
        let redirectElement = $(event.target);
        let cmpForm = redirectElement.closest('.cmp-form');
        let cmpFormToggle = cmpForm.find('.cmp-form__toggle');

        cmpFormToggle.each(function( index, element ) {
            let cmpFormToggleElement = $(element);

            if(cmpFormToggleElement.hasClass("cmp-form__toggle_disabled")){
                cmpFormToggleElement.removeClass("cmp-form__toggle_disabled");
            }else{
                cmpFormToggleElement.addClass("cmp-form__toggle_disabled");
            }
        });


        //Удаление сообщения об ошибке
        let cmpFormElements = $(cmpFormToggle).find('.cmp-form__elements');
        let cmpFormError = cmpFormElements.find('.cmp-form__error');
        

        if(cmpFormError.length){
            cmpFormError.remove();
        }
            
    });
    //#####-----#####



    //#####Регистрация#####
    $('#registration_form').on('submit', function (event) {
        //Путь до файла php
        let dirPhp = '/konkurs/includes/create_account.php';

        event.preventDefault ? event.preventDefault() : event.returnValue = false;

        var req = new XMLHttpRequest();
        req.open('POST', dirPhp, true);

        let cmpFormElements = $(event.target).find('.cmp-form__elements');
        let cmpFormError = cmpFormElements.find('.cmp-form__error');
        

        if(cmpFormError.length){
            cmpFormError.remove();
        }
        
        req.onload = function() {
            if (req.status >= 200 && req.status < 400) {
                json = JSON.parse(this.response);
                
                //В случае успеха или неудачи
                if (json.result == "success") {
                    cmpFormElements.append("<p class='cmp-form__success'>Выполняется вход...</p>");
                    location.reload();
                } 

                if(json.result == "exists"){
                    cmpFormElements.append("<p class='cmp-form__error'>Такой аккаунт уже существует!</p>");
                }

                if(json.result == "incompletedata"){
                    cmpFormElements.append("<p class='cmp-form__error'>Введены не все данные!</p>");
                }

            // Если не удалось связаться с php файлом
            } else{
                cmpFormElements.append("<p class='cmp-form__error'>Ошибка сервера, пожалуйста, свяжитесь с администратором сайта или повторите попытку позже</p>");
            }
        };

        // Если не удалось отправить запрос. Стоит блок на хостинге
        req.onerror = function() {
            cmpFormElements.append("<p class='cmp-form__error'>Ошибка хостинга, пожалуйста, свяжитесь с администратором сайта или повторите попытку позже</p>");
        };
        req.send(new FormData(event.target));
    });
    //#####-----#####



    //#####Аунтефикация#####
    $('#login_form').on('submit', function (event) {
        //Путь до файла php
        let dirPhp = '/konkurs/includes/authentication.php';

        event.preventDefault ? event.preventDefault() : event.returnValue = false;

        var req = new XMLHttpRequest();
        req.open('POST', dirPhp, true);

        let cmpFormElements = $(event.target).find('.cmp-form__elements');
        let cmpFormError = cmpFormElements.find('.cmp-form__error');
        if(cmpFormError.length){
            cmpFormError.remove();
        }

        req.onload = function() {
            if (req.status >= 200 && req.status < 400) {
                json = JSON.parse(this.response);
                
                if (json.result == "success"){
                    cmpFormElements.append("<p class='cmp-form__success'>Выполняется вход...</p>");
                    location.reload();
                }
                
                if(json.result == "error"){
                    cmpFormElements.append("<p class='cmp-form__error'>Неверный или логин или пароль!</p>");
                }

            // Если не удалось связаться с php файлом
            } else{
                cmpFormElements.append("<p class='cmp-form__error'>Ошибка сервера, пожалуйста, свяжитесь с администратором сайта или повторите попытку позже</p>");
            }
        };

        // Если не удалось отправить запрос. Стоит блок на хостинге
        req.onerror = function() {
            cmpFormElements.append("<p class='cmp-form__error'>Ошибка хостинга, пожалуйста, свяжитесь с администратором сайта или повторите попытку позже</p>");
        };
        req.send(new FormData(event.target));
    });
    //#####-----#####



    //#####Обратная связь (отзывы)#####
    $('#review_form').on('submit', function (event) {
        $('.cmp-loader').addClass('cmp-loader_active');

        //Путь до файла php
        let dirPhp = '/konkurs/includes/add_feedback.php';

        event.preventDefault ? event.preventDefault() : event.returnValue = false;

        var req = new XMLHttpRequest();
        req.open('POST', dirPhp, true);

        let cmpFormElements = $(event.target).find('.cmp-form__elements');
        let cmpFormError = cmpFormElements.find('.cmp-form__error');
        if(cmpFormError.length){
            cmpFormError.remove();
        }

        req.onload = function() {
            if (req.status >= 200 && req.status < 400) {
                json = JSON.parse(this.response);
                
                if(json.result == "success"){
                    cmpFormElements.find('textarea')[0].value = '';
                    cmpFormElements.append("<p class='cmp-form__success'>Спасибо за ваш отзыв! Он отправлен на модерацию.</p>");
                }

                if(json.result == "error"){
                    cmpFormElements.append("<p class='cmp-form__error'>Ошибка добавления отзыва! Пожалуйста, попробуйте позже или обратитесь в техподдержку.</p>");
                }
                $('.cmp-loader').removeClass('cmp-loader_active');
            // Если не удалось связаться с php файлом
            } else{
                cmpFormElements.append("<p class='cmp-form__error'>Ошибка добавления отзыва! Пожалуйста, попробуйте позже или обратитесь в техподдержку.</p>");
                $('.cmp-loader').removeClass('cmp-loader_active');
            }
        };

        // Если не удалось отправить запрос. Стоит блок на хостинге
        req.onerror = function() {
            cmpFormElements.append("<p class='cmp-form__error'>Ошибка добавления отзыва! Пожалуйста, попробуйте позже или обратитесь в техподдержку.</p>");
            $('.cmp-loader').removeClass('cmp-loader_active');
        };
        req.send(new FormData(event.target));
    });
    //#####-----#####



    //#####Выход из аккаунта#####
    $('#account_exit').on('click', ()=>{
        let exitData = {
            "exit": "exit"
        }
        
        let json = JSON.stringify(exitData);
        let request = new XMLHttpRequest();
        
        request.open("POST", "/konkurs/includes/authentication.php", true);
        request.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        request.send(json);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200){
                result = JSON.parse(this.response);
                if(result["result"] == "exit"){
                    location.reload();
                }
            }
        }
    });
    //#####-----#####
    //!#-#-----#-#




    
    //#####Чтение JSON#####
    async function readJson(url){
        let requestURL = url;

        let request = new XMLHttpRequest();
        request.open('GET', requestURL);
        request.responseType = 'json';
        request.send();
        request.onload = function() {
            readJsonData = request.response;

            if(readJsonData["test"]){
                parsingTest(readJsonData);
            }

            if(readJsonData["results"]){
                insertingResult(readJsonData);
            }
        }
    }
    //#####-----#####





    //!#-#Функционал теста#-#!
    if($('#main-test').length){
    
        //*Данные теста
        let dataTest = {};
        dataTest["questionNumber"] = 0;



        //#####Парсинг теста#####
        function parsingTest(parsingTestData){
            dataTest["fullInfo"] = parsingTestData;

            //Количество вопросов
            dataTest["questionQuantity"] = Object.keys(dataTest["fullInfo"]["test"]).length;

            //Количество интервалов
            dataTest["intervalsQuantity"] = Object.keys(dataTest["fullInfo"]["intervals"]).length;
            
            //Создание значений для интервалов
            for (let index = 0; index < dataTest["intervalsQuantity"]; index++) {
                let indexIntervalName = "interval" + (index+1) + "Value";
                dataTest[indexIntervalName] = 0;
            }

            insertingQuestion(dataTest["questionNumber"]);
        }
        readJson('/konkurs/assets/json/test.json');
        //#####-----#####



        //#####Вставка результата#####
        function insertingResult(insertingResultData){
            //Обновление статуса прохождения теста
            let updateData = {
                'update' : 'updateTest',
            }
            let json = JSON.stringify(updateData);
            let request = new XMLHttpRequest();

            request.open("POST", "/konkurs/includes/update_test_status.php", true);
            request.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            request.send(json);

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200){
                    
                }
            }

            //Вставка результата
            let cmpTest = $(".cmp-test");

            let cmpPopup = cmpTest.closest(".cmp-popup");
            let cmpPopupSmiles =  cmpPopup.find(".cmp-popup__smiles");
            cmpPopupSmiles.css({'display' : 'block'});

            let cmpTestQuestion = cmpTest.find('.cmp-test__question');
            cmpTestQuestion.css({"display" : "none"});

            //Перебор интервалов
            for (let index = 0; index < dataTest["intervalsQuantity"]; index++) {
                let indexName = "interval" + (index+1);
                let indexIntervalName = "interval" + (index+1) + "Value";

                //Перебор Результатов
                $.each(insertingResultData["results"][indexName], function( intervals, results ) {
                    let lowerInterval = Number(intervals.split('-')[0]);
                    let upperInterval = Number(intervals.split('-')[1]);

                    if((dataTest[indexIntervalName] >= lowerInterval && dataTest[indexIntervalName] <= upperInterval) || (dataTest[indexIntervalName]>=11 &&  intervals == "11+")){
                        cmpTest.append("<div class='cmp-test__result'>" + results + "</div>");
                    }
                });
            }

            $('.cmp-loader').removeClass('cmp-loader_active');
        }  
        //#####-----#####



        //#####Вставка вопроса#####
        function insertingQuestion(questionNumber){
            let mainTest = $('#main-test');

            let cmpTest = mainTest.find('.cmp-test');

            let index = 0;

            //Перебор теста
            $.each(dataTest["fullInfo"]["test"], function( titles, variants ) {
                if(questionNumber == index){

                    //Вставка номера вопроса
                    let cmpTestNumber = cmpTest.find('.cmp-test__number');
                    cmpTestNumber.text('Вопрос ' + (index+1) + ':');

                    //Вставка заголовка
                    let cmpTestTitle = cmpTest.find('.cmp-test__title');
                    cmpTestTitle.text(titles);

                    //Вставка сообщения
                    let cmpTestMessage = cmpTest.find('.cmp-test__message');
                    cmpTestMessage.text('Варианты ответа');

                    //Варианты ответов
                    let cmpTestVariants = cmpTest.find('.cmp-test__variants');
                    cmpTestVariants.empty();

                    let variantIndex = 0;
                    $.each(variants, function( variant, variantPrice ) {
                        cmpTestVariants.append(`<li class="item">
                                                    <input name="question` + index + `" type="radio" id="variant` + variantIndex + `" value="` + variantPrice + `">
                                                    <label class="label" for="variant` + variantIndex + `">
                                                        <span class="text">` + variant + `</span>
                                                        <div class="flag"></div>
                                                    </label>
                                                </li>`);

                        variantIndex++;
                    });
                }
                index++
            });
        }
        //#####-----#####



        //#####Переключение и сбор результатов теста#####
        $('.cmp-test__header .cmp-test__arrow').on('click', function(event){
            let cmpTest = $(event.target).closest(".cmp-test");
            let cmpTestVariants = cmpTest.find('input');

            //Проверка заполненности 
            let checkValidity = checkFullnessInputs(cmpTestVariants,[-1]);

            //Вставка сообщения
            let cmpTestMessage = cmpTest.find('.cmp-test__message');

            //Отключение анимации
            cmpTestMessage.removeClass('animate__animated');
            cmpTestMessage.removeClass('animate__heartBeat');

            //Если поля заполнены
            if(checkValidity){
                //Поиск отмеченного элемента
                let cmpTestChekedInput = cmpTest.find('input:checked');
                let cmpTestChekedInputValue = Number(cmpTestChekedInput[0].value);
 
                //Перебор интервалов
                for (let index = 0; index < dataTest["intervalsQuantity"]; index++) {
                    let indexName = "interval" + (index+1);
                    let interval = dataTest["fullInfo"]["intervals"][indexName];
                    let lowerInterval = Number(interval.split('-')[0]);
                    let upperInterval = Number(interval.split('-')[1]);
                    
                    if(((dataTest["questionNumber"]+1)) >= lowerInterval && ((dataTest["questionNumber"]+1)) <= upperInterval){
                        let indexIntervalName = "interval" + (index+1) + "Value";
                        dataTest[indexIntervalName] += cmpTestChekedInputValue;
                    }
                }

                //Переключение вопроса
                dataTest["questionNumber"]++;
                
                if(dataTest["questionNumber"] < dataTest["questionQuantity"]){
                    insertingQuestion(dataTest["questionNumber"]);
                }else{
                    $('.cmp-loader').addClass('cmp-loader_active');
                    readJson('/konkurs/assets/json/test_result.json');
                }
            }else{
                cmpTestMessage.text('Пожалуйста, выберите вариант ответа!');

                setTimeout(()=>{
                    cmpTestMessage.addClass('animate__animated');
                    cmpTestMessage.addClass('animate__heartBeat');
                },150);
            }   
        });
        //#####-----#####



        //#####Доп функции#####
        $('.cmp-test').on('click', '.cmp-test__toggle-switch', function(e){
            let cmpTestToggleSwitch = $(e.target);

            let cmpTestToggle = cmpTestToggleSwitch.closest('.cmp-test__result').find('.cmp-test__toggle');

            cmpTestToggle.slideToggle();
            
            cmpTestToggleSwitch.remove();
            
        });
        //#####-----#####
    }
    //!#-#-----#-#





    //!#-#Работа с datepicker#-#!
    //#####Инициализация русского языка#####
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    //#####-----#####

    

    //*Массив выбранных дат
    let activeDates = new Object();
    let activeOldDates = new Object();


    //*Текущее число
    let currentDay = new Date().getDate();
    let currentMounth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let currentDate = new Date(currentYear,currentMounth,currentDay);



    //#####Преключение отображения дат#####
    function addOrRemoveDate(date){
        //*Если такого объекта нет
        if(!activeDates[date]) {
            let oldClassElement = '';
            let classElement = '';
            let displayElement = false;

            if(activeOldDates[date]){
                oldClassElement = activeOldDates[date]["class"];
                classElement  = oldClassElement;
                displayElement = true;
            }

            //Инициализируем объект
            activeDates[date] = {
                "moodname" : '',
                "oldClass" : oldClassElement,
                "class" : classElement,
                "display" : displayElement
            }
        }

        //*Находим действующ. сейчас класс
        let activeDatesClass = 'ui-td-active_' + globalObj["prefixClass"];


        if ((activeDates[date]["display"] && (activeDates[date]["class"] == activeDatesClass)) || (!globalObj["prefixClass"] && !globalObj["moodname"])){
            activeDates[date]["moodname"] = "";
            activeDates[date]["oldClass"] = activeDates[date]["class"];
            activeDates[date]["class"] = "";
            activeDates[date]["display"] = false;
        }else{
            activeDates[date]["moodname"] = globalObj["moodname"];

            if(activeDates[date]["class"]){
                activeDates[date]["oldClass"] = activeDates[date]["class"];
            }

            activeDates[date]["class"] = activeDatesClass;
            activeDates[date]["display"] = true;
        }
        addStyleActiveDate(date);
    }
    //#####-----#####



    //####Вставка 0 перед числом#####
    function padNumber(number) {
        var ret = new String(number);
        if (ret.length == 1) 
            ret = "0" + ret;
        return ret;
    }
    //#####-----#####



    //#####Получение пользовательской даты#####
    function receiveСustomDate(systemDate) {
        let customYear = systemDate.getFullYear();
        let customMonth = padNumber(systemDate.getMonth() + 1);
        let customDay = padNumber(systemDate.getDate());
        let customDateString = customDay + "." + customMonth + "." + customYear;

        return customDateString;
    }
    //#####-----######



    //#####Применение стилей для активной даты#####
    function addStyleActiveDate(dateText){
        let uiStateActiveTd =  $('.ui-state-active').closest('td');
        uiStateActiveTd.removeClass(activeDates[dateText]["oldClass"]);

        if(activeDates[dateText]["display"]){
            uiStateActiveTd.addClass(activeDates[dateText]["class"]);
        }

        setTimeout(()=>{
            let cmpCalendarPanelItemActive = $('.cmp-calendar__panel-item_active');
            cmpCalendarPanelItemActive.removeClass('cmp-calendar__panel-item_active');
        },500);
    };
    //#####-----#####



    //#####Инициалицация календаря#####
    $("#cmp-calendar-main").datepicker({
        //Минимальная дата
        minDate: new Date(currentYear,0,1),

        //*При обновлении DOM виджета 
        onUpdateDatepicker: function () {
            //Удаление текста в пустых полях
            $(".ui-state-disabled").empty();
        },

        //*При выборе даты
        onSelect: function(dateText) {
            //Проверка отображения смайликов
            let cmpCalendarPanelPopup = $('.cmp-calendar__panel-popup');
            cmpCalendarPanelPopupDisplay = cmpCalendarPanelPopup.css('display');

            if(cmpCalendarPanelPopupDisplay != 'none'){
                globalObj["selectedDate"] = dateText;

                if(!globalObj["moodname"] && !globalObj["prefixClass"]){
                    let cmpCalendarPanelItems = cmpCalendarPanelPopup.find('.cmp-calendar__panel-item');
                    cmpCalendarPanelItems.addClass('animate__animated');
                    cmpCalendarPanelItems.addClass('animate__bounce');

                    setTimeout(()=>{
                        cmpCalendarPanelItems.removeClass('animate__animated');
                        cmpCalendarPanelItems.removeClass('animate__bounce');
                    },1000);
                }
            }else{
                $('html, body').css('overflow', 'hidden');
                $('.cmp-calendar').css('z-index', '5');
                cmpCalendarPanelPopup.css({"display" : "flex"});

                globalObj["selectedDate"] = dateText;
            }
        },

        //*Принятие даты в качестве параметра
        beforeShowDay: function (systemDate) {
            //Получение пользовательской даты
            let dateString = receiveСustomDate(systemDate);

            //Получение даты в формате js
            let dateCalendar = new Date(systemDate.getFullYear(),systemDate.getMonth(),systemDate.getDate());


            //Проверка на отображение стилей даты
            let checkDate
            if(activeDates[dateString]) {
                if(activeDates[dateString]["display"]){
                    checkDate = true;
                }else{
                    checkDate = false;
                }
            }else{
                checkDate = false;
            }


            if(dateCalendar.valueOf() <= currentDate.valueOf()){

                //Вывод класса в зависимости от отбражения
                if(checkDate) {
                    return [true, activeDates[dateString]["class"]];
                }else{
                    if(activeOldDates[dateString] && !activeDates[dateString]){
                        return [true, activeOldDates[dateString]["class"]];
                    }else{
                        return [true, ""];
                    }
                }
            }else{
                //Блокируем дату
                return [true, "ui-datepicker-unselectable"];
            }
        }
    });
    //#####-----#####



    //#####Запись настроения#####
    $('.cmp-calendar__panel-item').on('click', function (event) {
        let cmpCalendarPanelItem = $(event.target).closest('.cmp-calendar__panel-item');

        if(!cmpCalendarPanelItem.hasClass('.cmp-calendar__panel-item_active')){
            let cmpCalendarPanelItemActive = $('.cmp-calendar__panel-item_active');

            cmpCalendarPanelItemActive.removeClass('cmp-calendar__panel-item_active');
            cmpCalendarPanelItem.addClass('cmp-calendar__panel-item_active');

            globalObj["moodname"] = cmpCalendarPanelItem.attr('data-moodname');
            globalObj["prefixClass"] = cmpCalendarPanelItem.attr('data-prefixclass');
        }   

        //Если до этого не был клик на дате
        if(!globalObj["selectedDate"]){
            let systemDate = $("#cmp-calendar-main").datepicker("getDate");
            let customDate = receiveСustomDate(systemDate);
            globalObj["selectedDate"] = customDate
        }
        addOrRemoveDate(globalObj["selectedDate"]);


        //Проверка отображения смайликов
        let cmpCalendarPanelPopup = cmpCalendarPanelItem.closest('.cmp-calendar__panel-popup');
        cmpCalendarPanelPopupDisplay = cmpCalendarPanelPopup.css('display');

        if(cmpCalendarPanelPopupDisplay == "flex"){
            cmpCalendarPanelPopup.css({"display" : "none"});
            $('.cmp-calendar').css('z-index', '');
            $('html, body').css('overflow', 'visible');
        }
    });
    //#####-----#####



    //#####Нажатие на кнопку подведем итоги#####
    $('#calendar_result').on('click', function() {
        $('.cmp-loader').addClass('cmp-loader_active');

        let datesTransferServer = new Object;

        //Парсинг значений
        for (let key in activeDates) {
            datesTransferServer[key] = {
                "moodname" : '',
                "display" : ''
            }
            datesTransferServer[key]["moodname"] = activeDates[key]["moodname"];
            datesTransferServer[key]["display"] = activeDates[key]["display"];
        }

        let json = JSON.stringify(datesTransferServer);
        let request = new XMLHttpRequest();
        
        request.open("POST", "/konkurs/includes/update_calendar.php", true);
        request.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        request.send(json);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200){
                let  results = JSON.parse(this.response)["result"];

                if(results == "unregistered"){
                    console.log("Незарегестрированный пользователь");
                }else{
                    outputResults(results);
                }
            }
        }
    });
    //#####-----#####



    //#####Нажатие на кнопку сбросить день#####
    $('.cmp-calendar__reset_day').on('click', function(event) {
        let cmpCalendarResetDay = $(event.target);

        let systemDate = $("#cmp-calendar-main").datepicker("getDate");
        let customDate = receiveСustomDate(systemDate);
        
        globalObj["moodname"] = "";
        globalObj["prefixClass"] = "";

        if(activeDates[customDate] || activeOldDates[customDate]){
            addOrRemoveDate(customDate);
        }


        let cmpCalendarPanelPopup = cmpCalendarResetDay.closest('.cmp-calendar__panel-popup');
        cmpCalendarPanelPopupDisplay = cmpCalendarPanelPopup.css('display');

        if(cmpCalendarPanelPopupDisplay == "flex"){
            cmpCalendarPanelPopup.css({"display" : "none"});
            $('.cmp-calendar').css('z-index', '');
            $('html, body').css('overflow', 'visible');
        }
    });
    //#####-----######


    
    //######Нажатие на кнопку сбросить день#####
    $('.cmp-calendar__reset_mounth').on('click', function(event) {
        let cmpCalendarResetMounth = $(event.target);

        globalObj["moodname"] = "";
        globalObj["prefixClass"] = "";

        let systemDateMounthBeg = new Date(currentYear,currentMounth,1);
        let customDateMounthEnd = new Date(currentYear,currentMounth+1,0);

        let systemNextDateMounth = systemDateMounthBeg;

        while(systemNextDateMounth.valueOf() <= customDateMounthEnd .valueOf()){
            let customDate = receiveСustomDate(systemNextDateMounth);

            if(activeDates[customDate] || activeOldDates[customDate]){
                addOrRemoveDate(customDate);
            }

            systemNextDateMounth.setDate(systemNextDateMounth.getDate() + 1);
        }

        $("#cmp-calendar-main").datepicker("refresh");

        let cmpCalendarPanelPopup = cmpCalendarResetMounth.closest('.cmp-calendar__panel-popup');
        cmpCalendarPanelPopupDisplay = cmpCalendarPanelPopup.css('display');

        if(cmpCalendarPanelPopupDisplay == "flex"){
            cmpCalendarPanelPopup.css({"display" : "none"});
            $('.cmp-calendar').css('z-index', '');
            $('html, body').css('overflow', 'visible');
        }
    });
    //#####-----#####


    //#####Фун-я вывода итогов#####
    function outputResults(results){
        $('.cmp-loader').removeClass('cmp-loader_active');
        
        let resultsBlock = $('#results');
        resultsBlock.addClass('cmp-popup_active');
        $('html, body').css('overflow', 'hidden');

        //Блок со стилями
        let resultsBlockStyle = $('style');
        resultsBlockStyle.empty();

        //Сами svg иконки
        let cmpSegencirclesSvg = resultsBlock.find('.cmp-segencircle').find('svg');
        let cmpSegencirclesSvgCount = cmpSegencirclesSvg.length;

        //Индексы
        let svgIndex = 0;
        let percentSum = 0;

        //Перебор результатов
        for (dateKey in results) { 
            percentSum = 0;

            //Поиск кругов
            let circlesSvg = $(cmpSegencirclesSvg[cmpSegencirclesSvgCount - (svgIndex+1)]).find('.severity');
            let circlesSvgCount = circlesSvg.length;
            circlesSvg.css({'opacity' : 0});


            //Перебор настроений
            for (severity in results[dateKey]["severity"]) {  
                //Поиск круга
                let circleSvg = $(circlesSvg[circlesSvgCount - (severity)]);
                circleSvg.css({'opacity' : 1});

                //Вычисление значений стилей
                let percent = results[dateKey]["severity"][severity]["percent"];
                let strokeDasharray = (1000*percent-15) + ' 1000';
                let rotateCircle = 360*(percentSum)-90;

                //Применение стилей
                circleSvg.css({'transform' : 'rotate( ' + rotateCircle + 'deg)'});

                //Генерация имен стилей
                let animateNameKeyframes = 'severity-keyframes-' + dateKey + severity;
                let animateNameClass = 'severity-class-' + dateKey + severity;

                //Генерация селекторов
                let animateClass =  '.' + animateNameClass + ' {animation: ' + animateNameKeyframes + ' 1s linear forwards;}';
                let animateKeyframe = '@keyframes ' +  animateNameKeyframes + ' {0% {stroke-dasharray: 0 1000;}100% {stroke-dasharray: ' + strokeDasharray + ';}}';

                //Вставка в блок style
                resultsBlockStyle.append(animateKeyframe);
                resultsBlockStyle.append(animateClass);

                //Вставка класса элементу
                circleSvg.addClass(animateNameClass);

                //Выисление полного процента
                percentSum += percent;
            }
            svgIndex++;
        }
    }
    //#####-----#####



    //#####Запрос на получение уже заполненных дат#####
    function requestOldDates() {
        let relationMoodsAndClasses = new Object();
        let cmpCalendarPanelItems = $('.cmp-calendar__panel-item');

        let dataMoodname;
        let dataPrefixClass;

        cmpCalendarPanelItems.each(function( index,element) {
            let cmpCalendarPanelItem = $(element);
            dataMoodname = cmpCalendarPanelItem.attr('data-moodname');
            dataPrefixClass = cmpCalendarPanelItem.attr('data-prefixclass');

            relationMoodsAndClasses[dataMoodname] = 'ui-td-active_' + dataPrefixClass;
        });

        let requestData = {
            'request' : 'oldDates'
        }

        let json = JSON.stringify(requestData);
        let request = new XMLHttpRequest();

        request.open("POST", "/konkurs/includes/show_calendar.php", true);
        request.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        request.send(json);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200){
                let result = JSON.parse(this.response)["result"];

                if(result != "unregistered" && result != "error"){
                    result.forEach((element) => {
                        let tempDateMs = Date.parse(element["date"]);
                        let tempDateObj = new Date(tempDateMs);
                        let tempDate = String(padNumber(tempDateObj.getDate())) + '.' + String(padNumber(tempDateObj.getMonth() + 1)) + '.' + String(tempDateObj.getFullYear());

                        activeOldDates[tempDate] = {
                            "display" : true,
                            "class" : relationMoodsAndClasses[element["mood"]]
                        }
                    });
                }

                $("#cmp-calendar-main").datepicker("refresh");
            }
        }
    }
    requestOldDates();
    //#####-----#####
    //!#-#-----#-#
});