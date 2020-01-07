<?php

$text1 = 'text1';
$text2 = 'text2';

// false
if (strcmp($text1, $text2) > 0) {
    echo 'true';
} else {
    echo 'false';
}

echo '<br />';

$intandstr = '2txt';
$strandint = 'txt2';

if ($intandstr > $strandint) {
    echo 'true';
} else {
    echo 'false';
}

echo '<br />';

$intstr = '66px';
$intstr2 = '7px';
if ($intstr > $intstr2) {
    echo 'true';
} else {
    echo 'false';
}

echo '<br />';

$int = '16';
$intstr = '15px';

if ($int > $intstr) {
    echo 'true' . PHP_EOL;
} else {
    echo 'false' . PHP_EOL;
}
if (strcmp($int, $intstr) > 0) {
    echo strcmp($int, $intstr) . PHP_EOL;
    echo strcmp($int, $int) . PHP_EOL;
    echo 'true';
} else {
    echo 'false';
}
