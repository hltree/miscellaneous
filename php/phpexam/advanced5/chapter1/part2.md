# 字句構造

## 大文字・小文字

ユーザが定義したクラスや関数の名前、echoやwhile、classといった組み込みのキーワードの名前では、大文字/小文字が区別されません。

echo("hello") / ECHO("hello") / EchO("hello")

は全て同じ結果を返す。

変数名は大文字・小文字が区別される。

$name / $NAME / $NaMe

はすべて異なる変数を表す。

## 命令文とセミコロン

命令文とは、何らかの処理を行うPHPコードをまとめたもの。

命令文の区切り文字として、セミコロン（;）を使用する。
条件分やループのように波かっこ（{}）を使用してコード群をまとめた複合文では、閉じ波かっこの後のセミコロンは不要。

PHPの場合、終了タグ直前以外はセミコロンを省略できない。

## 空白と改行

空白文字はPHPのプログラムに影響を及ぼさない。

## コメント

```
# ・・・行末まであるいはPHPコードブロックの最後までをコメントにする
// ・・・ 行末まであるいはPHPコードブロックの最後までをコメントにする
/* */ ・・・ /*から*/までを全てコメントにする。よって、複数行にまたがってコメントアウトができる。これはPHPコードの間にHTMLが入っていようとコメントとする
```

## リテラル

プログラム内でそのままの形で現れるデータのこと。

2001 / 0xFF / 1.423 / null / true / false

## 識別子

要するに名前のこと。
変数名や関数名、定数名、クラス名として識別子を使用する。

識別子の最初の文字として利用できるのは、

アルファベットの大文字・小文字 / _ / ASCIIコードで0x7Fから0xFFまでの文字のいずれか

2文字目以降には、上記に加えて0 ~ 9 の数字も使用できる。

## 変数名

必ず$で始まり、大文字・小文字が区別される。

$bill / $head_count / $MAX_COUNT / $_This

は有効。

$not valid / $| / $1234aaa

は無効。

## 関数名

大文字・小文字は区別されない。

## クラス名

大文字・小文字は区別されない。

stdClass という名前のクラスはシステムに予約されているので、使用できない。

## 定数

単純な値を保持する識別子のこと。

定数として利用できる値は

スカラー値（論理値・整数・浮動小数点・文字列）

のみ。一度定数の値を設定すると、後から変更はできない。
定数の値を取得するには識別子を使用し、値を設定するにはdefine()関数を使用する。

```
define('PUBLISHER', 'OReilly & Associates');
echo PUBLISHER;
```

## キーワード

大文字・小文字は区別されない。

予約語ともいう。PHP言語自体の機能を実現するために予約されている単語のこと。
変数や関数、クラス、定数の名前として、これらのキーワードは使えない。

```
__CLASS__ / __DIR__ / __FILE__ / __FUNCTION__ / __LINE__ / __METHOD__ /
__NAMESPACE__ / __TRAIT__ / __halt_compiler() / abstract / and / array() /
as / break / callable / case / catch / class / clone / const / continue /
declare / default / die() / do / echo / else / elseif / empty() / enddeclare /
endfor / endforeach / endif / endswitch / endwhile / eval() / exit() / extends /
final / for / foreach / function / global / goto / if / implements / include /
include_once / instanceof / insteadof / interface / isset() / list() / namespace /
new / or / print / private / protected / public / require / require_once /
return / static / switch / throw / trait / try / unset() / use / var / while / xor
``` 

PHPの組み込み関数と同じ名前の識別子を使うこともできない。


# データ型

## 整数

整数型は1, 12, 256といった数値を扱う型。

一般的には「-2,147,483,648」から「+2,147,483,648」まで。
