<?php
date_default_timezone_set("Asia/Yekaterinburg");

require_once("course_library.php");
require_once("my_functions.php");
require_once("data.php");
/*
$is_auth = rand(0, 1);
$user_name = "Гульшат";

$content = include_template("main.php", ["categories" => $categories, "products" => $products]);
$layout_content = include_template("layout.php", [$page_name => "Главная", "content" => $content]);

echo $layout_content;*/

echo "Hello!";?>
<pre>

<?= var_dump($db_host);?>
<?= var_dump($db_password);?>
<?= var_dump($db_dbname);?>
<?= var_dump($db_port);?>
<?= var_dump($db_charset);?>

</pre>
