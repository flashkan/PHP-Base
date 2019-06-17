<?php

function translator($inText)
{
    $letters = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'i',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'kh',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shch',
        'ы' => 'y',
        'ъ' => 'ie',
        'э' => 'e',
        'ю' => 'iu',
        'я' => 'ia',
    ];

    $outText = preg_split('//u', mb_strtolower($inText));
    foreach ($letters as $letterCyr => $letterLat) {
        foreach ($outText as $key => $letter) {
            if ($letter === $letterCyr) {
                $outText[$key] = $letterLat;
            };
        }
    }
    $outText = implode($outText);
    return $outText;
}

$text = 'Шла Маша по шоссе<br>';
?>

<h2>Текст:</h2>
<p><?= $text ?></p>
<h2>Перевод текста:</h2>
<p><?= translator($text) ?></p>
