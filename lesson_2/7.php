<?php

function declination($number, $one, $two, $five) // делал похожее, использовал свой старый шаблон
{
    $n = $number % 100;
    $n10 = $n % 10;
    if ($n >= 5 && $n <= 20) {
        return $five;
    } else if ($n10 === 1) {
        return $one;
    } else if ($n10 > 1 && $n10 < 5) {
        return $two;
    } else {
        return $five;
    }
}

$date = getdate();
$hours = $date["hours"];
$minutes = $date["minutes"];

$declinHours = declination($hours, 'час', 'часа', 'часов');
$declinMinutes = declination($minutes, 'минута', 'минуты', 'минут');
?>

<h1><?= "$hours $declinHours : $minutes $declinMinutes" ?></h1>