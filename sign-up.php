<?php
require_once("init.php");
$page_name = "Регистрация нового аккаунта";
$errors = [];

if($_POST) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = trim($value);
  };
// Валидация email
  switch(true) {
    case !isset($_POST["email"]):
      $errors["email"] = "Введите ваш e-mail";
      break;

    case ($_POST["email"] !== filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) :
      $errors["email"] = "Введите корректный e-mail";
      break;

    case (getUserId($_POST["email"], $db)) :
      $errors["email"] = "Пользователь с таким e-mail уже существует";
      break;
  }
// Валидация пароля
  switch(true) {
    case !isset($_POST["password"]):
      $errors["password"] = "Введите пароль";
      break;

    case (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16})/", $_POST["password"])) :
      $errors["password"] = "Введите корректный e-mail";
      break;

    default :
      $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
  }

  /*
  if(empty($_POST["email"])) {
    $errors["email"] = "Введите ваш e-mail";
  } else if ($_POST["email"] !== filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Введите корректный e-mail";
  } else {
    if (getUserId($_POST["email"], $db)) {
    $errors["email"] = "Пользователь с таким e-mail уже существует";
    }
  };

  if(empty($_POST["password"])) {
    $errors["password"] = "Введите пароль";
  } else {
    $password_pattern = "/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16})/";
    // (?=.*[\!\.,&;:@#%\(\)\[\]\{\}])
    if (!preg_match($password_pattern, $_POST["password"])) {
        $errors["password"] = "Пароль должен состоять из 8-16 символов: хотя бы одна цифра, латинские заглавные и строчные буквы";
    } else {
      $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    };
  }*/

  if(empty($_POST["name"])) {
    $errors["name"] = "Введите имя";
  }

  if(empty($_POST["message"])) {
    $errors["message"] = "Напишите как с вами связаться";
  }

  if(count($errors) === 0) {
    $new_user_id = insertNewUser($_POST["email"], $hash, $_POST["name"], $_POST["message"], $db);
    header('Location: /index.php?id=' . $new_user_id);
    exit();
  }
};

$content = include_template("signup.php", [
  "categories" => $categories,
  "user" => $_POST,
  "page_name" => $page_name,
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
