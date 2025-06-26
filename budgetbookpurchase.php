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
   $str = "<tr><td>{$title}</td><td>{$author}</td><td>{$kind}</td><td>{$price}</td></tr>" . $str;
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

$totalratio = round($totalPrice/12000,2);



$count0 = 0;
$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;
$count6 = 0;
$count7 = 0;
$count8 = 0;
$count9 = 0;


$csvFile = 'data/bookpurchacedlist.csv'; 

// CSVファイルを開く
if (($file = fopen($csvFile, 'r')) !== FALSE) {
    // CSVの各行を読み込む
    while (($line = fgetcsv($file)) !== FALSE) {
        $kind2 = $line[4]; 

        // 「0：総記」であるかチェック
        if ($kind2 === '0：総記') {
            $count0++; // カウントを増やす
        }elseif($kind2 === '1：哲学'){
            $count1++;
        }elseif($kind2 === '2：歴史'){
            $count2++;
        }elseif($kind2 === '3：社会科学'){
            $count3++;
        }elseif($kind2 === '4：自然科学'){
            $count4++;            
        }elseif($kind2 === '5：技術・工学'){
            $count5++;
        }elseif($kind2 === '6：産業'){
            $count6++;
        }elseif($kind2 === '7：芸術・美術'){
            $count7++;
        }elseif($kind2 === '8：言語'){
            $count8++;
        }elseif($kind2 === '9：文学'){
            $count9++;              
        }
    }
} 

$counttotal = $count0+$count1+$count2+$count3+$count4+$count5+$count6+$count7+$count8+$count9;

$ratio0 = round($count0/$counttotal*100,1);
$ratio1 = round($count1/$counttotal*100,1);
$ratio2 = round($count2/$counttotal*100,1);
$ratio3 = round($count3/$counttotal*100,1);
$ratio4 = round($count4/$counttotal*100,1);
$ratio5 = round($count5/$counttotal*100,1);
$ratio6 = round($count6/$counttotal*100,1);
$ratio7 = round($count7/$counttotal*100,1);
$ratio8 = round($count8/$counttotal*100,1);
$ratio9 = round($count9/$counttotal*100,1);



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
    
    <div id="purchaselist">
        <table>
          <thead>
            <tr>
              <th>書名</th>
              <th>著者名</th>
              <th>種類</th>
              <th id="price">価格</th>          
            </tr>
          </thead>
          <tbody>
            <?= $str ?> 
          </tbody>
        </table>
    </div>



<!-- ここから表で状況をまとめる -->

<!-- <p class="cluc">今年の予算：500,000円</p>
<p class="cluc">使用金額： <?= $totalPrice ?>  円</p>
<p class="cluc">使用率：</p>
<p class="cluc">種類別の内訳も</p> -->

<div id="table_container">
<table id="table_left">
  <tbody>
    <tr>
      <td>今年の購入額の合計</td>
      <td><?= $totalPrice ?>円</td>
      <td><?= $totalratio ?>%</td>
    </tr>
    <tr>
      <td>今年の予算額</td>
      <td>1200000円</td>
      <td></td>
    </tr>
  </tbody>
</table>

<table id="table_right">
  <thead>
    <tr>
      <th>分類</th>
      <th>冊数</th>
      <th>割合</th>
      <th>推奨割合</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>0：総記</td>
      <td><?= $count0 ?></td>
      <td><?= $ratio0 ?>%</td>
      <td>7%</td>
    </tr>
    <tr>
      <td>1：哲学</td>
      <td><?= $count1 ?></td>
      <td><?= $ratio1 ?>%</td>
      <td>7%</td>
    </tr>
    <tr>
      <td>2：歴史</td>
      <td><?= $count2 ?></td>
      <td><?= $ratio2 ?>%</td>
      <td>16%</td>
    </tr>
    <tr>
      <td>3：社会科学</td>
      <td><?= $count3 ?></td>
      <td><?= $ratio3 ?>%</td>
      <td>12%</td>
    </tr>
    <tr>
      <td>4：自然科学</td>
      <td><?= $count4 ?></td>
      <td><?= $ratio4 ?>%</td>
      <td>14%</td>
    </tr>
    <tr>
      <td>5：技術・工学</td>
      <td><?= $count5 ?></td>
      <td><?= $ratio5 ?>%</td>
      <td>6%</td>
    </tr>
    <tr>
      <td>6：産業</td>
      <td><?= $count6 ?></td>
      <td><?= $ratio6 ?>%</td>
      <td>4%</td>
    </tr>
    <tr>
      <td>7：芸術・美術</td>
      <td><?= $count7 ?></td>
      <td><?= $ratio7 ?>%</td>
      <td>8%</td>
    </tr>
    <tr>
      <td>8：言語</td>
      <td><?= $count8 ?></td>
      <td><?= $ratio8 ?>%</td>
      <td>7%</td>
    </tr>
    <tr>
      <td>9：文学</td>
      <td><?= $count9 ?></td>
      <td><?= $ratio9 ?>%</td>
      <td>19%</td>
    </tr>
  </tbody>
</table>


</div>




</body>
</html>
