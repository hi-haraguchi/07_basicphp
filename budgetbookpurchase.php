<?php
// データまとめ用の空文字変数
$str = '';

// ファイルを開く（読み取り専用）
$file = fopen('data/bookpurchacedlist.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgetcsv()で1行ずつ取得
if ($file) {
  while ($line = fgetcsv($file)) { // CSVの各行を配列として取得
    // 必要な項目だけを取り出す
    $title = htmlspecialchars($line[0], ENT_QUOTES, 'UTF-8');
    $author = htmlspecialchars($line[1], ENT_QUOTES, 'UTF-8');
    $kind = htmlspecialchars($line[4], ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($line[6], ENT_QUOTES, 'UTF-8');

    // 各項目をHTMLの行として追加
    $str .= "<tr><td>{$title}</td><td>{$author}</td><td>{$kind}</td><td>{$price}</td></tr>";
  }
}



// 合計を格納するための変数を初期化
$totalPrice = 0;

// ファイルを開く（読み取り専用）
$file = fopen('data/bookpurchacedlist.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgetcsv()で1行ずつ取得
if ($file) {
  while ($line = fgetcsv($file)) { // CSVの各行を配列として取得
    // 価格（6列目）の値が存在すれば加算
    if (!empty($line[6]) && is_numeric($line[6])) { // 数字チェックを追加
      $totalPrice += (float)$line[6]; // 数値として加算
    }
  }
}

// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);


?>







<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>購入一覧と予算管理</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style4.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>

  <h1>購入一覧と予算管理</h1>
  <p class="titledetail">購入した本が一覧で表示されます。購入した本の入力ページは<a href="bookpurchaced_input.php" target="_blank">こちら</a></p>


    <p class="header_detail">購入した本一覧</p>
    <table>
      <thead>
        <tr>
          <th>書名</th>
          <th>著者名</th>
          <th>種類</th>
          <th>価格</th>          
        </tr>
      </thead>
      <tbody>
        <?= $str ?> 
      </tbody>
    </table>


<p class="cluc">今年の予算：500,000円</p>
<p class="cluc">使用金額： <?= $totalPrice ?>  円</p>
<p class="cluc">使用率：</p>
<p class="cluc">種類別の内訳も</p>



</body>
</html>
