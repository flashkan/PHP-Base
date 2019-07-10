<?php

$employee = [];
if ($_SESSION['isAdmin']) {
    $user = $_SESSION['userLog'];
    $queryGoods = "SELECT * FROM `cart`;";
    $result = mysqli_query(myDB_connect(), $queryGoods);

    while ($row = mysqli_fetch_assoc($result)) {
        $employee[] = $row;
    }
} else {
    $user = $_SESSION['userLog'];
    $queryGoods = "SELECT * FROM `cart` WHERE `user_log` = '$user';";
    $result = mysqli_query(myDB_connect(), $queryGoods);

    while ($row = mysqli_fetch_assoc($result)) {
        $employee[] = $row;
    }
}


$emptyCart = '';
if (empty($employee)) {
    $emptyCart = 'Ваша корзина еще пуста.';
}

$totalPrice = 0;
foreach ($employee as $good) {
    $price = $good['good_price'] * $good['good_quantity'];
    $totalPrice += $price;
}

$orderSent = '';
if (isset($_POST['newOrder'])) {
    if (!empty($employee)) {
        $jsonOrder = [];
        foreach ($employee as $good) {
            $jsonOrder[$good['id_good']] = $good['good_quantity'];
        }
        $jsonOrderStr = json_encode($jsonOrder);
        $dataOrder = date("F j, Y, G:i");
        $queryOrder = "INSERT INTO `orders` (`json_order`, `total_price_order`, `user_log_order`, `data_order`, `status_order`) 
        VALUE ('$jsonOrderStr', '$totalPrice', '$user', '$dataOrder', 'Обработка')";
        mysqli_query(myDB_connect(), $queryOrder);

        $queryCleaningCart = "DELETE FROM `cart` WHERE `user_log` = '$user';";
        mysqli_query(myDB_connect(), $queryCleaningCart);
        header('location: /orders.php');
        die;
    }
}

if ($_POST['goodUp']) {
    $goodId = $_POST['goodUp'];
    $queryUp = "UPDATE `cart` SET `good_quantity` = `good_quantity` + 1 
        WHERE `id_good` = $goodId;";
    mysqli_query(myDB_connect(), $queryUp);
    header('location: /cart.php');
    die;
}

if ($_POST['goodDown']) {
    $goodId = $_POST['goodDown'];
    $queryWhatGood = "SELECT `good_quantity` FROM `cart` WHERE `id_good` = '$goodId'";
    $mysqliWhatGood = mysqli_query(myDB_connect(), $queryWhatGood);
    $mysqliWhatGoodResult = mysqli_fetch_assoc($mysqliWhatGood);

    if ($mysqliWhatGoodResult["good_quantity"] == 1) {
        $queryDel = "";
        if ($_SESSION['isAdmin']) {
            $queryDel = "DELETE FROM `cart` WHERE `id_good` = '$goodId';";
        } else {
            $queryDel = "DELETE FROM `cart` WHERE `user_log` = '$user' AND `id_good` = '$goodId';";
        }

        mysqli_query(myDB_connect(), $queryDel);
        header('location: /cart.php');
        die;
    } else {
        $queryDown = "UPDATE `cart` SET `good_quantity` = `good_quantity` - 1 
        WHERE `id_good` = $goodId;";
        mysqli_query(myDB_connect(), $queryDown);
        header('location: /cart.php');
        die;
    }
}

if ($_POST['goodDel']) {
    $goodId = $_POST['goodDel'];
    $queryDel = "";
    if ($_SESSION['isAdmin']) {
        $queryDel = "DELETE FROM `cart` WHERE `id_good` = '$goodId';";
    } else {
        $queryDel = "DELETE FROM `cart` WHERE `user_log` = '$user' AND `id_good` = '$goodId';";
    }
    mysqli_query(myDB_connect(), $queryDel);
    header('location: /cart.php');
    die;
}