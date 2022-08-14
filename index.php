<?php
require_once("init.php");

$page_name = "Главная";
$products = getActiveProducts($db);
?>
<?php $session_id = session_id();?>
<pre><?= var_dump($session_id);?></pre>
<pre><?= var_dump($is_auth);?></pre>
<pre><?= var_dump($user_name);?></pre>
<pre><?= var_dump($_SESSION);?>
</pre>
<?php

$content = include_template("main.php", [
    "categories" => $categories,
    "products" => $products
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "page_name" => $page_name,
    "categories" => $categories,
    "content" => $content
]);

echo $layout_content;
