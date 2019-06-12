<?php
$a = -15;
$b = -5;

if ($a >= 0 && $b >= 0) {
    if ($b === 0) {
        echo 'Ошибка. Деление на ноль';
    } else {
        echo $a / $b;
    }
} elseif ($a < 0 && $b < 0) {
    echo $a * $b;
} else {
    echo $a + $b;
}