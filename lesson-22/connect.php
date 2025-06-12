<?php
$conn = new mysqli("localhost", "root", "", "catalog_db");

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
