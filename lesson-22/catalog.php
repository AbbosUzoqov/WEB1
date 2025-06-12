$conn = new mysqli("localhost", "root", "", "catalog_db");
$result = $conn->query("SELECT * FROM products");

while ($row = $result->fetch_assoc()) {
    echo "<div>
        <a href='product.php?id={$row['id']}'>
            <img src='{$row['image']}' width='150'><br>
            <strong>{$row['name']}</strong><br>
            {$row['price']} руб.
        </a>
    </div><hr>";
}
