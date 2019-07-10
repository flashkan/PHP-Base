<?php

$query = "SELECT * FROM `img_base` ORDER BY `popularity` DESC;";
$result = mysqli_query(myDB_connect(), $query);

$employee = [];
while ($row = mysqli_fetch_assoc($result)) {
    $employee[] = $row;
}

function addImgs($dir, $excludeFiles = []) // обновление БД с картинками
{
    $array = isValid($dir, $excludeFiles);
    $imgArray = sortArray($array);
    request($imgArray);
}

function isValid($dir, $excludeFiles = []) // валедирование дерикторий с картинками.
    // отказался от рекурсии, так как php создавал на каждую папку свой массив.
    // print_r(array[1]) выдавал что это 2 стринговых значения. print_r(array) что это "array array array"
    // при этом не осознавал(php) этого, если я писал array[1] то мне выпадили данные сразу со всех "вложеных" массивов
    // с ключем [1]. По этому не получалось нормально вытащить из него данные.
{
    $array = [];
    $files = scandir($dir);
    $excludeFiles = array_merge(['.', '..'], $excludeFiles);
    foreach ($files as $file) {
        $currentDir = "$dir/$file";
        if (!in_array($file, $excludeFiles)) {

            if (is_dir($currentDir)) {
                foreach (scandir($currentDir) as $inDir) {
                    if (!in_array("$currentDir/$inDir", $excludeFiles)) {
                        if ("image/jpeg" == mime_content_type("$currentDir/$inDir")) {
                            $array[] = "$currentDir/$inDir";
                        }
                    }
                }
            }

            if ("image/jpeg" == mime_content_type($currentDir)) {
                $array[] = $file;
            }
        }
    }
    return $array;
}

function sortArray($array) // создание массива для отправки в БД
{
    $outArray = [];
    foreach ($array as $item) {
        if (preg_match("/full/", $item)) {
            preg_match("/\w*\.jpg/", $item, $return);
            $outArray[$return[0]] = $return;
            $outArray[$return[0]][1] = $item;
            $outArray[$return[0]][2] = filesize($item);
            $outArray[$return[0]][5] = 0;
        } else {
            preg_match("/\w*\.jpg/", $item, $return);
            foreach ($outArray as $key => $elem) {
                if ($key === $return[0]) {
                    $outArray[$key][3] = $item;
                    $outArray[$key][4] = filesize($item);
                }
            }
        }
    }
    return $outArray;
}

function request($imgArray) // отправка массива для формирования базы данных с картинками.
{
    $query = "DELETE FROM img_base;";
    foreach ($imgArray as $imgBase) {
        $str = "INSERT INTO `img_base` (`file_name`, `address_to_full`, `file_size_to_full`, `address_to_low`,
            `file_size_to_low`) VALUES ('$imgBase[0]', '$imgBase[1]', '$imgBase[2]', '$imgBase[3]', '$imgBase[4]');";
        $query .= $str;
    }
    mysqli_multi_query(myDB_connect(), $query);
}

if (isset ($_POST['btn'])) { // отлов запроса на обновление базы данных
    addImgs(IMG_DIR);
}