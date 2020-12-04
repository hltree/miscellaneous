<?php
session_start();

if (
    ($_POST['mail'] && $_POST['password']) &&
    ($_POST['guard'] && $_SESSION['guard'] === $_POST['guard'])
) {
    $db = fopen(__DIR__ . '/fake_db.csv', 'a');
    fputcsv($db, [$_POST['mail'], $_POST['password']]);
    fclose($db);

    echo "成功した\n";
    var_dump($_POST);
} else {
    file_put_contents(__DIR__ . '/error.log', "errorだ！\n",  FILE_APPEND);
    echo "失敗した\n";
    var_dump($_POST);
}
