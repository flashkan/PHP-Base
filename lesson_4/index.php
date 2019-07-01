<?php
date_default_timezone_set('Europe/Moscow');
const ROOT_DIR = __DIR__;
const IMG_DIR = '/img/';
include 'gallery.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Animals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div>
    <?php foreach (gallery(ROOT_DIR . IMG_DIR) as $img) : ?>
        <a href="<?= IMG_DIR . $img ?>" target="_blank" style="text-decoration: none">
            <img src="<?= IMG_DIR . $img ?>" alt="$img" width="24.8%">
        </a>
    <?php endforeach ?>
</div>

<div class="menu-case">
    <a href="index.php" class="menu">Main</a>
    <a href="index-second.php" class="menu">Second</a>
</div>

</body>
</html>