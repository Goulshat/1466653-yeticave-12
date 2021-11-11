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

function countLeftTime(string $expireDate) {
    $timeLeft = strtotime($expireDate) - time();
    return [floor($timeLeft / 3600), ceil(($timeLeft % 3600) / 60)];
}
