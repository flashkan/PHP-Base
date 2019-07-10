<?php

session_start();

if (isset($_POST['addToCart'])) { // добавление нового товара в корзину
    if ($_SESSION['isAuth']) {
        $user = $_SESSION['userLog'];
    } else {
        $user = newUserNotLogin(); // если пользователь не аутентификацирован, создает рандомный логин
    }
    $idGood = $_POST['addToCart'];
    $queryAdd = "SELECT * FROM `goods` WHERE `id_good` = '$idGood' LIMIT 1";
    $mysqliAdd = mysqli_query(myDB_connect(), $queryAdd);
    $mysqliAddResult = mysqli_fetch_assoc($mysqliAdd);

    $queryCheck = "SELECT `id_good`, `good_quantity` FROM `cart` WHERE `id_good` = '$mysqliAddResult[id_good]' 
            AND `user_log` = '$user'";
    $mysqliCheck = mysqli_query(myDB_connect(), $queryCheck);
    $mysqliCheckResult = mysqli_fetch_assoc($mysqliCheck);

    if ($mysqliCheckResult['id_good'] !== NULL) { // если товар у юзера уже есть, то добваляется единица к количесту
        $queryBoost = "UPDATE `cart` SET `good_quantity` = $mysqliCheckResult[good_quantity] + 1 
                WHERE `id_good` = $mysqliCheckResult[id_good];";
        mysqli_query(myDB_connect(), $queryBoost);
        header('location: /');
        die;
    } else { // создание нового товара
        $goodId = $mysqliAddResult['id_good'];
        $goodName = $mysqliAddResult['good_name'];
        $goodDesc = $mysqliAddResult['good_description'];
        $goodQuant = 1;

        $queryMerge = "INSERT INTO `cart` (`id_good`, `good_name`, `good_description`, `good_quantity`, `user_log`) 
                VALUE ('$goodId', '$goodName', '$goodDesc', '$goodQuant', '$user');";
        mysqli_query(myDB_connect(), $queryMerge);
    }
}

session_write_close();