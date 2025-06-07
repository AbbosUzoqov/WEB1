<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=localhost;dbname=menu_db;charset=utf8", "root", "");

// Рекурсивная функция
function buildMenu($parentId, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE parent_id " . ($parentId === null ? "IS NULL" : "= ?"));
    if ($parentId === null) $stmt->execute();
    else $stmt->execute([$parentId]);

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$items) return;

    echo "<ul>";
    foreach ($items as $item) {
        echo "<li>";
        echo "<span class='toggle-folder'>📁 {$item['title']}</span>";
        buildMenu($item['id'], $pdo); 
        echo "</li>";
    }
    echo "</ul>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Каталог</title>
    <style>
        ul { list-style: none; padding-left: 20px; }
        .toggle-folder { cursor: pointer; user-select: none; }
        ul ul { display: none; }
    </style>
</head>
<body>
    <h1>Каталог товаров</h1>
    <?php buildMenu(null, $pdo); ?>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".toggle-folder").forEach(el => {
                el.addEventListener("click", () => {
                    const next = el.nextElementSibling;
                    if (next && next.tagName === "UL") {
                        next.style.display = next.style.display === "block" ? "none" : "block";
                    }
                });
            });
        });
    </script>
</body>
</html>
