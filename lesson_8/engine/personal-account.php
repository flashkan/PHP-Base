<?php
$user = getUser($_SESSION['userLog']);

$accountError = '';
$newPasswordSuccess = '';
if ($_POST['oldPassword'] && $_POST['newPassword'] && $_POST['newPasswordAgain']) { // смена пароля
    $user = getUser($_SESSION['userLog']);
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPasswordAgain = $_POST['newPasswordAgain'];
    if (password_verify($oldPassword, $user['user_pass'])) {
        if ($_POST['newPassword'] === $_POST['newPasswordAgain']) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $queryNewPass = "UPDATE `users` SET `user_pass` = '$passwordHash' WHERE `user_log` = '$user[user_log]'";
            mysqli_query(myDB_connect(), $queryNewPass);
            $newPasswordSuccess = 'Успешная смена пароля';
        } else {
            $accountError = 'Поля с новыми поролями должны быть одинаковыми';
        }
    } else {
        $accountError = 'Старый пароль не верен.';
    }
}

$delError = '';
if ($_POST['accountDel']) {  // улаление аккаунта
    $del = $_POST['accountDel'];
    if ($del === 'Удалить' || $del === 'удалить') {
        $userLog = $_SESSION['userLog'];

        if ($isAdmin) {
            $queryLastAdmin = "SELECT `user_id` FROM `users` WHERE `user_admin` = 'admin'";
            $mysqlLastAdmin = mysqli_query(myDB_connect(), $queryLastAdmin);
            $queryResult = [];
            while ($row = mysqli_fetch_assoc($mysqlLastAdmin)) {
                $queryResult[] = $row;
            }
            if (count($queryResult) === 1) {
                $delError = 'Вы единственный админ, удаление запрещено.';
            } else {
                $queryAccountDel = "DELETE FROM `users` WHERE `user_log` = '$userLog'; DELETE FROM `cart` 
            WHERE `user_log` = '$userLog'; DELETE FROM `orders` WHERE `user_log_order` = '$userLog';";
                mysqli_multi_query(myDB_connect(), $queryAccountDel);

                session_start();
                session_destroy();
                setcookie('userLog', $userLog, time() - 1);
                header('location: index.php');
                die;
            }
        }


    } else {
        $delError = 'Некорректный ввод. Введите указанное значение';
    }
}

if ($isAdmin) {
    $queryAllUsers = "SELECT * FROM `users`";
    $mysqlAllUsers = mysqli_query(myDB_connect(), $queryAllUsers);
    $employee = [];
    while ($row = mysqli_fetch_assoc($mysqlAllUsers)) {
        $employee[] = $row;
    }
}

if ($_POST['accountDelAdmin']) {  // администрирование пользователями
    $idUser = $_POST['accountDelAdmin'];
    $queryAccountDel = "SELECT `user_admin`, `user_log` FROM `users` WHERE `user_id` = '$idUser'";
    $mysqlAccountDel = mysqli_query(myDB_connect(), $queryAccountDel);
    $queryResult = mysqli_fetch_assoc($mysqlAccountDel);
    $userLog = $queryResult['user_log'];

    if ($queryResult['user_admin'] !== 'admin') {
        $queryAccountDel = "DELETE FROM `users` WHERE `user_log` = '$userLog'; DELETE FROM `cart` 
            WHERE `user_log` = '$userLog'; DELETE FROM `orders` WHERE `user_log_order` = '$userLog';";
        mysqli_multi_query(myDB_connect(), $queryAccountDel);
    }
    header('location: personal-account.php');
    die;
}
