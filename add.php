<?php
require_once("init.php");
$page_name = "Добавить новый лот";

?>
<!-- <pre>
<?= var_dump($_POST); ?>
<?= var_dump($_FILES); ?>
</pre> -->
<?php
$errors = [];

if($_POST) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    };

    if(empty($_POST["lot-name"])) {
        $errors[] = "lot-name-empty";
    }

    if(empty($_POST["description"])) {
        $errors[] = "description-empty";
    }

    if(empty($_POST["start-price"])) {
        $errors[] = "start-price-empty";
    } else {
        $_POST["start-price"] = filter_var($_POST["start-price"], FILTER_VALIDATE_FLOAT);

        if($_POST["start-price"] <= 0) {
            $errors[] = "start-price-unvalid";
        }
    }

    if(empty($_POST["bid-step"])) {
        $errors[] = "bid-step-empty";
    } else  {
        $_POST["bid-step"] = intval($_POST["bid-step"]);

        if($_POST["bid-step"] <= $bid_step_min || $_POST["bid-step"] >= $bid_step_max) {
            $errors[] = "bid-step-range-error";
        };
    }

    if(empty($_POST["category"])) {
        $errors[] = "category-empty";
    }

    if(empty($_POST["date-expire"]) || !strtotime($_POST["date-expire"])) {
        $errors[] = "date-expire-empty";
    } else {
        $date_format = preg_match("/20[0-9][0-9]\-(0[1-9]|1[012])\-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $_POST["date-expire"]);
        if(!$date_format) {
            $errors[] = "date-format-error";
        } else {
            $time_left = strtotime($_POST["date-expire"]) - time();
            if($time_left < 86000) {
                $errors[] = "date-expire-error";
            }
        }
    }

    if(empty($_FILES["lot-img"]["name"])) {
        $errors[] = "lot-img-empty";
    } else {
        $new_img = $_FILES["lot-img"];
        $img_extns = pathinfo($new_img["name"], PATHINFO_EXTENSION);

        if ($img_extns === "jpeg" || $img_extns === "jpg" || $img_extns === "png" || $img_extns === "webp") {
            $_POST["url"] = "/uploads/img/lots/" . $new_img["name"];
            move_uploaded_file(($_FILES["lot-img"]["tmp_name"]), __DIR__ . $_POST["url"]);
        } else {
            $errors[] = "lot-photo-type";
        };
    };

    if(count($errors) === 0) {
        $new_lot_id = insertNewProduct($_POST["lot-name"], $_POST["description"], $_POST["url"], $_POST["date-expire"], $_POST["start-price"], $_POST["bid-step"], $_POST["category"], 1, $db);
        header('Location: /lot.php?id=' . $new_lot_id);
        exit();
    }
};

$content = include_template("add-lot.php", [
    "categories" => $categories,
    "bid_step_min" => $bid_step_min,
    "bid_step_max" => $bid_step_max,
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
