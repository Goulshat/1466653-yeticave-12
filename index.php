<?php
require_once("functions.php");
require_once("helpers.php");
require_once("data.php");

$product_item = include_template("products.php", ["products" => $products]);
$content = include_template("main.php", ["categories" => $categories, "product_item" => $product_item]);
$layout_content = include_template("layout.php", [$page_name => "Главная", "content" => $content]);

print($layout_content);
?>
