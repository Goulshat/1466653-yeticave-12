<?php
require_once("init.php");
$page_name = "Вход";
$errors = [];

if($_POST) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    };

    if(empty($_POST["email"])) {
        $errors["login"] = "Введите ваш e-mail";
    }

    if(empty($_POST["password"])) {
        $errors["password"] = "Опишите ваш лот";
    }

    if(count($errors) === 0) {
        $new_lot_id = insertNewProduct($_POST["lot-name"], $_POST["description"], $new_img_url, $_POST["date-expire"], $_POST["start-price"], $_POST["bid-step"], $_POST["category"], 1, $db);
        header('Location: /lot.php?id=' . $new_lot_id);
        exit();
    }
};

$content = include_template("log-in.php", [
    "categories" => $categories,
    "page_name" => $page_name,
    "user" => $_POST,
    "errors" => $errors,
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content,
]);

echo $layout_content;
