<?php

// 図書館の利用者が見る画面

// 利用者はリクエストを入力

// 別画面で、管理者がリクエストの回答を入力
// それを利用者側の画面に表示

// 別画面で、管理者が別で入荷情報などを入力
// それを利用者側の画面に表示


// // ここからリクエストの回答を読みだす処理

// データまとめ用の空文字変数
$str = '';

// ファイルを開く（読み取り専用）
$file = fopen('data/bookrequestreplylist_reply.csv', 'r');
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



// ここから入荷情報を読みだす処理（買った本にコメントがあるやつだけ抜き出したい）


// データまとめ用の空文字変数
$str2 = '';

// ファイルを開く（読み取り専用）
$file = fopen('data/bookpurchacedlist.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgetcsv()で1行ずつ取得
if ($file) {
  while ($line = fgetcsv($file)) { // CSVの各行を配列として取得
    // ここで特定の列をチェック（例: 2列目＝$line[1]に値があるか確認）
    if (!empty($line[3])) { // 空でない場合に処理を追加
      $str2 .= '<div class="eachintro">'; // 各データ全体を囲む<div>タグ
      $str2 .= '<img id="bookcover" alt="" src="https://ndlsearch.ndl.go.jp/thumbnail/' . $line[5] . '.jpg" class="imgsize">';
      $str2 .= '<p>' . $line[0] . '</p>';
      $str2 .= '<p>' . $line[1] . '</p>';
      $str2 .= '<p>' . $line[3] . '</p>';
      $str2 .= '</div>'; // div閉じタグ
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
  <title>図書館利用者ページ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>



  <!-- ここにもろもろシステムのタイトルの飾りを表示 -->
  <header>
    <h2><span><img src="./img/pilebooks.png" alt="books">
        <p class="header1">図書館利用者ページ</p>
        <p class="header2">～本のリクエスト・入荷情報～</p>
      </span></h2>
  </header>


  <!-- 本のリクエストをuserが入力する部分 -->

  <form action="bookrequest_create.php" method="POST">
    <p id="requestform_title">本のリクエストはここに入力してください</p>

    <div class="form-group">
      <label for="title">書名:</label>
      <input type="text" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="author">著者名:</label>
      <input type="text" id="author" name="author">
    </div>
    <div class="form-group">
      <label for="reason">理由やコメントを自由にどうぞ:</label>
      <textarea id="reason" name="reason" rows="4" cols="30"></textarea>
    </div>
    <div class="form-group">
      <label for="publishers">出版社（わかれば）:</label>
      <input type="text" id="publishers" name="publishers">
    </div>
    <div class="form-group">
      <label for="isbn13">ISBN13桁（わかれば）:</label>
      <input type="text" id="isbn13" name="isbn13">
    </div>
    <div class="form-group">
      <label for="price">価格（わかれば）:</label>
      <input type="text" id="price" name="price">
    </div>
    <div class="form-group">
      <label for="classandfullname">クラスと氏名:</label>
      <input type="text" id="classandfullname" name="classandfullname">
    </div>
    <p id="name_attention">※リクエストした人の名前は公開しませんが、確認が必要な場合がありますので入力ください</p>
    <div>
      <button type="submit">送信</button>
    </div>
  </form>




  <!-- 本のリクエストについて、管理者の回答を表示する部分 -->

  <div class="list">
    <p class="list_title">リクエストの返事です</p>
    <div id="reply_inner">
      <?= $str ?>
    </div>
  </div>



  <!-- 管理者が今月のおすすめを表示する部分 -->

  <div class="list">
    <p class="list_title">今月のおすすめの紹介です</p>
    <div id="recommend_inner">
        <?= $str2 ?>
    </div>
  </div>

  <p class="administratorlink"><a href="bookrequest_administrator.php" target="_blank">管理者ページ（返信用）</a></p>
  <p class="administratorlink"><a href="bookpurchaced_input.php" target="_blank">管理者ページ（購入用）</a></p>
</body>

</html>