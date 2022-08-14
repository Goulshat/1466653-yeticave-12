<?php
require_once("init.php");
$page_name = "Выход";

$_SESSION = array();
session_start(); //надо ли заново начинать сессию?
$user_name = '';
$is_auth = false;

$content = include_template("logout.php", [
    "categories" => $categories,
    "page_name" => $page_name,
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content,
]);

echo $layout_content;
