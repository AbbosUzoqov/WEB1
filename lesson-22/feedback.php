<?php
require 'db.php';

function doFeedbackAction($action, $data) {
    global $conn;

    switch ($action) {
        case 'create':
            $stmt = $conn->prepare("INSERT INTO reviews (product_id, username, content) VALUES (?, ?, ?)");
            $stmt->execute([$data['product_id'], $data['username'], $data['content']]);
            break;

        case 'delete':
            $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
            $stmt->execute([$data['id']]);
            break;
    }

    header("Location: product.php?id=" . $data['product_id']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    doFeedbackAction($_POST['action'], $_POST);
}
