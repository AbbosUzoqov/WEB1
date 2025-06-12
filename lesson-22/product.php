<?php require 'db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

$reviews = $conn->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC");
$reviews->execute([$id]);
?>
<!DOCTYPE html>
<html>
<head><title><?= $product['name'] ?></title><link rel="stylesheet" href="style.css"></head>
<body>
<h1><?= htmlspecialchars($product['name']) ?></h1>
<img src="<?= $product['image'] ?>" width="300"><br>
<p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
<p><strong><?= $product['price'] ?> ₽</strong></p>

<hr><h2>Отзывы</h2>
<form method="post" action="feedback.php">
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    Имя: <input type="text" name="username" required><br>
    Отзыв:<br>
    <textarea name="content" required></textarea><br>
    <button type="submit">Оставить отзыв</button>
</form>

<?php foreach ($reviews as $review): ?>
    <div class="review">
        <b><?= htmlspecialchars($review['username']) ?></b> <i><?= $review['created_at'] ?></i>
        <p><?= nl2br(htmlspecialchars($review['content'])) ?></p>
    </div>
<?php endforeach; ?>
</body>
</html>
