<?php
require_once("settings.php");
require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$page_name = "Главная";
$products = getActiveProducts($db);

$content = include_template("main.php", [
    "categories" => $categories,
    "products" => $products
]);
$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content
]);

echo $layout_content;
