<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>週報閲覧</title>
        <meta name="viewport" content="width=device-width">
        <meta name="keywords" content="キーワード">
        <meta name="description" content="紹介文">
        <link rel="stylesheet" href="./css/sp.css">
        <link rel="stylesheet" href="./css/pc.css">
        <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->

        <?php
        require('lib/jQueryadd.php');
        ?>

            <script>
            jQuery(document).ready(function ($) {
                    // ここでは、$はjQueryとして使えます。

                    $(function(){
                      var now = new Date();
                      var y = now.getFullYear();
                      var n = now.getMonth() +1;
                    var loadhtml = "ajax/report_list/report_list_ajax.php?shiteiyear=" + y + "&shiteimonth=" + n ;
                                $("#ajax2_1").load(loadhtml);	
                    });
                    $("#ajax1_1").click(
                            function () {
                                $("#ajax1_1").css("color", "olive");
                                // $("#ajax3").before("<p id='ajax2_1'></p>");
                      
                                var loadhtml = "ajax/report_list/report_list_ajax.php?shiteiyear=" + $("#shiteiyear").val() + "&shiteimonth=" + $("#shiteimonth").val();
                                $("#ajax2_1").load(loadhtml);
                                // $("#ajax2_1").load("ajax/report_list/report_list_ajax.php?shiteiyear=2019&shiteimonth=02")
                                
                            }
                            // function () {
                            //     $("#ajax1_1").css("color", "goldenrod");
                            //     $("#ajax2_1").remove();
                            // }
                    );    
                });

                $.fn.clickToggle = function (a, b) {
                    return this.each(function () {
                        var clicked = false;
                        $(this).on('click', function () {
                            clicked = !clicked;
                            if (clicked) {
                                return a.apply(this, arguments);
                            }
                            return b.apply(this, arguments);
                        });
                    });
                };
            </script>

    <style>
                     
                    #ajax1_1{
                        color:goldenrod;
                    }
                    #ajax2_1{
                    }	
                    #ajax3{
                    }			
                             
                </style>
              
      </head>
      
      <body>
        <!-- メイン -->
        <main id="main">
          
          <!-- ヘッダー -->
          <header id="header">
                        <div id="header_inner">
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
              <SECTION>
                <div id="pannavi">
                  <a href="index.php">HOME</a> &gt; 週報閲覧のページ
                </div>
                
                
                <!-- 週報リスト (takahashi) -->
                <h2 class="page_title">週報リスト</h2>


                <!-- 年数プルダウン -->
                　<select name="year_button" size="1" id="shiteiyear">
                      <option value="2015">2015年</option>
                    　<option value="2016">2016年</option>
                      <option value="2017">2017年</option>
                      <option value="2018">2018年</option>
                      <option value="2019" selected>2019年</option>
                      <option value="2020">2020年</option>
                    </select>


                    <!-- 月数プルダウン -->
                    <select name="month_button" size="1" id="shiteimonth">
                    <?php
                    for($m=1; $m<=12; $m++ ){
                      $today_month = date('n');
                      if($m==$today_month){
                        printf('<option value=%d selected>%d月</option>',$m,$m);
                      }else
                        printf('<option value=%d>%d月</option>',$m,$m);
                    }
                    ?>
                    </select>
                    
                    <button class="pclist_button pclist_button_color1" id="ajax1_1">表示</button>

                    <p id="ajax2">
                    <p id='ajax2_1'>



                    </p>
                    </p>             
                    <p class="line" id="ajax3"></p>  


              </section>
              
              <section>
              
                <hr class="line">     
                <p class="back"><a href="#header"><img class="scroll" src="img/pagetop.png" alt="ページトップに戻る"></a></p>

                <br>

              </SECTION>
            </section>
            <!-- メインコンテンツ終わり -->
            
          </article>
          <!-- コンテンツ終わり -->

          <!-- フッター -->
          <?php
          require('tpl/footer.php');
          ?>
          <!-- フッター終わり -->
        
        </main>
        <!-- メイン終わり -->

      </body>
    </html>
