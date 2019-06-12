<?php
$a = 15;
$b = 5;
echo subtraction($a, $b) . " вычитание<br>";
echo addition($a, $b) . " сложение<br>";
echo division($a, $b) . " деление<br>";
echo multiplication($a, $b) . " умножение<br>";

function subtraction($a, $b)
{
    return $a - $b;
}

function addition($a, $b)
{
    return $a + $b;
}

function division($a, $b)
{
    return $a / $b;
}

function multiplication($a, $b)
{
    return $a * $b;
}