<?php
require_once("init.php");
$page_name = "Добавить новый лот";
$errors = [];

if($_POST) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    };

    if(empty($_POST["lot-name"])) {
        $errors["lot-name-empty"] = "Введите название лота";
    }

    if(empty($_POST["description"])) {
        $errors["description-empty"] = "Опишите ваш лот";
    }

    if(empty($_POST["start-price"])) {
        $errors["start-price-empty"] = "Введите начальную цену лота";
    } else {
        $_POST["start-price"] = filter_var($_POST["start-price"], FILTER_VALIDATE_FLOAT);

        if($_POST["start-price"] <= 0) {
            $errors["start-price-unvalid"] = "Начальная цена не может быть отрицательной";
        }
    }

    if(empty($_POST["bid-step"])) {
        $errors["bid-step-empty"] = "Введите минимальный шаг ставки";
    } else  {
        $_POST["bid-step"] = intval($_POST["bid-step"]);

        if($_POST["bid-step"] <= $bid_step_min || $_POST["bid-step"] >= $bid_step_max) {
            $errors["bid-step-range-error"] = "Введите шаг ставки - от " . $bid_step_min . " до " . $bid_step_max . " руб.";
        };
    }

    if(empty($_POST["category"])) {
        $errors["category-empty"] = "Выберете категорию";
    }

    switch($_POST["date-expire"]) {
        case !isset($_POST["date-expire"]):
            $errors["date-expire-empty"] = "Введите дату завершения торгов в формате ГГГГ-ММ-ДД";
            break;

        case !strtotime($_POST["date-expire"]):
            $errors["date-expire-empty"] = "Введите дату завершения торгов в формате ГГГГ-ММ-ДД";
            break;

        case ((strtotime($_POST["date-expire"]) - time()) < 86000) :
            $errors["date-expire-error"] = "До окончания торгов должно оставаться не менее суток";
            break;

        case preg_match("/20[0-9][0-9]\-(0[1-9]|1[012])\-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $_POST["date-expire"]) === false :
            $errors["date-format-error"] = "Поправьте формат даты на ГГГГ-ММ-ДД";
            break;
    }

    if(empty($_FILES["lot-img"]["name"])) {
        $errors["lot-img-empty"] = "Добавьте изображение лота в формате *.jpeg, *.jpg, *.png или *.webp";
    } else {
        $new_img = $_FILES["lot-img"];
        $img_extns = pathinfo($new_img["name"], PATHINFO_EXTENSION);

        if ($img_extns === "jpeg" || $img_extns === "jpg" || $img_extns === "png" || $img_extns === "webp") {
            $new_img_url = "/uploads/img/lots/" . $new_img["name"];
            move_uploaded_file($_FILES["lot-img"]["tmp_name"], __DIR__ . $new_img_url);
        } else {
            $errors["lot-photo-type"] = "Допустимый формат изображения: jpeg, jpg, png или webp";
        };
    };

    if(count($errors) === 0) {
        $new_lot_id = insertNewProduct($_POST["lot-name"], $_POST["description"], $new_img_url, $_POST["date-expire"], $_POST["start-price"], $_POST["bid-step"], $_POST["category"], 1, $db);
        header('Location: /lot.php?id=' . $new_lot_id);
        exit();
    }
};

$content = include_template("add-lot.php", [
    "categories" => $categories,
    "bid_step_min" => $bid_step_min,
    "bid_step_max" => $bid_step_max,
    "errors" => $errors,
    "new_lot" => $_POST,
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content,
]);

echo $layout_content;
