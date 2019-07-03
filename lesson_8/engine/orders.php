<?php

$employee = [];
if ($isAdmin) {
    $queryGoods = "SELECT * FROM `orders`;";
    $result = mysqli_query(myDB_connect(), $queryGoods);
    while ($row = mysqli_fetch_assoc($result)) {
        $employee[] = $row;
    }
} else {
    $user = $_SESSION['userLog'];
    $queryOrders = "SELECT * FROM `orders` WHERE `user_log_order` = '$user';";
    $result = mysqli_query(myDB_connect(), $queryOrders);

    $employee = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employee[] = $row;
    }
}

$emptyOrders = '';
if (empty($employee)) {
    $emptyOrders = 'У вас нет действующих заказов.';
}

if ($_POST['delOrder']) { // удаление заказа
    $orderId = $_POST['delOrder'];
    $queryDelOrder = "DELETE FROM `orders` WHERE `id_order` = '$orderId'";
    mysqli_query(myDB_connect(), $queryDelOrder);
    header('location: /orders.php');
    die;
}

if ($_POST['processing'] || $_POST['delivery'] || $_POST['arrived'] || $_POST['closed']) { // статус заказа
    $queryChangeStatusOrder = "";
    $orderProcessing = $_POST['processing'];
    $orderDelivery = $_POST['delivery'];
    $orderArrived = $_POST['arrived'];
    $orderClosed = $_POST['closed'];
    if ($orderProcessing) {
        $queryChangeStatusOrder = "UPDATE `orders` SET `status_order` = 'Обработка' WHERE `id_order` = '$orderProcessing';";
    }
    if ($orderDelivery) {
        $queryChangeStatusOrder = "UPDATE `orders` SET `status_order` = 'Доставляется' WHERE `id_order` = '$orderDelivery';";
    }
    if ($orderArrived) {
        $queryChangeStatusOrder = "UPDATE `orders` SET `status_order` = 'Доставлено' WHERE `id_order` = '$orderArrived';";
    }
    if ($orderClosed) {
        $queryChangeStatusOrder = "UPDATE `orders` SET `status_order` = 'Закрыт' WHERE `id_order` = '$orderClosed';";
    }
    mysqli_query(myDB_connect(), $queryChangeStatusOrder);
    header('location: /orders.php');
    die;
}