<?php
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
/*
if (!file_exists("config.php")) {
    $msg = "Создайте файл config.php на основе config.sample.php и внесите туда настройки сервера MySQL";
    trigger_error($msg,E_USER_ERROR);
}

$config = require "config.php";
$db = new mysqli($config["db"]["host"], $config["db"]["username"], $config["db"]["password"], $config["db"]["dbname"], $config["db"]["port"]);

$db->set_charset(["db"]["charset"]);

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
ORDER BY lots.date_register DESC;"; // заменяем на знаки вопроса
$stmt = $db->prepare($sql); // подготавливаем запрос, получаем stmt
$stmt->bind_param("ss", $email, $hash); // два знака вопроса - две переменных - две буквы s
$stmt->execute(); // выполняем запрос
$result = $stmt->get_result(); // получаем result
$lot = $result->fetch_assoc(); // получаем строку или массив или перебираем по одной, как показано выше*/
