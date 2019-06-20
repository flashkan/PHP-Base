<?php

$i = 0;
const END = 10;

do {
    if ($i === 0) {
        $number = 'ноль.';
    } elseif ($i % 2 === 0) {
        $number = 'четное число.';
    } else {
        $number = 'нечетное число';
    }
    echo "$i - $number<br>";
    $i++;
} while($i <= END);