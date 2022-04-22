<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$is_auth = rand(0, 1);
$user_name = "Гульшат";

$page_name = "Добавить новый лот";
$bid_step_min = "50";
$bid_step_max = "10000";

?>
<pre>
<?= var_dump($_POST); ?>
<?= var_dump($_FILES); ?>
</pre>
<?php
$errors = [];

if($_POST) {
    $_POST["lot-name"] = trim($_POST["lot-name"]);
    $_POST["description"] = trim($_POST["description"]);
    $_POST["start-price"] = trim($_POST["start-price"]);
    $_POST["bid-step"] = trim($_POST["bid-step"]);
    $_POST["date-expire"] = trim($_POST["date-expire"]);
    // цикл
    ?>
    <pre> Прогон через trim():
    <?= var_dump($_POST); ?>
    </pre>
    <?php
    // $_POST["lot-name"] = filter_var($_POST["lot-name"], FILTER_SANITIZE_SPECIAL_CHARS);
    // $_POST["description"] = filter_var($_POST["description"], FILTER_SANITIZE_SPECIAL_CHARS);
    // $_POST["start-price"] = filter_var($_POST["start-price"], FILTER_SANITIZE_SPECIAL_CHARS);
    // $_POST["bid-step"] = filter_var($_POST["bid-step"], FILTER_SANITIZE_SPECIAL_CHARS);
    // $_POST["date-expire"] = filter_var($_POST["date-expire"], FILTER_SANITIZE_SPECIAL_CHARS);

    ?>
    <!-- <pre>Прогон через FILTER_SANITIZE_SPECIAL_CHARS: - не сработал
    <?= var_dump($_POST); ?>
    </pre> -->
    <?php
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

        if($_POST["start-price"] < 0) {
            $errors[] = "start-price-unvalid";
        }
    }

    if(empty($_POST["bid-step"])) {
        $errors[] = "bid-step-empty";
    } else {
        $_POST["bid-step"] = filter_var($_POST["bid-step"], FILTER_VALIDATE_INT, [
            "default" => 0,
            "min-range" => $bid_step_min,
            "max-range" => $bid_step_max,
        ]); // не работает

        if(!$_POST["bid-step"]) {
            $errors[] = "bid-step-range-error";
        }
    }

    if(empty($_POST["category"])) {
        $errors[] = "category-empty";
    }

    if(empty($_POST["date-expire"])) {
        $errors[] = "date-expire-empty";
    } else {
        $time_left = strtotime($_POST["date-expire"]) - time();
        if($time_left < 86000) {
            $errors[] = "date-expire-error";
        } else {
            $date_format = preg_match("/20[0-9][0-9]\-(0[1-9]|1[012])\-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $_POST["date-expire"]);

            if(!$date_format) {
                $errors[] = "date-format-error";
            }
        }
    }

    if(!isset($_FILES["lot-img"]["name"])) {
        $errors[] = "lot-img-empty";
    } else {
        $new_img = $_FILES["lot-img"];
        $img_extns = pathinfo($new_img["name"], PATHINFO_EXTENSION);

        if ($img_extns === "jpeg" || $img_extns === "jpg" || $img_extns === "png" || $img_extns === "webp") {
            $_POST["url"] = __DIR__ . "/uploads/img/lots/" . $new_img["name"];
            move_uploaded_file($_FILES["lot-img"]["tmp_name"], $_POST["url"]);
        } else {
            $errors[] = "lot-photo-type";
        };
    };

    if(count($errors) === 0) {
        insertNewProduct($_POST["lot-name"], $_POST["description"], $_POST["url"], $_POST["date-expire"], $_POST["start-price"], $_POST["bid-step"], $_POST["category"], 1, $db);

        $new_lot_id = $db->insert_id;

        header('Location: /lot.php?id=' . $new_lot_id);
        exit();
    }
};

$content = include_template("add-lot.php", [
    "categories" => $categories,
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
