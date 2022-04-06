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

function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = $link->prepare($sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . $link->connect_error;
        die($errorMsg);
    }

    if ($link->connect_errno) {
        echo "Connect failed: %s\n" . $link->connect_error;
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

    foreach ($data as $value) {
        $type = 's';

        if (is_int($value)) {
            $type = 'i';
        }
        else if (is_string($value)) {
            $type = 's';
        }
        else if (is_double($value)) {
            $type = 'd';
        }

        if ($type) {
            $types .= $type;
            $stmt_data[] = $value;
        }
    }

        $stmt->bind_param($types, $stmt_data);
        $stmt->execute();
    }

    return $stmt;
}
