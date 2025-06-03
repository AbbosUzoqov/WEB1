<?php
// ЗАДАНИЕ 1
function printNumbers() {
    $i = 0;
    do {
        if ($i == 0) {
            echo "$i – это ноль.<br>";
        } elseif ($i % 2 == 0) {
            echo "$i – чётное число.<br>";
        } else {
            echo "$i – нечётное число.<br>";
        }
        $i++;
    } while ($i <= 10);
}
echo "<h2>Задание 1</h2>";
printNumbers();

// ЗАДАНИЕ 2
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Касимов', 'Скопин']
];

echo "<h2>Задание 2</h2>";
foreach ($regions as $region => $cities) {
    echo "<strong>$region:</strong><br>";
    echo implode(', ', $cities) . '.<br>';
}

// ЗАДАНИЕ 3
$translit = [
    'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh',
    'з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
    'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'ts',
    'ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya'
];

function transliterate($string, $map) {
    $string = mb_strtolower($string); 
    $result = '';
    $letters = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($letters as $char) {
        $result .= $map[$char] ?? $char;
    }
    return $result;
}

echo "<h2>Задание 3</h2>";
$test = "Привет, мир!";
echo "Исходная строка: $test<br>";
echo "Транслитерация: " . transliterate($test, $translit) . "<br>";

// ЗАДАНИЕ 4
$menu = [
    'Главная' => '/',
    'О нас' => '/about',
    'Услуги' => [
        'Разработка' => '/services/dev',
        'Продвижение' => '/services/seo'
    ],
    'Контакты' => '/contacts'
];

function renderMenu($menu) {
    echo "<ul>";
    foreach ($menu as $key => $value) {
        if (is_array($value)) {
            echo "<li>$key";
            renderMenu($value); 
            echo "</li>";
        } else {
            echo "<li><a href='$value'>$key</a></li>";
        }
    }
    echo "</ul>";
}

echo "<h2>Задание 4</h2>";
renderMenu($menu);

// ЗАДАНИЕ 5
echo "<h2>Задание 5</h2>";
foreach ($regions as $region => $cities) {
    $filtered = array_filter($cities, fn($city) => mb_substr($city, 0, 1) == 'К');
    if (!empty($filtered)) {
        echo "<strong>$region:</strong><br>";
        echo implode(', ', $filtered) . '.<br>';
    }
}
?>
