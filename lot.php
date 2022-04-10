<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$is_auth = rand(0, 1);
$user_name = "Гульшат";

if (isset($_GET["id"])) {
    $product_id = html_sc($_GET["id"]);
    $product_data = getProductData($product_id, $db);

    if ($product_data) {
        $product_bids = getProductBids($product_id, $db);
        $page_name = $product_data[0]["name"];
        $content = include_template("lot-layout.php", ["categories" => $categories, "product" => $product_data, "product_bids" => $product_bids]);
        $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);

        echo $layout_content;
    }

    http_response_code(404);
    $page_name = "404 Страница не найдена";
    $content = include_template("404.php", ["categories" => $categories]);
    $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);
    echo $layout_content;

} else {
    http_response_code(404);
    $page_name = "404 Страница не найдена";
    $content = include_template("404.php", ["categories" => $categories]);
    $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);
    echo $layout_content;
    // как избежать повторения дважды? первое условие проверяет что get-параметр пришел, а второе - id корректный и товар такой есть
}
