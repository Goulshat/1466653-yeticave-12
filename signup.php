<?php
require_once("init.php");
$page_name = "Регистрация нового аккаунта";
$errors = [];

    if($_POST) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    };
    // Email
    switch(true) {
        case empty($_POST["email"]):
        $errors["email"] = "Введите ваш e-mail";
        break;

        case ($_POST["email"] !== filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) :
        $errors["email"] = "Введите корректный e-mail";
        break;

        case (getUserId($_POST["email"], $db)) :
        $errors["email"] = "Пользователь с таким e-mail уже существует";
        break;
    }
    // Пароль
    switch($_POST["password"]) {
        case false:
        $errors["password"] = "Введите пароль";
        break;

        case (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,24})/", $_POST["password"])) :
        $errors["password"] = "Пароль должен состоять из 8-24 символов: хотя бы одна цифра, латинские заглавные и строчные буквы";
        break;

        default :
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }
        //$password_pattern = "/((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,16})/";
        //?спецсимволы (?=.*[\!\.,&;:@#%\(\)\[\]\{\}])

    if(empty($_POST["name"]) || is_numeric($_POST["name"])) {
        $errors["name"] = "Введите ваше имя";
    }

    if(empty($_POST["message"])) {
        $errors["message"] = "Напишите как с вами можно связаться";
    }

    if(count($errors) === 0) {
        $new_user_id = insertNewUser($_POST["email"], $hash, $_POST["name"], $_POST["message"], $db);
        $is_auth = true;
        $_SESSION['id'] = session_id();
        $_SESSION['user_id'] = $new_user_id;
        $_SESSION['user_name'] = $_POST["name"];
        $_COOKIE['user_id'] = $new_user_id;
        $_COOKIE['user_name'] = $_POST["name"];
        $_COOKIE['user_password'] = $hash;
        header('Location: /index.php');
        exit();
    }
};

$content = include_template("signup.php", [
    "categories" => $categories,
    "page_name" => $page_name,
    "errors" => $errors,
    "user" => $_POST,
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content,
]);

echo $layout_content;
