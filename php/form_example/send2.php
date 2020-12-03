<?php
session_start();

if ($_POST['guard'] && $_SESSION['guard'] === $_POST['guard']) {
    $db = fopen(__DIR__ . '/fake_db.csv', 'a');
    fputcsv($db, [$_POST['mail'], $_POST['password']]);
    fclose($db);
} else {
    file_put_contents(__DIR__ . '/error.log', 'errorだ！');
}
