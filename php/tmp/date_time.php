<?php

$today = new DateTimeImmutable();
$year = $today->format('Y');

$pass = [
    '01-01' => '1/1 ~ 2/4',
    '02-05' => '2/5 ~ 3/20',
    '03-21' => '3/21 ~ 4/19',
    '04-20' => '4/20 ~ 9/22',
    '09-23' => '9/23 ~ 12/6',
    '12-07' => '12/7 ~ 12/31'
];

$prev = array_key_first($pass);
$pass = array_reverse($pass);

foreach ($pass as $p => $v) {
    $d1 = new DateTimeImmutable($year . '-' . $p);
    $d2 = new DateTimeImmutable($year . '-' . $prev);
    $diff = $d1->diff($d2);
    $modify = $today->modify($diff->format('%R%a').'days');
    if ($modify->format('m.d')) {
        echo 'u';
    }

    $prev = $p;
}
