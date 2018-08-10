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