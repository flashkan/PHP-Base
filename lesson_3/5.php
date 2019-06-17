<?php

function transform ($inText) {
    $outText = preg_split('//u', $inText);
    foreach ($outText as $key => $letter) {
        if ($letter === ' ') {
            $outText[$key] = '_';
        }
    }
    $outText = implode($outText);
    return $outText;
}

$text = 'шла маша по шоссе<br>';
?>

<h2>Текст:</h2>
<p><?= $text ?></p>
<h2>Перевод текста:</h2>
<p><?= transform($text) ?></p>