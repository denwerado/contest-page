<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    /**
     * Подключение служебных файлов
     */
    //Подключение к бд
    require dirname(__FILE__) . '/includes/db_connect.php';

    //Проверка аунтефикации
    require dirname(__FILE__) . '/includes/check_auth.php';

    //Чтение информации по аккаунту
    require dirname(__FILE__) . '/includes/get_account_info.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <title><?php $APPLICATION->ShowTitle(); ?></title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />

    <?php 
        /*<link rel="stylesheet" href="/konkurs/assets/css/normalize.css">
        <link rel="stylesheet" href="/konkurs/assets/css/jquery-ui.css">
        <link rel="stylesheet" href="/konkurs/assets/css/style.css">*/

        //Подключение стилей
        $APPLICATION->SetAdditionalCSS("/konkurs/assets/css/normalize.css");
        $APPLICATION->SetAdditionalCSS("/konkurs/assets/css/jquery-ui.css");
        $APPLICATION->SetAdditionalCSS("/konkurs/assets/css/style.css");

        //Подключение скриптов
        $APPLICATION->AddHeadScript("/konkurs/assets/plugins/scripts/jquery.min.js");
        $APPLICATION->AddHeadScript("/konkurs/assets/plugins/scripts/jquery-ui.js");
        $APPLICATION->AddHeadScript("/konkurs/assets/scripts/main.js");
    ?>

    <style>
    </style>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(7855924, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
    });
    </script>
    <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-21802525-6"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-21802525-6');
    </script>
    
</head>
<body class="body">

    <!-- Yandex.Metrika counter -->
    <noscript><div><img src="https://mc.yandex.ru/watch/7855924" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <?php
        //Подключение svg иконок    
	    echo '<div style="display:none;">' . file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/konkurs/assets/images/_svg.svg') . '</div>';
	    $APPLICATION->ShowPanel();
	?>

    <div class="cmp-loader">
        <div class="cssload-thecube">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>    
    </div>

    <a name="up"></a>
    <header class="header">
        <div class="container">
            <div class="header__block">
                <a href="#up" class="link">
                    <img src="/konkurs/assets/images/logo.png" alt="" class="logo">
                </a>
                <ul class="ul header__menu">
                    <li>
                        <a href="/" class="link">Главная</a>
                    </li>
                    <li>
                        <a href="/tenoten/" class="link">О препарате</a>
                    </li>
                    <li>
                        <a href="/info/mechanizm/" class="link">Специалистам</a>
                    </li>
                    <li>
                        <?php if($checkAuthStatus){ ?>
                            <button class="button cmp-button cmp-button_green-reverse" data-modal="#main-test">Пройти тест</button>
                        <?php }else{ ?>
                            <button class="button cmp-button cmp-button_green-reverse" data-modal="#authentication">Пройти тест</button>
                        <?php } ?>
                    </li>
                    <li>
                        <a href="/konkurs/info/" class="link cmp-button cmp-button_orange-reverse">Хочу приз</a>
                    </li>
                    <li>
                        <div class="cmp-button cmp-button__authentication" data-modal="#authentication">
                            <svg class="svg"><use xlink:href="#avatar"></use></svg>
                            <span class="text">Войти</span>
                        </div>
                    </li>
                    <li>
                        <a href="/kak-priobresti/" class="link cmp-button cmp-button_green">Как приобрести</a>
                    </li>
                </ul>

                <div class="header__burger header__burger">
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </header>