関数　・・・　関数名を呼び出して実行できる名前付きの命令文の集合のこと
引数　・・・　関数に与える値のこと

<?php
// 引数を取らない

function page_header() {
    print '<html><head><title>Welcome to my site</title></head>';
    print '<body bgcolor="#ffffff">';
}

// 実行
page_header();

// 引数を取る

function page_header2($color) {
    print '<html><head><title>Welcome to my site</title></head>';
    print '<body bgcolor="#' . $color . '">';
}

page_header2('cc00cc');

?>
