<?php
function getUser($login)
{
    $queryUser = "SELECT * FROM `users` WHERE `user_log` = '$login' LIMIT 1";
    $mysqlAuth = mysqli_query(myDB_connect(), $queryUser);
    $user = mysqli_fetch_assoc($mysqlAuth);

    if (!is_null($user)) return $user;
    return false;
}