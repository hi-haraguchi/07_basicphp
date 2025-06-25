<?php
// まず var_dump で中身を確認（デバッグ時に使用）
// var_dump($_POST);
// exit();

// データの受け取り
$title = $_POST["title"];
$author = $_POST["author"];
$reason = $_POST["reason"];
$publishers = $_POST["publishers"];
$isbn13 = $_POST["isbn13"];
$price = $_POST["price"];
$classandfullname = $_POST["classandfullname"];

// データをCSV形式にまとめる（カンマ区切り）
$write_data = "{$title},{$author},{$reason},{$publishers},{$isbn13},{$price},{$classandfullname}\n";

// CSVファイルを開く（追記モード 'a' を指定）
$file = fopen('data/bookrequestlist_user.csv', 'a');

// ファイルをロックする
flock($file, LOCK_EX);

// データを書き込む
fwrite($file, $write_data);

// ファイルのロックを解除する
flock($file, LOCK_UN);

// ファイルを閉じる
fclose($file);

// 完了後、入力ページにリダイレクト
header("Location:bookrequest_user.php");
exit();
?>
