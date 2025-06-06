<?php
$uploadDir = 'uploads/';
$thumbDir = 'thumbs/';
$maxFileSize = 5 * 1024 * 1024; 

// 1. ЛОГИРОВАНИЕ с ротацией файла
function logRequest() {
    $logFile = 'log.txt';
    if (!file_exists($logFile)) {
        file_put_contents($logFile, '');
    }

    $lines = file($logFile, FILE_IGNORE_NEW_LINES);
    if (count($lines) >= 10) {
        $i = 0;
        while (file_exists("log{$i}.txt")) $i++;
        rename($logFile, "log{$i}.txt");
    }

    file_put_contents($logFile, date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
}
logRequest();

// 2. ОБРАБОТКА ЗАГРУЗКИ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    if ($file['error'] === UPLOAD_ERR_OK && $file['size'] <= $maxFileSize) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $filename = uniqid() . '.' . $ext;
            $uploadPath = $uploadDir . $filename;
            $thumbPath = $thumbDir . $filename;

            move_uploaded_file($file['tmp_name'], $uploadPath);
            createThumbnail($uploadPath, $thumbPath, 200);
        }
    }

    // Перезагрузка страницы для обновления галереи
    header('Location: index.php');
    exit;
}

// 3. Функция создания миниатюры
function createThumbnail($srcPath, $destPath, $thumbWidth) {
    $ext = strtolower(pathinfo($srcPath, PATHINFO_EXTENSION));
    if ($ext === 'jpg' || $ext === 'jpeg') {
        $src = imagecreatefromjpeg($srcPath);
    } elseif ($ext === 'png') {
        $src = imagecreatefrompng($srcPath);
    } else return;

    $width = imagesx($src);
    $height = imagesy($src);
    $thumbHeight = floor($height * ($thumbWidth / $width));

    $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
    imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);

    if ($ext === 'jpg' || $ext === 'jpeg') {
        imagejpeg($thumb, $destPath);
    } else {
        imagepng($thumb, $destPath);
    }

    imagedestroy($src);
    imagedestroy($thumb);
}

// 4. Функция отображения галереи
function renderGallery($thumbDir, $uploadDir) {
    $files = scandir($thumbDir);
    foreach ($files as $file) {
        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'])) {
            $thumbPath = $thumbDir . $file;
            $fullPath = $uploadDir . $file;
            echo "<a href='$fullPath' target='_blank'><img src='$thumbPath' width='200' style='margin:10px'></a>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Фотогалерея</title>
</head>
<body>
    <h1>📸 Фотогалерея</h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required accept=".jpg,.jpeg,.png">
        <button type="submit">Загрузить</button>
    </form>

    <hr>

    <div>
        <?php renderGallery($thumbDir, $uploadDir); ?>
    </div>
</body>
</html>
