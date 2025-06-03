<?php

include '../db/db.php';

function renderDBRows($items, $parentId) {
    foreach ($items as $item) {
        if ($item['parentId'] == $parentId) {
            echo '<div class="list-item list-item_open" data-parent>' .
                '<div class="list-item__inner">' .
                '<img class="list-item__arrow" src="img/chevron-down.png" alt="chevron-down.png" data-open>' .
                '<img class="list-item__folder" src="img/folder.png" alt="folder.png">';
            echo $item['name'] . '</div>';
            echo '<div class="list-item__items">';
            renderDBRows($items, $item['id']);
            echo '</div></div>';
        }
    }
}

function getDBRows()
{
    return getAssocResult("SELECT * FROM `catalogs`");
}

?>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Catalogs</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="list-items" id="list-items">
            <?=renderDBRows(getDBRows(), null)?>
        </div>
        <script type="module" src="script.js"></script>
    </body>
</html>