<?php
$user = getUser($_SESSION['userLog']);

$accountError = '';
$newPasswordSuccess = '';
if ($_POST['oldPassword'] && $_POST['newPassword'] && $_POST['newPasswordAgain']) {
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
if ($_POST['accountDel']) {
    $del = $_POST['accountDel'];
    if ($del === 'Удалить' || $del === 'удалить') {
        $userLog = $_SESSION['userLog'];
        $queryAccountDel = "DELETE FROM `users` WHERE `user_log` = '$userLog'; DELETE FROM `cart` 
            WHERE `user_log` = '$userLog';";
        mysqli_multi_query(myDB_connect(), $queryAccountDel);

        session_start();
        session_destroy();
        setcookie('userLog', $userLog, time() - 1);
        @header('location: index.php');
        die;
    } else {
        $delError = 'Некорректный ввод. Введите указанное значение';
    }
}

if ($_SESSION['isAdmin']) {
    $queryAllUsers = "SELECT * FROM `users`";
    $mysqlAllUsers = mysqli_query(myDB_connect(), $queryAllUsers);
    $employee = [];
    while ($row = mysqli_fetch_assoc($mysqlAllUsers)) {
        $employee[] = $row;
    }
}

if ($_POST['accountDelAdmin']) {
    $idUser = $_POST['accountDelAdmin'];
    $queryAccountDel = "SELECT `user_admin` FROM `users` WHERE `user_id` = '$idUser'";
    $mysqlAccountDel = mysqli_query(myDB_connect(), $queryAccountDel);
    $queryResult = mysqli_fetch_assoc($mysqlAccountDel);

    if ($queryResult['user_admin'] !== 'admin') {
        $queryAccountDel = "DELETE FROM `users` WHERE `user_log` = '$idUser'; DELETE FROM `cart` 
            WHERE `user_log` = '$idUser';";
        mysqli_multi_query(myDB_connect(), $queryAccountDel);
        header('location: personal-account.php');
        die;
    }
    header('location: personal-account.php');
    die;
}
