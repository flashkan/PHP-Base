<?php

if (isset($_POST['addToCart'])) {
    if ($_SESSION['isAuth']) {
        $idGood = $_POST['addToCart'];
        $user = $_SESSION['userLog'];
        $queryAdd = "SELECT * FROM `goods` WHERE `id_good` = '$idGood' LIMIT 1";
        $mysqliAdd = mysqli_query(myDB_connect(), $queryAdd);
        $mysqliAddResult = mysqli_fetch_assoc($mysqliAdd);

        $queryCheck = "SELECT `id_good`, `good_quantity` FROM `cart` WHERE `id_good` = '$mysqliAddResult[id_good]' 
            AND `user_log` = '$user'";
        $mysqliCheck = mysqli_query(myDB_connect(), $queryCheck);
        $mysqliCheckResult = mysqli_fetch_assoc($mysqliCheck);

        if ($mysqliCheckResult['id_good'] !== NULL) {
            $queryBoost = "UPDATE `cart` SET `good_quantity` = $mysqliCheckResult[good_quantity] + 1 
                WHERE `id_good` = $mysqliCheckResult[id_good];";
            mysqli_query(myDB_connect(), $queryBoost);
            header('location: /');
            die;
        } else {
            $goodId = $mysqliAddResult['id_good'];
            $goodName = $mysqliAddResult['good_name'];
            $goodDesc = $mysqliAddResult['good_description'];
            $goodPrice = $mysqliAddResult['good_price'];
            $goodQuant = 1;

            $queryMerge = "INSERT INTO `cart` (`id_good`, `good_name`, `good_description`, `good_price`,
 `good_quantity`, `user_log`) VALUE ('$goodId', '$goodName', '$goodDesc', '$goodPrice', '$goodQuant', '$user');";
            mysqli_query(myDB_connect(), $queryMerge);
        }
    } else {
        $mainError = 'Для добавления товара в корзину, авторизуйтесь или зарегестрируйтесь.';
    }
}

