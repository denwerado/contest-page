<?php
    //#####Скрипт соединения с бд#####
    /*$dbhost = 'localhost';
    $dbname = 'tenoten-vz';
    $dblogin = 'root';
    $dbpassword = 'root';*/
    use PDO;

    $connect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dblogin, $dbpassword);
    $connect -> exec("set names utf8");

    $tableLogin = 'tenoten_logins';
    $tableCalendar = "tenoten_calendar";
    $tableMoods = "tenoten_moods";
    //#####-----#####

?>