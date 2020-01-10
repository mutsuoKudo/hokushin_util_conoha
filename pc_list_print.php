<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ＰＣリスト　プリント用</title>
        <meta name="viewport" content="width=device-width">
        <meta name="keywords" content="キーワード">
        <meta name="description" content="紹介文">
        <link rel="stylesheet" href="css/sp.css">
        <link rel="stylesheet" href="css/pc.css">
        <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->

        <style>
        .biko {
                max-width: 105px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                }
        </style>

    
    </head>
    <body link="#99CCFF" alink="#9900FF" vlink="#FF9900">

        <h2 align='center' style='color:#ff6347;'>ホクシンシステム　ＰＣリスト（<?php print($_GET["shiteiroom"]); ?>）</h2>


        <?php
        include_once('lib/db_main.php');

        //全案件取得
        $db = new db;
        $query = "SELECT ";
        $query = $query . "pl.serial_no AS serial_no ";
        $query = $query . ",pl.id AS id ";
        $query = $query . ",mk.name AS maker_name ";
        $query = $query . ",md.name AS model_name ";
        $query = $query . ",md.model_url AS model_url ";
        $query = $query . ",pr.ryaku AS pr_name ";
        $query = $query . ",pl.memori AS memory ";
        $query = $query . ",os.name AS os_name ";
        $query = $query . ",of.name AS of_name ";
        $query = $query . ",jt.name AS jt_name ";
        $query = $query . ",rm.short_name AS place ";
        $query = $query . ",si.shain_mei AS employee ";
        $query = $query . ",si.pic AS pic ";
        $query = $query . ",pl.konyubi AS b_ymd ";
        $query = $query . ",pl.kakaku AS price ";
        $query = $query . ",pl.unyo_kikan AS term ";
        $query = $query . ",pl.biko AS biko ";
        $query = $query . " FROM pc_list pl";
        $query = $query . " LEFT OUTER JOIN maker_tbl mk ON pl.maker_id = mk.id";
        $query = $query . " LEFT OUTER JOIN model_tbl md ON pl.model_id = md.id";
        $query = $query . " LEFT OUTER JOIN processor_tbl pr ON pl.processor_id = pr.id";
        $query = $query . " LEFT OUTER JOIN os_tbl os ON pl.os_id = os.id";
        $query = $query . " LEFT OUTER JOIN office_tbl of ON pl.office_id = of.id";
        $query = $query . " LEFT OUTER JOIN jyotai_tbl jt ON pl.jyotai = jt.id";
        $query = $query . " LEFT OUTER JOIN room_tbl rm ON pl.room_id = rm.id";
        $query = $query . " LEFT OUTER JOIN shain si ON pl.user_id = si.shain_cd";
        if($_GET['shiteiroom'] != "全部"){
        $query = $query . " WHERE si.department = " . $_GET['shiteinumber'];
        }
        $query = $query . " ORDER BY pl.id";

        $pc_list = $db->get_all($query);

        $i = 0;
        print('<div align="center">');
        print('<table class="pc_table">');
        print('<tr>');
        print('<th colspan="3" class="top_cell_color1">識別情報</th>');
        print(' <th colspan="4" class="top_cell_color2">ＨＷ/ＳＷ情報</th>');

        print('<th colspan="7" class="top_cell_color3">所在情報等</th>');

        print('</tr>');
        print('<tr align="center" class="middle_cell_color">');
        print('<th width="120x">NO.</th>');
        print('<th width="80px">ﾒｰｶｰ</th>');
        print('<th width="70px">型番</th>');
        print('<th width="70px">CPU</th>');
        print('<th width="48px">ﾒﾓﾘ</th>');
        print('<th width="75px">OS</th>');
        print('<th width="80px">ｵﾌｨｽ</th>');
        print('<th width="50px">状態</th>');
        print('<th width="75px">使用場所</th>');
        print('<th width="100px">使用者</th>');
        print('<th width="70px">購入日</th>');
        print('<th width="70px">価格</th>');
        print('<th width="90px">運用期間</th>');
        print('<th width="200px">備考</th> ');
        print('</tr>');
        foreach ($pc_list as $row) {
//                        var_dump($row);
            $i = $i + 1;
            if ($i > 10) {
                $i = 1;
                print('<tr align="center" class="middle_cell_color">');
                print('<th width="120px">NO.</th>');
                print('<th width="80px">ﾒｰｶｰ</th>');
                print('<th width="70px">型番</th>');
                print('<th width="70px">CPU</th>');
                print('<th width="48px">ﾒﾓﾘ</th>');
                print('<th width="75px">OS</th>');
                print('<th width="80px">ｵﾌｨｽ</th>');
                print('<th width="50px">状態</th>');
                print('<th width="75px">使用場所</th>');
                print('<th width="100px">使用者</th>');
                print('<th width="70px">購入日</th>');
                print('<th width="70px">価格</th>');
                print('<th width="90px">運用期間</th>');
                print('<th width="200px">備考</th> ');
                print('</tr>');
            }

            print('<tr align="center">');
            print('<td onclick="alert(\'serial no.=' . $row['serial_no'] . '\')">' . $row['id'] . '</td>');

            print("<td >" . $row['maker_name'] . "</td>");
            if ($row['model_name'] == "" || $row['model_url'] == "") {
                print("<td >" . $row['model_name'] . "</td>");
            } else {
                print("<td ><a href='" . $row['model_url'] . "' target=\'_blank\'>" . $row['model_name'] . "</a></td>");
            }
            print("<td>" . $row['pr_name'] . "</td>");
            print("<td>" . $row['memory'] . "GB</td>");
            print("<td>" . $row['os_name'] . "</td>");
            print("<td>" . $row['of_name'] . "</td>");
            if ($row['jt_name'] == "待機") {
                print("<td class='wait_bgcolor'>" . $row['jt_name'] . "</td>");
            } else if ($row['jt_name'] == "故障") {
                print("<td class='broken_bgcolor'>" . $row['jt_name'] . "</td>");
            } else if ($row['jt_name'] == "貸出") {
                print("<td class='rental_bgcolor'>" . $row['jt_name'] . "</td>");
            } else {
                print("<td>" . $row['jt_name'] . "</td>");
            }
            print("<td>" . $row['place'] . "</td>");
//                        print("<td onmouseover='pic_name=\"" . $row['pic'] . "\";chgpic_apear(pic_name);' onmouseout='pic_hidden()'>" . $row['employee'] . "</td>");
            print("<td>" . $row['employee'] . "</td>");
            print("<td>" . $row['b_ymd'] . "</td>");
            print("<td>" . $row['price'] . "</td>");
            print("<td>" . $row['term'] . "</td>");
            // if (strlen($row['biko']) > 32) {
            //     $biko_comment = substr($row['biko'], 0, 32) . "･･･";
            // } else {
            //     $biko_comment = $row['biko'];
            // }
            // print('<td onclick="alert(\'' . $row['biko'] . '\')">' . $biko_comment . '</td>');
            print('<td class="biko" onclick="alert(\'' . $row['biko'] . '\')">' . $row['biko'] . '</td>');
//print('<td onclick="alert(\'serial no.=' . $row['serial_no'] . '\')">' . $row['id'] . '</td>');
            print("</tr>\n");
        }
//	mysql_free_result($res);
//
        print("</table>");
        print('</div>');
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

