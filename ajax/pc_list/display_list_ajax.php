<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ＤＩＳＰＬＡＹリスト</title>
        <meta name="viewport" content="width=device-width">
        <meta name="keywords" content="キーワード">
        <meta name="description" content="紹介文">
        <link rel="stylesheet" href="../../css/sp.css">
        <link rel="stylesheet" href="../../css/pc.css">
        <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->
        <?php

        require('../../lib/jQueryadd.php');
        ?>
        <script><!--
            function chgpic_apear(pic_name) {
                    $('#phot1').css("visibility", "visible");
                    $('#r_photo').attr("src", pic_name);
            }
            function pic_hidden() {
                $('#phot1').css("visibility", "hidden");
                }
                /--></script>	
            <style>
                        <!-- 
                        form{
                            display:inline;
                        }
                        -->

                        .text-center{
                            text-align: center;
                        }
                    </style>
                </head>

                <body>

                    <?php
                    include_once('../../lib/db_main.php');
//全案件取得
                    $db = new db;
                    $query = "SELECT ";
                    $query = $query . "dl.serial_no AS serial_no ";
                    $query = $query . ",dl.id AS id ";
                    $query = $query . ",mk.name AS maker_name ";
                    $query = $query . ",dmd.name AS model_name ";
                    $query = $query . ",dmd.model_url AS model_url ";
                    $query = $query . ",dl.inch AS inch ";
                    $query = $query . ",kd.kaizoudo_shousai AS kaizoudo_sh ";
                    $query = $query . ",kd.kaizoudo AS kaizoudo ";
                    $query = $query . ",dl.vga AS vga ";
                    $query = $query . ",dl.dvi AS dvi";
                    $query = $query . ",dl.hdmi AS hdmi";
                    $query = $query . ",dl.displayport AS displayport";
                    $query = $query . ",dl.other AS other";
                    $query = $query . ",dl.speaker AS speaker";
                    $query = $query . ",dl.usb AS usb";
                    $query = $query . ",jt.name AS jt_name";
                    $query = $query . ",rm.short_name AS place ";
                    $query = $query . ",si.shain_mei AS employee";
                    $query = $query . ",si.pic AS pic ";
                    $query = $query . ",dl.konyubi AS b_ymd ";
                    $query = $query . ",dl.kakaku AS price ";
                    $query = $query . ",dl.unyo_kikan AS term ";
                    $query = $query . ",dl.biko AS biko ";

                    $query = $query . " FROM display_list dl";

                    $query = $query . " LEFT OUTER JOIN maker_tbl mk ON dl.maker_id = mk.id";
                    $query = $query . " LEFT OUTER JOIN display_model_tbl dmd ON dl.model_id = dmd.id";
                    $query = $query . " LEFT OUTER JOIN kaizoudo_tbl kd ON dl.kaizoudo_id = kd.id";
                    $query = $query . " LEFT OUTER JOIN jyotai_tbl jt ON dl.jyotai = jt.id";
                    $query = $query . " LEFT OUTER JOIN room_tbl rm ON dl.room_id = rm.id";
                    $query = $query . " LEFT OUTER JOIN shain si ON dl.user_id = si.shain_cd";
                    $query = $query . " ORDER BY dl.id";

                    /* var_dump($query); */
                    $display_list = $db->get_all($query);
                   /* var_dump($display_list[0]['id']); */

                    $i = 0;
                    print('<table class="pc_table">');
                    print('<tr>');
                    print('<th colspan="3" class="text-center top_cell_color1">識別情報</th>');
                    print('<th colspan="9" class="text-center top_cell_color2">ＨＷ/ＳＷ情報</th>');

                    print('<th colspan="7" class="text-center top_cell_color3">所在情報等<form action="display_list_print.php" target="_blank" method="get">
                    <input type="submit" value="印刷" onclick=\'return confirm("印刷用ページが表示されたら、\nブラウザの印刷ボタンで印刷してください。\n印刷が終了したら印刷用ページはブラウザで閉じて下さい。");\'></form></th>');

                    print('</tr>');
                    print('<tr class="middle_cell_color">');
                    print('<th class="text-center" width="100px">NO.</th>');
                    print('<th class="text-center" width="70px">ﾒｰｶｰ</th>');
                    print('<th class="text-center" width="80px">型番</th>');
                    print('<th class="text-center" width="50px">ｲﾝﾁ</th>');
                    print('<th class="text-center" width="60px">解像度</th>');
                    print('<th class="text-center" width="20px">VGA</th>');
                    print('<th class="text-center" width="20px">DVI</th>');
                    print('<th class="text-center" width="20px">HDMI</th>');
                    print('<th class="text-center" width="20px">Dp</th>');
                    print('<th class="text-center" width="50px">その他</th>');
                    print('<th class="text-center" width="60px">ｽﾋﾟｰｶｰ</th>');
                    print('<th class="text-center" width="30px">USB</th>');
                    print('<th class="text-center" width="40px">状態</th>');
                    print('<th class="text-center" width="70px">使用場所</th> ');
                    print('<th class="text-center" width="70px">使用者</th> ');
                    print('<th class="text-center" width="70px">購入日</th> ');
                    print('<th class="text-center" width="70px">価格</th> ');
                    print('<th class="text-center" width="70px">運用期間</th> ');
                    print('<th class="text-center" width="85px">備考</th> ');
                    print('</tr>');
                    foreach ($display_list as $row) {
                        /* var_dump($row); */
                        $i = $i + 1;
                        if ($i > 10) {
                            $i = 1;
                            print('<tr class="middle_cell_color">');
                    print('<th class="text-center" width="100px">NO.</th>');
                    print('<th class="text-center" width="70px">ﾒｰｶｰ</th>');
                    print('<th class="text-center" width="80px">型番</th>');
                    print('<th class="text-center" width="50px">ｲﾝﾁ</th>');
                    print('<th class="text-center" width="60px">解像度</th>');
                    print('<th class="text-center" width="20px">VGA</th>');
                    print('<th class="text-center" width="20px">DVI</th>');
                    print('<th class="text-center" width="20px">HDMI</th>');
                    print('<th class="text-center" width="40px">Dp</th>');
                    print('<th class="text-center" width="50px">その他</th>');
                    print('<th class="text-center" width="55px">ｽﾋﾟｰｶｰ</th>');
                    print('<th class="text-center" width="30px">USB</th>');
                    print('<th class="text-center" width="40px">状態</th>');
                    print('<th class="text-center" width="70px">使用場所</th> ');
                    print('<th class="text-center" width="70px">使用者</th> ');
                    print('<th class="text-center" width="70px">購入日</th> ');
                    print('<th class="text-center" width="70px">価格</th> ');
                    print('<th class="text-center" width="70px">運用期間</th> ');
                    print('<th class="text-center" width="85px">備考</th> ');
                    print('</tr>');
                        }

                        print('<tr>');
                        print('<td class="text-center" onclick="alert(\'serial no.=' . $row['serial_no'] . '\')">' . $row['id'] . '</td>');

                        print("<td class='text-center'>" . $row['maker_name'] . "</td>");

                        if ($row['model_name'] == "" || $row['model_url'] == "") {
                            print("<td class='text-center'>" . $row['model_name'] . "</td>");
                        } else {
                            print("<td class='text-center'><a href='" . $row['model_url'] . "' target=\'_blank\'>" . $row['model_name'] . "</a></td>");
                        }
                        print("<td class='text-center'>" . $row['inch'] . "ｲﾝﾁ</td>");
                        print('<td class="text-center" onclick="alert(\'解像度：' . $row['kaizoudo_sh'] . '\')">' . $row['kaizoudo'] . '</td>');
                        print("<td class='text-center'>" . $row['vga'] . "</td>");
                        print("<td class='text-center'>" . $row['dvi'] . "</td>");
                        print("<td class='text-center'>" . $row['hdmi'] . "</td>");
                        print("<td class='text-center'>" . $row['displayport'] . "</td>");
                        print("<td class='text-center'>" . $row['other'] . "</td>");
                        print("<td class='text-center'>" . $row['speaker'] . "</td>");
                        print("<td class='text-center'>" . $row['usb'] . "</td>");
                        if ($row['jt_name'] == "待機") {
                            print("<td class='text-center wait_bgcolor'>" . $row['jt_name'] . "</td>");
                        } else if ($row['jt_name'] == "故障") {
                            print("<td class='text-center broken_bgcolor'>" . $row['jt_name'] . "</td>");
                        } else {
                            print("<td class='text-center'>" . $row['jt_name'] . "</td>");
                        }
                        print("<td class='text-center'>" . $row['place'] . "</td>");
//                        print("<td onmouseover='pic_name=\"" . $row['pic'] . "\";chgpic_apear(pic_name);' onmouseout='pic_hidden()'>" . $row['employee'] . "</td>");
                        print("<td class='text-center'>" . $row['employee'] . "</td>");
                        print("<td class='text-center'>" . $row['b_ymd'] . "</td>");
                        print("<td class='text-center'>" . $row['price'] . "</td>");
                        print("<td class='text-center'>" . $row['term'] . "</td>");
                        if (strlen($row['biko']) > 21) {
                            $biko_comment = substr($row['biko'], 0, 21) . "･･･";
                        } else {
                            $biko_comment = $row['biko'];
                        }
                        print('<td class="text-center" onclick="alert(\'' . $row['biko'] . '\')">' . $biko_comment . '</td>');
//print('<td onclick="alert(\'serial no.=' . $row['serial_no'] . '\')">' . $row['id'] . '</td>');
                        print("</tr>\n");
                    }
//	mysql_free_result($res);
//
                    print("</table>");
//	$sql2 = "SELECT count(id) FROM pc_tbl";
//	$res2 = mysql_query( $sql2 );
//	$row2 = mysql_fetch_array( $res2 ); 	
////	print($row2[0]);
//	$youso = $row2[0];
                    ?>

<!--	<div style="position: relative; left:390px; top:-<?php print($youso * 26 + 174) ?>px; visibility:hidden;" id="phot1">
        <img src="" id="r_photo">
        </div>-->

                </body>
            </html>
