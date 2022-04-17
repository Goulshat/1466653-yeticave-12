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

function showNotFoundPage($categories, $is_auth, $user_name, $error_message = "404 Страница не найдена") {
    http_response_code(404);
    $content = include_template("404.php", ["categories" => $categories, "error_message" => $error_message]);
    $layout_content = include_template("layout.php", ["is_auth" => $is_auth, "user_name" => $user_name, "page_name" => $error_message, "categories" => $categories, "content" => $content]);
    echo $layout_content;
    exit();
};

/* ----- Функции валидации формы - выделить ли в отдельный файл? ----- */
// function isEmail($value) {//mail@mail.ru
    //     return filter_var($value, FILTER_VALIDATE_EMAIL);
    // };

    // function isFloat($value) {
    //     return filter_var($value, FILTER_VALIDATE_FLOAT);
    // }

    // function isInteger($value) { //isBid
    //     filter_var($value, FILTER_VALIDATE_INT);
    // }

    // function validateExpireDate($value) { //'date-expire'
    //     return (strtotime($value) - time()) > 86000; //сек в сутках
    // }

function validateIsFilled($required_fields) { //'lot-name', 'description'
    $empty_fields = [];
    foreach ($required_fields as $id => $value) {
        if(empty($_POST[$value])) {
            $empty_fields[] = $value;
            echo "Пустое поле в цикле " . var_dump($value);
        }
    }
    return $empty_fields;
};

function validateAddLotForm($fields, $categories) {
    $errors_array = [];

    foreach($fields as $key => $value) {
        if($key === "lot-name" || $key === "description") {
            $value = trim($value);
        }

        if($key === "start-price") {
            $value = filter_var($value, FILTER_VALIDATE_FLOAT);
            if($value < 0) {
                $errors_array[] = "start-price-error";
            }
        }

        if($key === "bid-step") {
            $value = filter_var($value, FILTER_VALIDATE_INT);
            if($value === false) {
                $errors_array[] = "bid-step-error";
            }
            //хорошо бы max min, то требований в ТЗ на это нет
        }

        // if($key === "category") {
        //     $category = array_values($categories);
        //     array_search($category, $categories);
        //     if(!$category) {
        //         $errors_array[] = "category-error";
        //     } else {
        //         echo "Категория найдена";
        //     };
        // }

        if($key === "date-expire") {
            $time_left = strtotime($value) - time();
            if($time_left < 86000) {
                $errors_array[] = "date-expire-error";
            }

            $date_format = preg_match("/20[0-9][0-9]\-(0[1-9]|1[012])\-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $value);
            if(!$date_format) {
                $errors_array[] = "date-format-error";
            }
        }
    };
    return $errors_array;
};
