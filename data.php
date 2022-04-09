<?php
mb_internal_encoding("UTF-8");
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

$db =  new mysqli($db_host, $db_username, $db_password,$db_dbname, $db_port);
$db->set_charset($db_charset);

$sql = "
SELECT * FROM `category`;";
$result = $db->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);

$sql = "
SELECT lots.name, lots.price, lots.img AS `url`,
category.name AS `category`, lots.date_expire AS `date_expire`,
IFNULL(MAX(bid.amount), lots.price) AS `price`,
lots.date_register
FROM lots
JOIN category ON lots.category_id=category.id
LEFT OUTER JOIN bid ON lots.id=bid.lot_id
WHERE winner_user_id IS NULL
GROUP BY lots.name, lots.price, lots.img, category.name, lots.date_register, lots.date_expire
ORDER BY lots.date_register DESC;
";
$result = $db->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);
