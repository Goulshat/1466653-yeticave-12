<?php
require_once("settings.php");
require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");


if (!isset($_GET["id"]) ) {
    showNotFoundPage($categories, $is_auth, $user_name);
}

$product_id = $_GET["id"];
$product = getProductData($product_id, $db);

if (!$product) {
    showNotFoundPage($categories, $is_auth, $user_name);
}

$product_bids = getProductBids($product_id, $db);
$page_name = $product["name"];
$content = include_template("single-lot.php", ["categories" => $categories, "product" => $product, "product_bids" => $product_bids]);
$layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);

echo $layout_content;
