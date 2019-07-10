<?php
include 'get-user.php';
session_start();

/**
 * Проверка, является ли пользователь админом. Принимает логин пользователя. Через БД определяет является ли юзер
 * админом. И возварщает булево значение true при успехе и false в противном случае.
 * @param string $login Строка с логином пользоваетля
 * @return bool Возварщает булево значение true при успехе и false в противном случае.
 */
function isAdmin($login)
{
    $queryIsAdmin = "SELECT `user_admin` FROM `users` WHERE `user_log` = '$login'";
    $mysqliIsAdmin = mysqli_query(myDB_connect(), $queryIsAdmin);
    $result = mysqli_fetch_assoc($mysqliIsAdmin);
    if ($result['user_admin'] === 'admin') return true;
    return false;
}

/**
 * Создает пользователя с рандомным логином. И возвращает получиноую строку.
 * @return string строка с логином пользователя
 */
function newUserNotLogin()
{
    $strTemplate = '1234567890';
    $login = 'user-';
    $queryReg = '';
    $isTrue = true;
    while ($isTrue) {
        for ($i = 0; $i < 5; $i++) {
            $login .= $strTemplate[rand(0, strlen($strTemplate) - 1)];
        }
        if (!getUser($login)) {
            $queryReg = "INSERT INTO `users` (`user_log`) VALUES ('$login');";
            $isTrue = false;
        }
    }

    mysqli_query(myDB_connect(), $queryReg);
    $_SESSION['isAuth'] = true;
    $_SESSION['userLog'] = $login;
    $_SESSION['once'] = true;
    return $login;
}

$isAdmin = isAdmin($_SESSION['userLog']);

if ($_COOKIE['userLog']) {
    $_SESSION['isAuth'] = true;
    $_SESSION['userLog'] = $_COOKIE['userLog'];
    $isAdmin = isAdmin($_SESSION['userLog']);
};

$regError = ''; // регистрация пользователя
$mainError = '';
if ($_POST['regLogin'] && $_POST['regPassword'] && $_POST['regPasswordAgain'] && $_POST['regName'] && $_POST['regEmail']) {
    if ($_POST['regPassword'] !== $_POST['regPasswordAgain']) {
        $regError = 'Поля с поролями должны быть одинаковыми';
    } else {
        $login = $_POST['regLogin'];
        $password = password_hash($_POST['regPassword'], PASSWORD_DEFAULT);
        $name = $_POST['regName'];
        $email = $_POST['regEmail'];
        if (!getUser($login)) {
            $queryReg = "INSERT INTO `users` (`user_name`, `user_log`, `user_pass`, `user_email`, `user_admin`)";
            if (isset($_POST['getAdmin'])) {
                $isAdmin = true;
                $queryReg .= "VALUES ('$name', '$login', '$password', '$email', 'admin');";
            } else {
                $isAdmin = false;
                $queryReg .= "VALUES ('$name', '$login', '$password', '$email', '');";
            }
            mysqli_query(myDB_connect(), $queryReg);

            $_SESSION['isAuth'] = true;
            $_SESSION['userLog'] = $login;
            if ($_POST['rememberMe']) {
                setcookie('userLog', $login, time() + 60 * 60 * 24 * 7);
                if (isset($_POST['getAdmin'])) {
                    setcookie('userAdmin', 'admin', time() + 60 * 60 * 24 * 7);
                }
            }

            header('location: personal-account.php');
            die;
        } else {
            $regError = 'Данный логин занят, попробуйте подобрать другой.';
        }
    }

}

if ($_POST['login'] && isset($_POST['password'])) { // аутентификация пользователя
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user = getUser($login);

    if ($user['user_log'] === $login) {
        if (password_verify($password, $user['user_pass']) || $user['user_pass'] === NULL) {
            if ($user['user_pass'] === NULL) { // пользователь из БД без паролья - юзер с разовым логином
                $_SESSION['once'] = true;
            }
            $_SESSION['isAuth'] = true;
            $_SESSION['userLog'] = $login;
            $isAdmin = isAdmin($login);
            if ($_POST['rememberMe']) {
                setcookie('userLog', $login, time() + 60 * 60 * 24 * 7);
            }
            if ($_SESSION['once']) {
                header('location: /');
            } else {
                header('location: personal-account.php');
            }
            die;
        }
    }
    $_SESSION['isAuth'] = false;
    $mainError = 'Логин/пороль не верен.';
}

if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    setcookie('userLog', $login, time() - 1);
    setcookie('userAdmin', 'admin', time() - 1);
    @header('location: index.php');
    die;
}

session_write_close();
