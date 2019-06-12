<?php

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

$a = 15;
$b = 5;
$operation = '+';
function mathOperation($a, $b, $operation)
{
    switch ($operation) {
        case '+':
            echo addition($a, $b) . " сложение<br>";
            return;
        case '-':
            echo subtraction($a, $b) . " вычитание<br>";
            return;
        case '*':
            echo multiplication($a, $b) . " умножение<br>";
            return;
        case '/':
            echo division($a, $b) . " деление<br>";
            return;
    }
}