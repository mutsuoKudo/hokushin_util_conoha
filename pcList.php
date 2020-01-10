<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ＰＣリスト</title>
    <meta name="viewport" content="width=device-width">
    <meta name="keywords" content="キーワード">
    <meta name="description" content="紹介文">
    <link rel="stylesheet" href="css/sp.css">
    <link rel="stylesheet" href="css/pc.css">
    <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->
    <?php
    require('lib/jQueryadd.php');
    ?>

    <script>
        jQuery(document).ready(function($) {
            // ここでは、$はjQueryとして使えます。	
            $("#ajax1_1").clickToggle(
                function() {
                    $("#ajax1_1").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_1'></p>");
                    $("#ajax2_1").load("ajax/pc_list/pc_list_ajax.php?shiteiroom=全部&shiteinumber=");

                },
                function() {
                    $("#ajax1_1").css("color", "goldenrod");
                    $("#ajax2_1").remove();
                }
            );
            $("#ajax1_2").clickToggle(
                function() {
                    $("#ajax1_2").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_2'></p>");
                    $("#ajax2_2").load("ajax/pc_list/pc_list_ajax.php?shiteiroom=管理部&shiteinumber=02")
                },
                function() {
                    $("#ajax1_2").css("color", "goldenrod");
                    $("#ajax2_2").remove();
                }
            );
            $("#ajax1_3").clickToggle(
                function() {
                    $("#ajax1_3").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_3'></p>");
                    $("#ajax2_3").load("ajax/pc_list/pc_list_ajax.php?shiteiroom=営業部&shiteinumber=03")
                },
                function() {
                    $("#ajax1_3").css("color", "goldenrod");
                    $("#ajax2_3").remove();
                }
            );
            $("#ajax1_4").clickToggle(
                function() {
                    $("#ajax1_4").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_4'></p>");
                    $("#ajax2_4").load("ajax/pc_list/pc_list_ajax.php?shiteiroom=システム開発部&shiteinumber=04")
                },
                function() {
                    $("#ajax1_4").css("color", "goldenrod");
                    $("#ajax2_4").remove();
                }
            );
            $("#ajax1_5").clickToggle(
                function() {
                    $("#ajax1_5").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_5'></p>");
                    $("#ajax2_5").load("ajax/pc_list/pc_list_ajax.php?shiteiroom=研修者&shiteinumber=05")
                },
                function() {
                    $("#ajax1_5").css("color", "goldenrod");
                    $("#ajax2_5").remove();
                }
            );
            $("#ajax1_6").clickToggle(
                function() {
                    $("#ajax1_6").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_6'></p>");
                    $("#ajax2_6").load("ajax/pc_list/pc_list_ajax.php?shiteiroom=持ち出し&shiteinumber=06")
                },
                function() {
                    $("#ajax1_6").css("color", "goldenrod");
                    $("#ajax2_6").remove();
                }
            );
            $("#ajax1_7").clickToggle(
                function() {
                    $("#ajax1_7").css("color", "olive");
                    $("#ajax3").before("<p id='ajax2_7'></p>");
                    $("#ajax2_7").load("ajax/pc_list/display_list_ajax.php?shiteiroom=ディスプレイ&shiteinumber=07")
                },
                function() {
                    $("#ajax1_7").css("color", "goldenrod");
                    $("#ajax2_7").remove();
                }
            );
        });
        $.fn.clickToggle = function(a, b) {
            return this.each(function() {
                var clicked = false;
                $(this).on('click', function() {
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
        #ajax1_1 {
            color: goldenrod;
        }

        #ajax1_2 {
            color: goldenrod;
        }

        #ajax1_3 {
            color: goldenrod;
        }

        #ajax1_4 {
            color: goldenrod;
        }

        #ajax1_5 {
            color: goldenrod;
        }

        #ajax1_6 {
            color: goldenrod;
        }

        #ajax1_7 {
            color: goldenrod;
        }

        #ajax2_1 {}

        #ajax2_2 {}

        #ajax2_3 {}

        #ajax2_4 {}

        #ajax2_5 {}

        #ajax2_6 {}

        #ajax2_7 {}

        #ajax3 {}

        -->
    </style>
</head>

<body>

    <!-- メイン -->

    <main id="main">


        <!-- ヘッダー -->

        <header id="header">
            <div id="header_inner">
                <div id="h_info">
                    <img src="img/tel_img.png" alt="information">
                </div>
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
                                <a href="index.php">HOME</a> &gt; PCリストのページ
                            </div>

                            <!-- PCリスト (takahashi) -->

                            <h2 class="page_title">PCリスト</h2>

                            <div>
                                <button class="pclist_button" id="ajax1_1">全部</button>
                                <button class="pclist_button" id="ajax1_2">管理部</button>
                                <button class="pclist_button" id="ajax1_3">営業部</button>
                                <button class="pclist_button" id="ajax1_4">システム開発部</button>
                                <button class="pclist_button" id="ajax1_5">研修生</button>
                                <button class="pclist_button" id="ajax1_6">持ち出し</button>
                                <button class="pclist_button" id="ajax1_7">ディスプレイ</button>
                            </div>


                            <p id="ajax2"></p>

                            <hr class="line" id="ajax3">

                        </SECTION>

                        <section>

                            <h2 class="page_title">最新情報＆更新情報</h2>
                            <div id="news">
                                <?php
                                include_once('lib/db_main.php');

                                $db = new db;
                                $query = "SELECT ";
                                $query = $query . "plk.kousinbi AS kousinbi ";
                                $query = $query . ",plk.naiyou AS naiyou ";
                                $query = $query . " FROM pc_list_koshin plk";
                                $query = $query . " ORDER BY plk.kousinbi desc";
                                $query = $query . " LIMIT 8";

                                /* var_dump($query); */
                                $pc_list_koushin = $db->get_all($query);
                                /* var_dump($pc_list_koushin); */
                                foreach ($pc_list_koushin as $row) {

                                    print($row['kousinbi'] . ':<a href="#">' . $row['naiyou'] . '</a><br>');
                                    print('<hr class="line">');
                                }
                                ?>

                            </div>

                            <hr class="line">

                            <p class="back"><a href="#header"><img class="scroll" src="img/pagetop.png" alt="ページトップに戻る"></a></p>

                            <br>

                        </section>
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