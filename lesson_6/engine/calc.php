<?php

$calcResult = null;
if (isset($_GET['operation']) && isset($_GET['first-number']) && isset($_GET['second-number'])) {
    $operation = $_GET['operation'];
    $firstNumber = $_GET['first-number'];
    $secondNumber = $_GET['second-number'];
    switch ($operation) {
        case "+":
            return $calcResult = round($firstNumber + $secondNumber, 2);
        case "-":
            return $calcResult = round($firstNumber - $secondNumber, 2);
        case "*":
            return $calcResult = round($firstNumber * $secondNumber, 2);
        case "/":
            if ($secondNumber == 0) {
                return $calcResult = 'На ноль делить нельзя';
            } else {
                return $calcResult = round($firstNumber / $secondNumber, 2);
            }
    }
}