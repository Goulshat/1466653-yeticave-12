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
];*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = require "config.php";
require_once("my_functions.php");

if (!file_exists("config.php")) {
    $msg = "Создайте файл config.php на основе config-template.php и внесите туда настройки сервера MySQL";
    trigger_error($msg,E_USER_ERROR);
}

$db_host = $config["db"]["host"];
$db_username = $config["db"]["username"];
$db_password = $config["db"]["password"];
$db_dbname = $config["db"]["dbname"];
$db_port = $config["db"]["port"];
$db_charset = $config["db"]["charset"];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//до этой строки код выполняется, а дальше ошибки и ошибки не выводит

$db =  new mysqli($db_host, $db_username, $db_password,$db_dbname, $db_port); // соединение с сервером

if ($db->connect_errno) {
    //echo "Connect failed: %s\n" . $db->connect_error;
    $errorMsg = 'Не удалось установить соединение: ' . $db->connect_error;
    die($errorMsg);
}

$db->set_charset($db_charset); // кодировка

// Запрос категорий - без использования функции, переменных нет
$sql = "
SELECT * FROM `category`;";
$result = $db->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC); // ..двумерный массив

// Запрос категорий - без использования функции
$sql = "
SELECT lots.name, lots.price, lots.img AS `link`,
category.name AS `category`,
IFNULL(MAX(bid.amount), lots.price) AS `current price`,
lots.date_register
FROM lots
JOIN category ON lots.category_id=category.id
LEFT OUTER JOIN bid ON lots.id=bid.lot_id
WHERE winner_user_id IS NULL
GROUP BY lots.name, lots.price, lots.img, category.name, lots.date_register
ORDER BY lots.date_register DESC;
";
$result = $db->query($sql);
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row; // разница в написании $products = $row; ?? добавляет новое значение в конец массива
}

$sql = "
SELECT amount, date_register
FROM bid WHERE lot_id=? ORDER BY date_register DESC;";
$sql_var = 3;

$stmt = $db->prepare($sql); // Подготовка запроса
$stmt->bind_param("i", $sql_var); // Связываю с переменными
$stmt->execute(); // Выполняю запрос
$result = $stmt->get_result();

$products = []; // инициализировать пустой массив перед циклом
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

/*$sql = "
SELECT amount, date_register
FROM bid WHERE lot_id=3 ORDER BY date_register DESC;";
//db_get_prepare_stmt($db, $sql_categories, $sql_var); // Подготовка запроса
/*



// Запрос лотов - с использованием функции
$sql_lots = "
SELECT lots.name, lots.price, lots.img AS `link`,
category.name AS `category`,
IFNULL(MAX(bid.amount), lots.price) AS `current price`,
lots.date_register
FROM lots
JOIN category ON lots.category_id=category.id // category.id
LEFT OUTER JOIN bid ON lots.id=bid.lot_id //bid.lot_id
WHERE winner_user_id IS NULL
GROUP BY lots.name, lots.price, lots.img, category.name, lots.date_register
ORDER BY lots.date_register DESC;
";

$sql_var = ["link", "category", "price"]; // Переменные
db_get_prepare_stmt($db, $sql_categories, $sql_var); // Подготовка запроса
$result = $stmt->get_result(); // Получаем результат..
$products = []; // инициализировать пустой массив перед циклом
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
*/
