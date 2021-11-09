<?php
function showPrice($number) {
    $number = ceil($number);
    return number_format($number, 0, "", " ") . " ₽";
};

function html_sc($text) {
    return htmlspecialchars($text, ENT_QUOTES);
};
?>
