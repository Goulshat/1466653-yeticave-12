<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$config = require "config.php";

if (!file_exists("config.php")) {
    $msg = "Создайте файл config.php на основе config-template.php и внесите туда настройки сервера MySQL";
    trigger_error($msg,E_USER_ERROR);
}

date_default_timezone_set($config["default_timezone"]);

$db =  new mysqli($config["db"]["host"], $config["db"]["username"], $config["db"]["password"], $config["db"]["dbname"], $config["db"]["port"]);
$db->set_charset($config["db"]["charset"]);

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");
//User shop settings
$is_auth = rand(0, 1);
$user_name = "Гульшат";
//Yeticave shop settings
$bid_step_min = "50";
$bid_step_max = "10000";
$categories = getProductCategories($db);
