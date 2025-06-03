<?php
$title = "Добро пожаловать на мой сайт";
$mainHeading = "Главная страница";
$currentYear = date("Y");

function getCurrentTimeWithWords() {
    $hours = (int)date("G"); 
    $minutes = (int)date("i"); 

    if ($hours % 10 == 1 && $hours % 100 != 11) {
        $hoursWord = "час";
    } elseif (in_array($hours % 10, [2, 3, 4]) && !in_array($hours % 100, [12, 13, 14])) {
        $hoursWord = "часа";
    } else {
        $hoursWord = "часов";
    }

    if ($minutes % 10 == 1 && $minutes % 100 != 11) {
        $minutesWord = "минута";
    } elseif (in_array($minutes % 10, [2, 3, 4]) && !in_array($minutes % 100, [12, 13, 14])) {
        $minutesWord = "минуты";
    } else {
        $minutesWord = "минут";
    }

    return "$hours $hoursWord $minutes $minutesWord";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $mainHeading ?></h1>
    <p>Текущий год: <?= $currentYear ?></p>
    <p>Текущее время: <?= getCurrentTimeWithWords() ?></p>
</body>
</html>
