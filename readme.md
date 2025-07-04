# 図書館管理サイト　～利用者からのリクエストと管理者の購入管理～

## 制作サイトの説明

図書館利用者の本のリクエストについて

- リクエスト
- その返信
- 返信内容の閲覧

をサイト上でできるようにしました。

また入荷した本の情報について、利用者の閲覧、管理者の予算管理ができる機能も追加しました。

### 機能について

- 利用者のリクエスト入力

  利用者ページで、本のリクエストを入力します。それを管理者ページ ① で一覧表示させます。

- 管理者の返信入力

  管理者ページ ① で、リクエストの返信をします。上記の機能で表示したリクエスト一覧をもとに作成します。
  （うまく連動させたかったですが、コピペして利用することを想定）

  返信内容は、利用者ページで一覧表示させます。

- 購入した本の入力

  管理者ページ ② で、購入した本の内容を入力します。

  入力した本の情報は予算管理ページで一覧表示されます。
  
  また、購入した本のうち紹介文を入力した本は「おススメの本」として、利用者ページに一覧で表示されます。（ＡＰＩで書影を取得）

- 予算管理

  購入した本の一覧とその合計金額、予算の執行状況を確認できます。
  また本の分類ごとにカウントし、推奨される本の割合（小説は ○○％など）があるそうで、それをめざせるようにしました

## 工夫した点・こだわった点

実際の管理者側では

- 購入した本の紹介（毎月発行する図書館新聞）
- 予算管理（自前の Excel）
- リクエストの返事（紙に手書き、入荷したかどうかの情報）

をそれぞれで記入や入力をしていたので、そこをひとつにまとめられたのは、コンセプトとしてはうまくできたと感じています。

また、「利用者ページ」に利用者が使用しそうなもの（入力や閲覧機能）をかためたのも工夫したところです。

そして入力・csv 作成・表示の流れを３回行うことができたのも、php の操作を基本的な流れを習得できてよかったと感じています。

## 難しかった点・次回トライしたこと

データを一覧表示するデザインが難しかったです。現状は羅列するだけになってしまいました。
スマホなどで利用することも想定しているので、「多くのデータを」「見やすく」表示する手法を考えていきたいです。

また情報の修正や更新作業の機能を実装できませんでした。（CSV を直接いじればいいかとも思ってしまったり…）
データベースについて学んでいく中でデータ更新の機能も上手く利用したいです。

## 備考（感想、シェアしたいこと等なんでも）

図書館の管理システムについて、やっていることはすぐイメージできたので、すぐできるだろうと思っていた自分を殴りたいです。

なにげなく使っている、既存のシステムの作り込まれ具合に驚き、モノづくりの大変さと作られた商品の偉大さを実感する今日この頃です。
