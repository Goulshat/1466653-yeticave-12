<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$is_auth = rand(0, 1);
$user_name = "Гульшат";
$page_name = "Главная";

$active_products = getActiveProducts($db);

if ($active_products) {
    $content = include_template("main.php", ["categories" => $categories, "products" => $active_products]);
    $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "page_name" => $page_name, "categories" => $categories, "content" => $content]);

    echo $layout_content;
    exit();
};

$error_message = "Скоро здесь появятся лоты";
http_response_code(404);
showNotFoundPage($categories, $is_auth, $user_name, $error_message);
echo $layout_content;
