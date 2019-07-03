<?php

/**
 * Получает массив с товарами из корзины. Модифицирует его, добавляя актуальную цену. После чего возвращает.
 * @param array $idGood Получаемый массив с товарами из корзины.
 * @return array mixed Модефицированный массив.
 */
function updateCartPrice($idGood) {
    foreach ($idGood as $key => $good) {
        $goodId = $good['id_good'];
        $queryGoods = "SELECT `good_price` FROM `goods` WHERE `id_good` = '$goodId';";
        $result = mysqli_query(myDB_connect(), $queryGoods);
        $goodPrice = mysqli_fetch_assoc($result);
        $idGood[$key]['good_price'] = $goodPrice['good_price'];
    }
    return $idGood;
}

$employee = [];
if ($isAdmin) { // проверка на права администратора, админ видет все заказы.
    $user = $_SESSION['userLog'];
    $queryGoods = "SELECT * FROM `cart`;";
    $result = mysqli_query(myDB_connect(), $queryGoods);
    while ($row = mysqli_fetch_assoc($result)) {
        $employee[] = $row;
    }
    $employee = updateCartPrice($employee); // обновление цены в корзине, цена фиксирутся только после заказа.
} else {
    $user = $_SESSION['userLog'];
    $queryGoods = "SELECT * FROM `cart` WHERE `user_log` = '$user';";
    $result = mysqli_query(myDB_connect(), $queryGoods);
    while ($row = mysqli_fetch_assoc($result)) {
        $employee[] = $row;
    }
    $employee = updateCartPrice($employee); // обновление цены в корзине
}

$emptyCart = '';
if (empty($employee)) {
    $emptyCart = 'Ваша корзина еще пуста.';
}

$totalPrice = 0;
$totalPriceAdmin = 0;
if ($isAdmin) { // расчет общей стоимости товаров в корзине
    foreach ($employee as $good) {
        $price = $good['good_price'] * $good['good_quantity'];
        $totalPrice += $price;
        if ($user === $good['user_log']) {
            $totalPriceAdmin += $price;
        }
    }
} else {
    foreach ($employee as $good) {
        $price = $good['good_price'] * $good['good_quantity'];
        $totalPrice += $price;
    }
}


if (isset($_POST['newOrder'])) { // формирует заказ из товаров в корзине
    if (!empty($employee)) {
        $jsonOrder = [];
        if ($isAdmin) { // админ видет товары всех пользователей, но в заказ может отправить только свои товары
            foreach ($employee as $good) {
                if ($user === $good['user_log']) $jsonOrder[$good['id_good']] = $good['good_quantity'];
            }
            if (!$jsonOrder) {
                header('location: /cart.php');
                die;
            }
        } else {
            foreach ($employee as $good) {
                $jsonOrder[$good['id_good']] = $good['good_quantity'];
            }
        }
        $jsonOrderStr = json_encode($jsonOrder);
        $dataOrder = date("F j, Y, G:i");

        $price = $totalPriceAdmin ? $totalPriceAdmin : $totalPrice;
        $queryOrder = "INSERT INTO `orders` (`json_order`, `total_price_order`, `user_log_order`, `data_order`, `status_order`) 
        VALUE ('$jsonOrderStr', '$price', '$user', '$dataOrder', 'Обработка')";
        mysqli_query(myDB_connect(), $queryOrder);

        // удаление товаров учавствующих в заказе
        $queryCleaningCart = "DELETE FROM `cart` WHERE `user_log` = '$user';";
        mysqli_query(myDB_connect(), $queryCleaningCart);
        header('location: /orders.php');
        die;
    }
}

if ($_POST['goodUp']) {  // увеличение колличества товара
    $goodId = $_POST['goodUp'];
    $queryUp = "UPDATE `cart` SET `good_quantity` = `good_quantity` + 1 
        WHERE `id_good` = $goodId;";
    mysqli_query(myDB_connect(), $queryUp);
    header('location: /cart.php');
    die;
}

if ($_POST['goodDown']) {  // уменьшение колличества товара
    $goodId = $_POST['goodDown'];
    $queryWhatGood = "SELECT `good_quantity` FROM `cart` WHERE `id_good` = '$goodId'";
    $mysqliWhatGood = mysqli_query(myDB_connect(), $queryWhatGood);
    $mysqliWhatGoodResult = mysqli_fetch_assoc($mysqliWhatGood);

    if ($mysqliWhatGoodResult["good_quantity"] == 1) {
        $queryDel = "";
        if ($isAdmin) {
            $queryDel = "DELETE FROM `cart` WHERE `id_good` = '$goodId';";
        } else {
            $queryDel = "DELETE FROM `cart` WHERE `id_good` = '$goodId' AND `user_log` = '$user';";
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

if ($_POST['goodDel']) { // удаление товара
    $goodId = $_POST['goodDel'];
    $queryDel = "";
    if ($isAdmin) {
        $queryDel = "DELETE FROM `cart` WHERE `id_good` = '$goodId';";
    } else {
        $queryDel = "DELETE FROM `cart` WHERE `user_log` = '$user' AND `id_good` = '$goodId';";
    }
    mysqli_query(myDB_connect(), $queryDel);
    header('location: /cart.php');
    die;
}