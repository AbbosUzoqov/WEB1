<?php

// Задание 1
echo("<h3>Задание 1</h3>");
$a = -5;
$b = 10;

if ($a >= 0 && $b >= 0) {
    echo "Разность: " . ($a - $b);
} elseif ($a < 0 && $b < 0) {
    echo "Произведение: " . ($a * $b);
} else {
    echo "Сумма: " . ($a + $b);
}
?>

<?php

// Задание 2

echo("<h3>Задание 2</h3>");
$a = 11;

switch ($a) {
    case 0:
        echo "0<br>";
    case 1:
        echo "1<br>";
    case 2:
        echo "2<br>";
    case 3:
        echo "3<br>";
    case 4:
        echo "4<br>";
    case 5:
        echo "5<br>";
    case 6:
        echo "6<br>";
    case 7:
        echo "7<br>";
    case 8:
        echo "8<br>";
    case 9:
        echo "9<br>";
    case 10:
        echo "10<br>";
    case 11:
        echo "11<br>";
    case 12:
        echo "12<br>";
    case 13:
        echo "13<br>";
    case 14:
        echo "14<br>";
    case 15:
        echo "15<br>";
        break;
    default:
        echo "Значение вне диапазона 0–15";
}
?>

<?php

// Задание 3

echo("<h3>Задание 3</h3>");
function add($a, $b) {
    return $a + $b;
}

function subtract($a, $b) {
    return $a - $b;
}

function multiply($a, $b) {
    return $a * $b;
}

function divide($a, $b) {
    return $b != 0 ? $a / $b : "Ошибка: деление на ноль";
}
?>

<?php
// Задание 4

echo("<h3>Задание 4</h3>");
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case 'add':
            return add($arg1, $arg2);
        case 'subtract':
            return subtract($arg1, $arg2);
        case 'multiply':
            return multiply($arg1, $arg2);
        case 'divide':
            return divide($arg1, $arg2);
        default:
            return "Неизвестная операция";
    }
}


echo mathOperation(5, 2, 'multiply'); 
?>



<?php
// Задание 6
echo("<h3>Задание 6</h3>");
function power($val, $pow) {
    if ($pow == 0) {
        return 1;
    } elseif ($pow > 0) {
        return $val * power($val, $pow - 1);
    } else {
        return 1 / power($val, -$pow); 
    }
}

echo power(2, 3); 
echo power(2, -2); 
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo date("Y"); ?></title>
</head>
<body>
    <h3>Задание 5</h3>
    <h1><?= date("Y"); ?></h1> 
    <p><?php echo date("Y"); ?></p> 
    <footer>
        <?php
        $year = date("Y");
        echo "<small>$year</small>"; 
        ?>
    </footer>
</body>
</html>
