<?php
/**
 * Принимает строку с логином пользователея. Ищет эту строку в базе данных юзеров. При нахождении отдает массив юзера.
 * В противном случае возварщает false.
 * @param string $login Строка с логином пользователя.
 * @return array|bool|null Если true массив с данными пользователя / bool = false
 */
function getUser($login)
{
    $queryUser = "SELECT * FROM `users` WHERE `user_log` = '$login' LIMIT 1";
    $mysqlAuth = mysqli_query(myDB_connect(), $queryUser);
    $user = mysqli_fetch_assoc($mysqlAuth);

    if (!is_null($user)) return $user;
    return false;
}