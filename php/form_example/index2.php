<?php
session_start();

$guard = hash('sha256', 'Formをまもりたい');

if (isset($_SESSION['guard'])) {
    unset($_SESSION['guard']);
}
$_SESSION['guard'] = $guard;
?>
<head>
    <title>PHPでつくるフォーム</title>
</head>
<body>
<h2>会員登録</h2>
<p>メールアドレスとパスワードを入力して送信してください</p>
<form method="post" action="send2.php">
    <input type="hidden" name="guard" value="<?= $guard ?>" />
    <input type="email" name="mail"/>
    <input type="password" name="password"/>
    <button type="submit">送信</button>
</form>
</body>
