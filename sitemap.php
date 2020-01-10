<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ホームページ・タイトル</title>
<meta name="viewport" content="width=device-width">
<meta name="keywords" content="キーワード">
<meta name="description" content="紹介文">
<link rel="stylesheet" href="css/sp.css">
<link rel="stylesheet" href="css/pc.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script src="js/css3-mediaqueries.js"></script>
<![endif]-->

</head>

<body>

<!-- メイン -->

<div id="main">


<!-- ヘッダー -->

<header id="header">


  <div id="header_inner">
   <!-- <div id="h_logo"><h2><a href="index.html"><img src="img/logo.png" alt="サイト・タイトル"></a></h2></div> -->
   <div id="h_info"><img src="img/tel_img.png" alt="information"></div>
  </div>

</header>

<?php
require('tpl/header-menu.php');
?>



<!-- メイン画像 ここから -->
<div id="header-img">
<img src="img/head_img_slim.png" alt="head_img_slim" class="main_photo">
</div>
<!-- メイン画像 ここまで -->




<!-- ヘッダー終わり -->


<!-- コンテンツ -->

<!-- メインコンテンツ -->

<div id="container">
  <div id="contents">


<div id="pannavi">
<a href="index.php">HOME</a> &gt; サイトマップ
</div>




<h2 class="page_title">サイトマップ - メインメニュー</h2>

<p>
<img src="img/icon.gif" alt="icon"> <a href="index.php">ホーム</a><br>
<img src="img/icon.gif" alt="icon"> <a href="pcList.php">PCリスト</a><br>
<img src="img/icon.gif" alt="icon"> <a href="information.php">週報閲覧</a><br>
<img src="img/icon.gif" alt="icon"> <a href="profile.php">営業案件管理</a><br>
<img src="img/icon.gif" alt="icon"> <a href="faq.php">求人情報管理</a><br>
<img src="img/icon.gif" alt="icon"> <a href="contact.php">SES・派遣先管理</a><br>
<img src="img/icon.gif" alt="icon"> <a href="link.php">リンク</a><br>
<img src="img/icon.gif" alt="icon"> <a href="sitemap.php">サイトマップ</a><br>
</p>

<hr class="line">

<p>&nbsp;</p>







<!-- <h2>お問い合わせはコチラ</h2>

<div class="gray_bg_contact">

<p><img src="img/icon.gif" alt="icon"> <b>電話番号</b>： <span class="red_b">00-0000-0000</span>　<img src="img/icon.gif" alt="icon"> <b>FAX</b>： <span class="red_b">00-0000-0000</span><br>
ご不明な点がございましたら、まずはお気軽にご相談下さい。<br>
<b><a href="contact.html">→メールでのお問い合わせ</a></b></p>

</div>






<hr class="line"> -->

<p class="back"><a href="#header"><img class="scroll" src="img/pagetop.png" alt="ページトップに戻る"></a></p>

<br>


  </div>

<!-- メインコンテンツ終わり -->

</div>

<!-- コンテンツ終わり -->

<!-- フッター -->

<?php
require('tpl/footer.php');
?>

<!-- フッター終わり -->

</div>

<!-- メイン終わり -->

</body>
</html>
