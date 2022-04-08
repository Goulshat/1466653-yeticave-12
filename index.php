<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$is_auth = rand(0, 1);
$user_name = "Гульшат";
$page_name = "Главная";

$content = include_template("main.php", ["categories" => $categories, "products" => $products]);
$layout_content = include_template("layout.php", ["categories" => $categories, "content" => $content]);

echo $layout_content;
?>
