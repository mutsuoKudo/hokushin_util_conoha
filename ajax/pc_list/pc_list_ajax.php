<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ＰＣリスト</title>
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
//        var_dump($_GET['shiteiroom']);
//        var_dump($_GET['shiteinumber']);
        require('../../lib/jQueryadd.php');
        ?>
        <script>
            function chgpic_apear(pic_name) {
//            alert(pic_name);
                $('#phot1').css("visibility", "visible");
                $('#r_photo').attr("src", pic_name);
            }
            function pic_hidden() {
                $('#phot1').css("visibility", "hidden");
                $('#r_photo').attr("src", "");
            }
        </script>	
        <style>
            <!-- 
            form{
                display:inline;
            }
            -->

            .text-center{
                text-align: center;
            }
            .biko {
                max-width: 105px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                }
        </style>
    </head>

    <body>
        <?php
        include_once('../../lib/db_main.php');
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
        if ($_GET['shiteiroom'] != "全部") {
            $query = $query . " WHERE si.department = " . $_GET['shiteinumber'];
        }
        $query = $query . " ORDER BY pl.id";

        //var_dump($query);
        $pc_list = $db->get_all($query);
        //var_dump($pc_list[0]['id']);

        $i = 0;
        print('<table class="pc_table">');
        print('<tr>');
        print('<th colspan="3" class="top_cell_color1 text-center">識別情報</th>');
        print('<th colspan="4" class="top_cell_color2 text-center">ＨＷ/ＳＷ情報</th>');

        print('<th colspan="7" class="top_cell_color3 text-center">所在情報等<form action="pc_list_print.php" target="_blank" method="get">
                    <input type="hidden" name="shiteinumber" value="' . $_GET["shiteinumber"] . '">
                    <input type="hidden" name="shiteiroom" value="' . $_GET["shiteiroom"] . '">
                    <input type="submit" value="印刷" onclick=\'return confirm("印刷用ページが表示されたら、\nブラウザの印刷ボタンで印刷してください。\n印刷が終了したら印刷用ページはブラウザで閉じて下さい。");\'></form></th>');

        print('</tr>');
        print('<tr class="middle_cell_color">');
        print('<th class="text-center" width="100px">NO.</th>');
        print('<th class="text-center" width="80px">ﾒｰｶｰ</th>');
        print('<th class="text-center" width="70px">型番</th>');
        print('<th class="text-center" width="75px">CPU</th>');
        print('<th class="text-center" width="40px">ﾒﾓﾘ</th>');
        print('<th class="text-center" width="75px">OS</th>');
        print('<th class="text-center" width="80px">ｵﾌｨｽ</th>');
        print('<th class="text-center" width="50px">状態</th>');
        print('<th class="text-center" width="75px">使用場所</th>');
        print('<th class="text-center" width="80px">使用者</th>');
        print('<th class="text-center" width="70px">購入日</th>');
        print('<th class="text-center" width="55px">価格</th>');
        print('<th class="text-center" width="65px">運用期間</th>');
        print('<th class="text-center" width="105px">備考</th> ');
        print('</tr>');
        foreach ($pc_list as $row) {
//                        var_dump($row);
            $i = $i + 1;
            if ($i > 10) {
                $i = 1;
                print('<tr class="middle_cell_color">');
                print('<th class="text-center" width="100px">NO.</th>');
                print('<th class="text-center" width="80px">ﾒｰｶｰ</th>');
                print('<th class="text-center" width="70px">型番</th>');
                print('<th class="text-center" width="75px">CPU</th>');
                print('<th class="text-center" width="40px">ﾒﾓﾘ</th>');
                print('<th class="text-center" width="75px">OS</th>');
                print('<th class="text-center" width="80px">ｵﾌｨｽ</th>');
                print('<th class="text-center" width="50px">状態</th>');
                print('<th class="text-center" width="75px">使用場所</th>');
                print('<th class="text-center" width="80px">使用者</th>');
                print('<th class="text-center" width="70px">購入日</th>');
                print('<th class="text-center" width="55px">価格</th>');
                print('<th class="text-center" width="65px">運用期間</th>');
                print('<th class="text-center" width="105px">備考</th> ');
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
            print("<td class='text-center'>" . $row['pr_name'] . "</td>");
            print("<td class='text-center'>" . $row['memory'] . "GB</td>");
            print("<td class='text-center'>" . $row['os_name'] . "</td>");
            print("<td class='text-center'>" . $row['of_name'] . "</td>");
            if ($row['jt_name'] == "待機") {
                print("<td class='text-center wait_bgcolor'>" . $row['jt_name'] . "</td>");
            } else if ($row['jt_name'] == "故障") {
                print("<td class='text-center broken_bgcolor'>" . $row['jt_name'] . "</td>");
            } else if ($row['jt_name'] == "貸出") {
                print("<td class='text-center rental_bgcolor'>" . $row['jt_name'] . "</td>");
            } else {
                print("<td class='text-center'>" . $row['jt_name'] . "</td>");
            }
            print("<td class='text-center'>" . $row['place'] . "</td>");
            print("<td class='text-center' onmousedown='chgpic_apear(\"" . $row['pic'] . "\");' onmouseout='pic_hidden()'>" . $row['employee'] . "</td>");
//                        print("<td>" . $row['employee'] . "</td>");
            print("<td class='text-center'>" . $row['b_ymd'] . "</td>");
            print("<td class='text-center'>" . $row['price'] . "</td>");
            print("<td class='text-center'>" . $row['term'] . "</td>");
            // if (strlen($row['biko']) >= 13) {
            //     $biko_comment = substr($row['biko'], 0, 13) . "･･･";
            // } else {
            //     $biko_comment = $row['biko'];
            // }
            // print('<div class="bikobiko">');
            print('<td class="text-center biko" style=" word-break: break-all;" onclick="alert(\'' . $row['biko'] . '\')">' . $row['biko'] . '</td>');
            // print('</div>');
            print("</tr>\n");
        }
        print("</table>");
        ?>

        <div style="position: relative; left:550px; top:0; visibility:hidden;padding-top:10px" id="phot1">
            <img src="" width="80" id="r_photo">
        </div>

    </body>
</html>
