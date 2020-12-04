<?php

if ($_POST['mail'] && $_POST['password']) {
    $db = fopen(__DIR__ . '/fake_db.csv', 'a');
    fputcsv($db, [$_POST['mail'], $_POST['password']]);
    fclose($db);

    echo "成功した\n";
    var_dump($_POST);
} else {
    echo "失敗した\n";
    var_dump($_POST);
}
