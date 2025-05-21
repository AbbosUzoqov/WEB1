<?php
// Задание 1
echo("<h3>Задание 1</h3>");

$i = 0;
do {
    if ($i == 0) {
        echo $i . ' - это ноль.';
    } elseif ($i % 2 == 0) {
        echo $i . ' - чётное число.';
    } else {
        echo $i . ' - нечётное число.';
    }
    echo '<br>';
    $i++;
} while ($i <= 10);

echo("<hr>");

//Задание 2
echo("<h3>Задание 2</h3>");

$dict = [
    'Московская область' => [
        'Москва',
        'Зеленоград',
        'Клин'
    ],
    'Ленинградская область' => [
        'Санкт-Петербург',
        'Всеволожск',
        'Павловск',
        'Кронштадт'
    ],
    'Рязанская область' => [
        'Рязань',
        'Скопин',
        'Рыбное',
        'Шилово',
        'Новомичуринск',
    ]
];
foreach ($dict as $reg => $cities) {
    echo '<h4>' . $reg . ': <br></h4>';
    echo implode(', ', $cities) . '.';
    echo '<br>';
}

echo("<hr>");

// Задание 3
echo("<h3>Задание 3</h3>");

function transliteration($text){
    $letters = array('а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'ye', 'ё'=>'yo', 'ж'=>'zh', 'з'=>'z', 'и'=>'i', 'к'=>'k', 'л'=>'l','м'=>'m', 'н'=>'n','о'=>'o', 'п'=>'p','р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u','ф'=>'f','х'=>'kh', 'ц'=>'ts', 'ч'=>'ch', 'ш'=>'sh','щ'=>'tch', 'ъ'=>'"', 'ы'=>'y', 'ь'=>'`', 'э'=>'eh', 'ю'=>'yu', 'я'=>'ya');
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $res = '';
    foreach($chars as $val) {
        $res .= isset($letters[$val]) ? $letters[$val] : $val; 
    }
    return $res;
}

$text = 'раз, два, три, четыре, пять.';
echo transliteration($text);
echo("<hr>");

// Задание 4
echo("<h3>Задание 4</h3>");

$menu =  [
    [
        'title' => 'Меню 1',
        'link' => 'menu_1',
        'children' => [[
            'title' => 'Подменю 1',
            'link' => 'sub-menu_1',
            'children' => [
                [
                    'title' => 'Подменю 1.1',
                    'link' => 'sub-menu_1-1',
                    'children' => [
                        [
                            'title' => 'Подменю 1.1.1',
                            'link' => 'sub-menu_1-1-1',
                        ],
                    ]
                ]
            ]
        ]],
    ],
    [
        'title' => 'Меню 2',
        'link' => 'menu_2',
        'children' => [[
            'title' => 'Подменю 2',
            'link' => 'sub-menu_2',
            'children' => [
                [
                    'title' => 'Подменю 2.1',
                    'link' => 'sub-menu_2-1',
                ]
            ]]
        ]
    ],
    [
        'title' => 'Меню 3',
        'link' => 'menu_3',
    ]
];

function createMenu($menu) {
    echo '<ul>';
    foreach ($menu as $value) {
        echo '<li>';
        echo "<a href='{$value['link']}'> {$value['title']} </a>";
        if (isset($value['children'])) {
            createMenu($value['children']);
        }
        echo '</li>';
    }
    echo '</ul>';
}
createMenu($menu);

echo("<hr>");

// Задание 6
echo("<h3>Задание 6</h3>");

foreach ($dict as $reg => $cities) {
    echo $reg . ': <br>';
    foreach ($cities as $city) {
        if (preg_match('/К/', $city)) {
            echo $city . ', ';
        }
    }
    echo '<br>';
}

echo("<hr>");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>