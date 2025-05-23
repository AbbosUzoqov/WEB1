<?php

$logFile = 'log.txt';
$logs = file_exists($logFile) ? file($logFile) : [];
if (count($logs) >= 10) {
    $i = 0;
    while (file_exists("log$i.txt")) $i++;
    rename($logFile, "log$i.txt");
}
$entry = date('Y-m-d H:i:s') . " - " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
file_put_contents($logFile, $entry, FILE_APPEND);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $allowed = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($file['type'], $allowed) && $file['size'] <= 5 * 1024 * 1024) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $name = uniqid() . '.' . $ext;
        $uploadPath = "gallery/$name";
        move_uploaded_file($file['tmp_name'], $uploadPath);
        createThumbnail($uploadPath, "gallery/thumbs/$name", 200);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Неверный формат или слишком большой файл.";
    }
}
function buildGallery($folder) {
    $files = scandir($folder);
    foreach ($files as $file) {
        $path = "$folder/$file";
        if (is_file($path) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
            echo "<a href='$path' target='_blank'>
                    <img src='$path' width='200' style='margin:10px;'>
                  </a>";
        }
    }
}

function createThumbnail($src, $dest, $width) {
    $info = getimagesize($src);
    $srcWidth = $info[0];
    $srcHeight = $info[1];
    $height = floor($srcHeight * ($width / $srcWidth));
    $thumb = imagecreatetruecolor($width, $height);

    switch ($info['mime']) {
        case 'image/jpeg': $source = imagecreatefromjpeg($src); break;
        case 'image/png': $source = imagecreatefrompng($src); break;
        case 'image/gif': $source = imagecreatefromgif($src); break;
        default: return false;
    }

    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
    imagejpeg($thumb, $dest);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
</head>
<body>
    <h1>Фотогалерея</h1>

    <!-- Форма загрузки -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit">Загрузить</button>
    </form>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <hr>

    <!-- Галерея -->
    <div>
        <?php buildGallery('gallery/thumbs'); ?>
    </div>
</body>
</html>
