<?php
/*
$categories = [
  "boards" => "Доски и лыжи",
  "bindings" => "Крепления",
  "boots" => "Ботинки",
  "cloths" => "Одежда",
  "tools" => "Инструменты",
  "miscellaneous" => "Разное"
];

$products = [
  0 => [
    "name" => "2014 Rossignol District Snowboard",
    "category" => "boards",
    "price" => "10999",
    "url" => "img/lot-1.jpg",
    "expireDate" => "21.11.2021",
  ],
  1 => [
    "name" => "DC Ply Mens 2016/2017 Snowboard",
    "category" => "boards",
    "price" => "159999",
    "url" => "img/lot-2.jpg",
    "expireDate" => "17.11.2021",
  ],
  2 => [
    "name" => "Крепления Union Contact Pro 2015 года размер L/XL",
    "category" => "bindings",
    "price" => "8000",
    "url" => "img/lot-3.jpg",
    "expireDate" => "16.11.2021",
  ],
  3 => [
    "name" => "Ботинки для сноуборда DC Mutiny Charocal",
    "category" => "boots",
    "price" => "10999",
    "url" => "img/lot-4.jpg",
    "expireDate" => "15.11.2021",
  ],
  4 => [
    "name" => "Куртка для сноуборда DC Mutiny Charocal",
    "category" => "cloths",
    "price" => "7500",
    "url" => "img/lot-5.jpg",
    "expireDate" => "20.11.2021",
  ],
  5 => [
    "name" => "Маска Oakley Canopy",
    "category" => "miscellaneous",
    "price" => "5400",
    "url" => "img/lot-6.jpg",
    "expireDate" => "17.11.2021",
  ],
];
*/

require_once("course_library.php");
require_once("my_functions.php");

if (!file_exists("config.php")) {
  $msg = "Создайте файл config.php на основе config-template.php и внесите туда настройки сервера MySQL";
  trigger_error($msg,E_USER_ERROR);
}

$config = require "config.php";

$db_host = $config["db"]["host"];
$db_username = $config["db"]["username"];
$db_password = $config["db"]["password"];
$db_dbname = $config["db"]["dbname"];
$db_port = $config["db"]["port"];
$db_charset = $config["db"]["charset"];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db =  new mysqli($db_host, $db_username, $db_password,$db_dbname, $db_port); // соединение с сервером

if ($db->connect_errno) {
  //echo "Connect failed: %s\n" . $db->connect_error;
  $errorMsg = 'Не удалось установить соединение: ' . $db->connect_error;
  die($errorMsg);
}

$db->set_charset($db_charset); // кодировка

/* --- Запрос категорий --- */
$sql_categories = "
SELECT * FROM ?;";

$sql_var = "category"; // Переменные
db_get_prepare_stmt($db, $sql_categories, $sql_var); // Подготовка запроса
$result = $stmt->get_result(); // Получаем результат..
$categories = $result->fetch_all(MYSQLI_ASSOC); // ..двумерный массив

/* --- Запрос лотов --- */
$sql_lots = "
SELECT lots.name, lots.price, lots.img AS ?,
category.name AS ?,
IFNULL(MAX(bid.amount), lots.price) AS ?,
lots.date_register
FROM lots
JOIN category ON lots.category_id=category.id
LEFT OUTER JOIN bid ON lots.id=bid.lot_id
WHERE winner_user_id IS NULL
GROUP BY lots.name, lots.price, lots.img, category.name, lots.date_register
ORDER BY lots.date_register DESC;";

$sql_var = ["link", "category", "price"]; // Переменные
db_get_prepare_stmt($db, $sql_categories, $sql_var); // Подготовка запроса
$result = $stmt->get_result(); // Получаем результат..
$products = []; // инициализировать пустой массив перед циклом
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
