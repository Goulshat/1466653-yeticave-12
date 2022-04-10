<?php
function include_template($name, array $data = []) {
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
    $hoursLeft = floor($timeLeft / 3600);
    $minutesLeft = ceil(($timeLeft % 3600) / 60);
    return [str_pad($hoursLeft, 2, "0", STR_PAD_LEFT), str_pad($minutesLeft, 2, "0", STR_PAD_LEFT)];
}

function countPassTime(string $registerDate) {
    $timePassed = time() - strtotime($registerDate);
    $hoursPassed = floor($timePassed / 3600);
    $minutesPassed = ceil(($timePassed % 3600) / 60);
    return [$hoursPassed, $minutesPassed];
}

function showNotFoundPage($categories, $is_auth, $user_name) {
    $page_name = "404 Страница не найдена";
    $content = include_template("404.php", ["categories" => $categories]);
    $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $page_name, "categories" => $categories, "content" => $content]);
    echo $layout_content;
};
