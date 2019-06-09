<?php

function power($val, $pow)
{
    if ($pow === 0) {
        return 1;
    }
    $pow--;
    return $val * power($val, $pow);
}

$val = 5;
$pow = 3;
echo power($val, $pow);