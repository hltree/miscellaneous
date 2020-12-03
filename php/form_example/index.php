<head>
    <title>PHPでつくるフォーム</title>
</head>
<body>
<h2>会員登録</h2>
<p>メールアドレスとパスワードを入力して送信してください</p>
<form method="post" action="send.php">
    <input type="email" name="mail"/>
    <input type="password" name="password"/>
    <button type="submit">送信</button>
</form>
</body>
