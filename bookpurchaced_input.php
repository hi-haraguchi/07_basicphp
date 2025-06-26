<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者ページ（購入記録用）</title>
</head>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style3.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700&display=swap" rel="stylesheet">

<body>


  <h1>管理者用ページ（購入記録用）</h1>
  <p class="titledetail">入荷した本を入力してください。紹介の部分を入力したら <a href="bookrequest_user.php" target="_blank">利用者ページ</a>に記載されます。</p>
  <p class="titledetail"><a href="budgetbookpurchase.php" target="_blank">予算の状況についてはこちら</a></p>


<!-- 本のリクエストをuserが入力する部分 -->


  <form action="bookpurchaced_create.php" method="POST">
	   
      <div class="form-group">
        <label for="title">書名:</label> 
        <input type="text" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="author">著者名:</label> 
        <input type="text" id="author" name="author">
      </div>
      <div class="form-group">
        <label for="publishers">出版社:</label>
        <input type="text" id="publishers" name="publishers">
      </div>
      <div class="form-group">
        <label for="introduce">紹介:</label> 
        <textarea id="introduce" name="introduce" rows="4" cols="30"></textarea>
      </div>
      <div class="form-group">
          <label for="kind">種類:</label>
          <select id="kind" name="kind">
              <option value="">選択してください</option>
              <option value="0：総記">0：総記</option>
              <option value="1：哲学">1：哲学</option>
              <option value="2：歴史">2：歴史</option>
              <option value="3：社会科学">3：社会科学</option>
              <option value="4：自然科学">4：自然科学</option>
              <option value="5：技術・工学">5：技術・工学</option>
              <option value="6：産業">6：産業</option>
              <option value="7：芸術・美術">7：芸術・美術</option>
              <option value="8：言語">8：言語</option>
              <option value="9：文学">9：文学</option>
          </select>
      </div>
      <div class="form-group">
        <label for="isbn13">ISBN（13桁）:</label> 
        <input type="text" id="isbn13" name="isbn13">
      </div>
      <div class="form-group">
        <label for="price">価格:</label> 
        <input type="text" id="price" name="price">
      </div>  
      <div>
        <button type="submit">送信</button>
      </div>



</form>
