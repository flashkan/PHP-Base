<?php

$queryGoods = "SELECT * FROM `goods`;";
$result = mysqli_query(myDB_connect(), $queryGoods);

$employee = [];
while ($row = mysqli_fetch_assoc($result)) {
    $employee[] = $row;
}