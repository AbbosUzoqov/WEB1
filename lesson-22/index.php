<?php require 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Каталог</title><link rel="stylesheet" href="style.css"></head>
<body>
<h1>Каталог товаров</h1>
<div class="catalog">
<?php
$stmt = $conn->query("SELECT * FROM products");
foreach ($stmt as $row):
?>
    <div class="product">
        <a href="product.php?id=<?= $row['id'] ?>">
            <img src="<?= $row['image'] ?>" width="150"><br>
            <?= htmlspecialchars($row['name']) ?><br>
            <strong><?= $row['price'] ?> ₽</strong>
        </a>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>
