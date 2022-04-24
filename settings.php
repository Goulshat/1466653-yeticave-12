<?php
date_default_timezone_set("Asia/Yekaterinburg");

error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//Yetivave shop settings
$is_auth = rand(0, 1);
$user_name = "Гульшат";
$bid_step_min = "50";
$bid_step_max = "10000";
