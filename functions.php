<?php
function showPrice($number) {
    $number = ceil($number);
    return number_format($number, 0, "", " ") . " ₽";
};

function safeText($text) {
    return htmlspecialchars($text);
};
?>
