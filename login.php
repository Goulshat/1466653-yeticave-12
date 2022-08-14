<?php
$page_name = "Вход";
$errors = [];
require_once("init.php");

if($_POST) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    };

    if(empty($_POST["email"])) {
        $errors["login"] = "Введите ваш e-mail";
    } else if($_POST["email"] !== filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Введите корректный e-mail";
    } else {
        $user["id"] = getUserId($_POST["email"], $db);

        if (!$user_id) {
            $errors["new-user"] = $errors["email"] = "Пользователь с таким e-mail не зарегистрирован";
        } else {
            $user["name"] = getUserName($user["id"], $db);

            if (empty($user["name"])) {
                $user["name"] = "Йети Неопознанный";
            }
        }
    }

    if(empty($_POST["password"])) {
        $errors["password"] = "Введите ваш пароль";
    }

    if($user["id"] && isset($_POST["password"])) {
        $user["hash"] = getPasswordHash($user_id, $db);
        password_verify($_POST["password"], $user["hash"]);
    } else {
        $errors["password"] = "Пароль неверный";
    }

    if(count($errors) === 0) {
        $is_auth = true;
        $_SESSION['id'] = session_id();
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['user_name'] = $user["name"];
        $_COOKIE['user_id'] = $user["id"];
        $_COOKIE['user_name'] = $user["name"];
        $_COOKIE['user_password'] = $user["hash"];

        // header('Location: /index.php?id=' . $user["id"]);
        // header('Location: /index.php');
        // exit();
    }
};

$content = include_template("login.php", [
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
