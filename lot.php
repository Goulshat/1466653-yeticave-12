<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$is_auth = rand(0, 1);
$user_name = "Гульшат";
$page_name = $products[$_GET["id"]]["name"]; // вставить название

$content = include_template("lot-layout.php", ["page_name" => $page_name, "categories" => $categories, "products" => $products, "bids" => $bids]);

$layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);

echo $content;
