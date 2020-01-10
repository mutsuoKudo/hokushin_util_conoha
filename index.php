<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ホクシンシステム便利サイト</title>
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

        <main id="main">

            <!-- ヘッダー -->

            <header id="header">

                <!-- <h1>こちらには、メインキーワードや紹介文を入れてください</h1> -->

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

            <article id="container">
                <section id="contents">

                    <section>




                        <!-- ３コンテンツ・ボックス ここから -->

                        <div class="box">

                            <div class="box1">
                                <p><img src="img/bounenkai.png" alt="bounenkai" ></p>
                                <p><span class="b_big">2018年 忘年会</span></p>
                            </div>

                            <div class="box2">
                                <p><img src="img/konshinkai.png" alt="konnsshinkai" ></p>
                                <p><span class="b_big">2018年 全社会＆懇親会</span></p>
                            </div>

                            <div class="box3">
                            <?php
                            include_once('lib/db_main.php');
                    
                            $db = new db;       
                            $query = "SELECT ";
                            $query = $query . "shain_birthday ";
                            $query = $query . ",shain_mei ";
                            $query = $query . ", CURDATE() As kyo ";
                            $query = $query . " FROM shain ";
                            $query = $query . " WHERE DATE_FORMAT(shain_birthday, '%m%d') = DATE_FORMAT(CURDATE(), '%m%d') ";
                            // $query = $query . " WHERE DATE_FORMAT(shain_birthday, '%m%d') = '0611'";
                                    // var_dump($query); 
                                 $shain = $db->get_all($query);
                                    // var_dump($shain); 
                                if(count($shain) != 0){
                                    print('<img src="img/birthday.jpg" alt="birthday" class="position" >');                              
                                 foreach ($shain as $row) {
                                     print('<div class= "box3_text">');                             
                                     print( $row['shain_mei']. 'さん');                              
                                     print('</br>');                                                        
                                     print('</div>');
                                    }
                                    print('<p><span class= "b_big">今日のお誕生日</span></p>');
                                }else{
                                    $time = intval(date('H') + 8);//取得する時間がずれているので+8してあります
                                    // var_dump($time);
                                    if (8 <= $time && $time <= 12) { // 8時～12時の時間帯のとき
                                    print('<img src="img/morning.png" alt="morning" class="position" >');
                                    } elseif (13 <= $time && $time <= 16) { // 13時～17時の時間帯のとき
                                        print('<img src="img/afternoon.png" alt="afternoon" class="position" >');
                                    } elseif (17 <= $time && $time <= 20) { // 17時～20時の時間帯のとき
                                        print('<img src="img/evening.png" alt="evening" class="position" >');
                                    } else{// それ以外の時間帯のとき 
                                        print('<img src="img/sleep.png" alt="sleep" class="position" >');
                                    }
                                }

                            ?>
                            </div>

                        </div>

                        <!-- ３コンテンツ・ボックス ここまで -->

                        <br>

                    </section>
                    <!-- <section>

                        <h2>天賦事務所からのごあいさつ</h2>


                        <p><span class="brown_big">キャッチコピーなどのお伝えしたい要約文を記載してください。</span></p>

                        <p><img class="picture" src="img/photo_01.jpg" alt="photo">
                            こちらには、本文を掲載し、下に見出しを追加して、本文を追加していってください。そして、サイト名を入力し、一番上の１行にはサイト紹介文を記載し、一番下のコピーライト部分にサイト名などを入れてください。</p>

                        <p>「 design by tempnate 」という当サイトの著作権テキストは削除しないで下さい。表示の削除をご希望される場合は <a href="http://tempnate.com/tinyd0+index.id+5.htm" rel="nofollow" target="_blank">著作権テキスト削除サービス</a>をご検討くださいませ。</p>

                        <p>また、トップページができ上がりましたら、「よくあるご質問ページ」など１つ１つページを複製して、ファイルの名前を「faq.html」などに変更してコンテンツを作成してください。<br class="clear"></p>

                        <hr class="line">

                        <p>&nbsp;</p>

                    </section>
                    <section>

                        <h2>お問い合わせはコチラ</h2>

                        <div class="gray_bg_contact">

                            <p><img src="img/icon.gif" alt="icon"> <b>電話番号</b>： <span class="red_b">00-0000-0000</span>　<img src="img/icon.gif" alt="icon"> 

                                <b>FAX</b>： <span class="red_b">00-0000-0000</span><br>
                                ご不明な点がございましたら、まずはお気軽にご相談下さい。<br>
                                <b><a href="contact.html">→メールでのお問い合わせ</a></b></p>

                        </div>

                        <hr class="line">

                        <p>&nbsp;</p> -->

                        <h2 class="page_title">最新情報＆更新情報</h2>

                        <div id="news">
                            <?php
                            include_once('lib/db_main.php');
                    
                            $db = new db;       
                            $query = "SELECT ";
                            $query = $query . "ixn.date AS date ";
                            $query = $query . ",ixn.news AS news ";
                            $query = $query . " FROM index_news ixn";
                            $query = $query . " ORDER BY ixn.date desc";
                            $query = $query . " LIMIT 8";

                            //  var_dump($query); 
                            $index_news = $db->get_all($query);
//  var_dump($index_news); 
                            foreach ($index_news as $row) {

                            print( $row['date'] . ':<a href="#">' . $row['news'] .'</a><br>');
                            print('<hr class="line">');
                            }
                            ?>

                            </div>


                        <p class="back"><a href="#header"><img class="scroll" src="img/pagetop.png" alt="ページトップに戻る"></a></p>

                    </section>
                </section>

                <!-- メインコンテンツ終わり -->

            </article>

            <!-- コンテンツ終わり -->

        </main>

        <!-- メイン終わり -->

        <!-- フッター -->
        <?php
        require('tpl/footer.php');
        ?>


        <!-- フッター終わり -->
    </body>
</html>
