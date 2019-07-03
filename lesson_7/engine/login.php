<?php
include 'get-user.php';
session_start();

if ($_COOKIE['userLog']) {
    $_SESSION['isAuth'] = true;
    $_SESSION['userLog'] = $_COOKIE['userLog'];
    if ($_COOKIE['userLog'] === 'admin') {
        $_SESSION['isAdmin'] = true;
    }
};

$regError = '';
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
                $_SESSION['isAdmin'] = true;
                $queryReg .= "VALUES ('$name', '$login', '$password', '$email', 'admin');";
            } else {
                $_SESSION['isAdmin'] = false;
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

if ($_POST['login'] && $_POST['password']) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user = getUser($login);

    if ($user['user_log'] === $login) {
        if (password_verify($password, $user['user_pass'])) {
            $_SESSION['isAuth'] = true;
            $_SESSION['userLog'] = $login;
            if ($user['user_admin'] === 'admin') {
                $_SESSION['isAdmin'] = true;
            }
            if ($_POST['rememberMe']) {
                setcookie('userLog', $login, time() + 60 * 60 * 24 * 7);
                if (isset($_POST['getAdmin'])) {
                    setcookie('userAdmin', 'admin', time() + 60 * 60 * 24 * 7);
                }
            }
            header('location: personal-account.php');
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