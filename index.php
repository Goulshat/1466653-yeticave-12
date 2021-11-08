<?php
require_once("helpers.php");
require_once("functions.php");
require_once("data.php");

$content = include_template("main.php", ["categories" => $categories, "products" => $products]);
$layout_content = include_template("layout.php", [$page_name => "Главная", "content" => $content]);

print($layout_content);
?>
