<?php
function include_template($name, array $data = [])
{
    $name = __DIR__.'/templates/'.$name;

    ob_start();
    extract($data);
    require $name;

    return ob_get_clean();
}

function showPrice($number) {
    $number = ceil($number);
    return number_format($number, 0, "", " ") . " ₽";
};

function html_sc($text) {
    return htmlspecialchars($text, ENT_QUOTES);
};
?>
