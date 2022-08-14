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
        $user_id = getUserId($_POST["email"], $db);

        if (!$user_id) {
            $errors["new-user"] = $errors["email"] = "Пользователь с таким e-mail не зарегистрирован";
        } else {
            $user_name = getUserName($user_id, $db);

            if (empty($user_name)) {
                $user_name = "Йети Неопознанный";
            }
        }
    }

    if(empty($_POST["password"])) {
        $errors["password"] = "Введите ваш пароль";
    }

    if($user_id && !empty($_POST["password"])) {
        $user_hash = getPasswordHash($user_id, $db);

        if(!password_verify($_POST["password"], $user_hash)) {
            $errors["password"] = "Пароль неверный";
        };
    }

    if(count($errors) === 0) {
        session_start();
        $is_auth = true;
        $_SESSION["session_id"] = session_id();
        $_SESSION["user"]["id"] = $user_id;
        $_SESSION["user"]["name"] = $user_name;

        if(empty($_COOKIE["user_id"])) {
            setcookie("user_id", $user_id);
        }

        if(empty($_COOKIE["user_name"])) {
            setcookie("user_name", $user_name);
        }

        if(empty($_COOKIE["user_password"])) {
            setcookie("user_password", $user_hash);
        }
        header("Location: /index.php");
        exit();
    }
};

$content = include_template("login.php", [
    "categories" => $categories,
    "page_name" => $page_name,
    "user" => $_POST,
    "errors" => $errors,
    "user_name" => $user_name,
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content,
]);

echo $layout_content;
