<?php
$page_name = "Вход";
$errors = [];
// $user_id = false;
// $user_name = false; - в init.php

if($_SESSION["id"] && $_SESSION["user_name"]) {
    $is_auth = true;
    $user_name = $_SESSION["user_name"];
    //redirect to last page
}

else {
    $is_auth = false;
    $user_name = false;

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

            if (!$user_id === false) {
                $errors["new-user"] = $errors["email"] = "Пользователь с таким e-mail не зарегистрирован";
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
            $_SESSION['auth'] = true;
            header('Location: /index.php?id=' . $_SESSION["user"]["id"]);
            exit();
        }
    };
}

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
