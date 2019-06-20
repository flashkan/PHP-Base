<?php
function gallery($url)
{
    $imgs = scandir($url);
    $regexp = "/.*.jpg/";
    $mainImgs = [];
    $date = "- date " . date("F j, Y, G:i\r\n");
    foreach ($imgs as $img) {
        if (preg_match($regexp, IMG_DIR . $img)) {
            file_put_contents('log.txt', "\"$img\" - " . filesize(__DIR__ . IMG_DIR . $img)
                . " bits $date", FILE_APPEND);
            $mainImgs[] = $img;
        } else {
            file_put_contents('log.txt', "Error: file \"$img\" invalid $date", FILE_APPEND);
        }
    }
    return $mainImgs;
}

function numbering ($number) {
    $name = str_split($number);
    return $name[0];
}
