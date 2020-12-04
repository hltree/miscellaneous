# PHPでつくられたフォームのしくみ

例をWordPressであげます。

## 一般的なHTMLでつくられたフォーム

```
<form method="post" action="send.php">
    <input type="email" name="mail"/>
    <input type="password" name="password"/>
    <button type="submit">送信</button>
</form>
```

## WordPressでつくられたフォーム

```
<?php wp_nonce_field(); ?>
```

[wp_nonce_field()](https://wp-kama.com/function/wp_nonce_field)とかが多くに使われている

### 出力

```
<input type="hidden" id="_wpnonce" name="_wpnonce" value="5284708911" />
<input type="hidden" name="_wp_http_referer" value="/permalink" />
```

## Nonceって？

number used onceの略で使い切りの番号のこと

```
ナンス（ハッシュ）を作成し、フォームまたはアクションを介して送信し、
フォームデータを受け入れる前、またはアクションを実行する前に、ナンスを確認します。
```
