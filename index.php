<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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
$lot = $result->fetch_assoc(); // получаем строку или массив или перебираем по одной, как показано выше

$is_auth = rand(0, 1);
$user_name = "Гульшат";

$content = include_template("main.php", ["categories" => $categories, "products" => $products]);
$layout_content = include_template("layout.php", [$page_name => "Главная", "content" => $content]);

echo $layout_content;
