<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");

$is_auth = rand(0, 1);
$user_name = "Гульшат";

if (isset($_GET["id"])) {
    $product_id = html_sc($_GET["id"]);
    $product = getProductData($product_id, $db);

    if ($product) {
        $product_bids = getProductBids($product_id, $db);
        $page_name = $product["name"];
        $content = include_template("lot-layout.php", ["categories" => $categories, "product" => $product, "product_bids" => $product_bids]);
        $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);

        echo $layout_content;
        exit();
    }

    http_response_code(404);
    showNotFoundPage($categories, $is_auth, $user_name);
    echo $layout_content;
    exit();
}

http_response_code(404);
showNotFoundPage($categories, $is_auth, $user_name);
echo $layout_content;
