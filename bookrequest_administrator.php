<?php
// データまとめ用の空文字変数
$str = '';

// ファイルを開く（読み取り専用）
$file = fopen('data/bookrequestlist_user.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgetcsv()で1行ずつ取得
if ($file) {
  while ($line = fgetcsv($file)) { // CSVの各行を配列として取得
    $str .= '<div class="eachrequest">'; // 各データ全体を囲む<div>タグ
    foreach ($line as $cell) {
      $str .= '<p>' . htmlspecialchars($cell, ENT_QUOTES, 'UTF-8') . '</p>'; // 各項目を<p>タグで囲む
    }
    $str .= '</div>'; // div閉じタグ
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
  <title>管理者ページ（返信用）</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style2.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>

  <h1>管理者用ページ（返信用）</h1>
  <p id="titledetail">利用者が入力した内容の一覧が表示されていますので、確認しながら返信の作成をお願いします。</p>



  <div class="list">
    <p class="header_title">リクエスト一覧</p>
    <div class="request_container">
      <?= $str ?>
    </div>
  </div>


  <form action="bookrequestreply_create.php" method="POST">
    <p class="header_title">リクエストの返信を入力してください</p>

    <div class="form-group">
      <label for="title">書名:</label>
      <input type="text" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="author">著者名:</label>
      <input type="text" id="author" name="author">
    </div>
    <div class="form-group">
      <label for="reason">リクエスト詳細:</label>
      <textarea id="reason" name="reason" rows="4" cols="30"></textarea>
    </div>
    <div class="form-group">
      <label for="reply">図書館職員からの返事:</label>
      <textarea id="reply" name="reply" rows="4" cols="30"></textarea>
    </div>
    <div>
      <button type="submit">送信</button>
    </div>
  </form>


  <p class="administratorlink"><a href="bookrequest_user.php" target="_blank">利用者ページ</a></p>
  <p class="administratorlink"><a href="bookpurchaced_input.php" target="_blank">購入用ページ</a></p>

</body>

</html>