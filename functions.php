<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 06.08.2018
 * Time: 12:06
 */
//Функция предназначена для удобства отладки приложения.
//Подключена данная функция в файле frontend/web/index.php
//Подключение: require_once __DIR__ . '/../../functions.php'
function debug($arr){
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function logfile($textLog){
    $file = __DIR__ .'/logFile.txt';
    $text = "\n". date('Y-m-d H:i:s') ." -> ";      //Добавляем актуальную дату
    $text .= $textLog;                          //Выводим переданную переменную
    $fOpen = fopen($file,'a+');
    fwrite($fOpen, $text);
    fclose($fOpen);
}

function logfileArrayJson($textLog){
    $file = __DIR__ .'/logFile.txt';
    $text = "\n". date('Y-m-d H:i:s') ." -> ";      //Добавляем актуальную дату
    $text .= json_encode($textLog);                          //Выводим переданную переменную
    $fOpen = fopen($file,'a+');
    fwrite($fOpen, $text);
    fclose($fOpen);
}

function logfileArraySerrial($textLog){
    $file = __DIR__ .'/logFile.txt';
    $text = "\n". date('Y-m-d H:i:s') ." -> ";      //Добавляем актуальную дату
    $text .= serialize($textLog);                          //Выводим переданную переменную
    $fOpen = fopen($file,'a+');
    fwrite($fOpen, $text);
    fclose($fOpen);
}