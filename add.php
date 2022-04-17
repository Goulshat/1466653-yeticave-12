<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");


$is_auth = rand(0, 1);
$user_name = "Гульшат";

$page_name = "Добавить новый лот";

?>
<pre>
<?= var_dump($_POST); ?>
<?= var_dump($_FILES); ?>
</pre>
<?php

if($_POST) {
    $required_fields = ["lot-name", "description", "date-expire", "start-price", "bid-step", "category"];
    //проверка на пустые поля
    $empty_fields = validateIsFilled($required_fields);
    ?>
    <pre>
    Первая проверка на пустые поля:
    <?= print_r($empty_fields); ?>
    </pre>
    <?php

    //вторая проверка на корректность
    $errors = validateAddLotForm($_POST, $categories);
    ?>
    <pre>
    Вторая проверка на корректность введенных данных:
    <?= var_dump($errors); ?>
    </pre>
    <?php

    if(!$_FILES["lot-img"]["name"]) {
        $empty_fields[] = "lot-img";
    } else {
        $new_img = $_FILES["lot-img"];
        $img_extns = pathinfo($new_img["name"], PATHINFO_EXTENSION);

        if ($img_extns === "jpeg" || $img_extns === "jpg" || $img_extns === "png" || $img_extns === "webp") {
            $_POST["url"] = "/uploads/img/lots/" . $new_img["name"]; //проверка на уникальность?
            move_uploaded_file($new_img["tmp_name"], $_POST["url"]);
        } else {
            $errors[] = "lot-photo-type";
        };
    };

    if($empty_fields || $errors) {
        $content = include_template("add-lot.php", [
            "categories" => $categories,
            "empty_fields" => $empty_fields,
            "errors" => $errors,
        ]);
    } else {
        $new_lot_to_db = [
            "name" => $_POST["lot-name"],
            "description" => $_POST["description"],
            "img" => $_POST["url"],
            "date_expire" => $_POST["date-expire"],
            "price" => $_POST["start-price"],
            "bid_step" => $_POST["bid-step"],
            "category_id" => $_POST["category"],
            "author_user_id" => 1, //$_POST["author_user_id"]
        ];

        $stmt = insertNewProduct($new_lot_to_db, $db);
        $respond = $stmt->execute();

        if(!$respond) {
            $errors[] = "no-db-respond";
        };

        $new_lot_id = $db->insert_id;

        header('Location: /lot.php?id=' . $new_lot_id);
    }
} else {
    $content = include_template("add-lot.php", ["categories" => $categories]);
};

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content]);
echo $layout_content;
