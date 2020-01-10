<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>週報リスト</title>
        <meta name="viewport" content="width=device-width">
        <meta name="keywords" content="キーワード">
        <meta name="description" content="紹介文">
        <link rel="stylesheet" href="../../css/sp.css">
        <link rel="stylesheet" href="../../css/pc.css">
        <style>
            td a{
                display:block;
                width:100%;
                height:100%;
                text-decoration: none;
            }
        </style>
            
        <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->

        <?php
        //var_dump('shiteiyear:');
       //var_dump($_GET['shiteiyear']);
       //var_dump('shiteimonth:');
      // var_dump($_GET['shiteimonth']);
        require('../../lib/jQueryadd.php');
        ?>
        <script>
            function chgpic_apear(pic_name) {
                    $('#phot1').css("visibility", "visible");
                    $('#r_photo').attr("src", pic_name);
            }
            function pic_hidden() {
                $('#phot1').css("visibility", "hidden");
                }

                        function win_open_add() {
                            window.open("report_list_ajax.php","",""); 
                        }

                        function win_open_delete() {
                            window.open("information.php","",""); 
                        }

                
                </script>	
            <style>
                        
                        form{
                            display:inline;
                        }
                        
                        td a{
                            display:block;
                            width:100%;
                            height:100%;
                            text-decoration: none;
                        }
                        a:hover {
                            background-color: turquoise;
                        }

                        .bg-edit{
                            background-color: gainsboro !important;
                        }
                    </style>
    </head>

    <body>

<?php



// 今日の日付 フォーマット　例）2018-07
//$today = date('Y-m');

$today = $_GET['shiteiyear'] . '-' . $_GET['shiteimonth'];

// 前月・次月の年月を取得
// 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
// $prev = date('Y-n', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$prev1 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])-1, 1, date($_GET['shiteiyear'])));
$prev2 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])-2, 1, date($_GET['shiteiyear'])));
$prev3 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])-3, 1, date($_GET['shiteiyear'])));
$prev4 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])-4, 1, date($_GET['shiteiyear'])));
$prev5 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])-5, 1, date($_GET['shiteiyear'])));
$prev6 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])-6, 1, date($_GET['shiteiyear'])));

// $next = date('Y-n', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
$next1 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])+1, 1, date($_GET['shiteiyear'])));
$next2 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])+2, 1, date($_GET['shiteiyear'])));
$next3 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])+3, 1, date($_GET['shiteiyear'])));
$next4 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])+4, 1, date($_GET['shiteiyear'])));
$next5 = date('Y-n', mktime(0, 0, 0, date($_GET['shiteimonth'])+5, 1, date($_GET['shiteiyear'])));


include_once('../../lib/db_main.php');

//全案件取得
$db = new db;
$query = "SELECT ";
$query = $query . "si.shain_mei AS name ";
$query = $query . ",si.shain_cd AS shain_cd ";
$query = $query . " FROM shain si";
$query = $query . " WHERE si.department = 4
                    AND taishokubi IS NULL OR taishokubi = 0000-00-00";
$query = $query . " ORDER BY si.shain_cd";

//var_dump($query);
$shain = $db->get_all($query);
//var_dump($shain[0]['shain_cd']);

$i = 0;

print('<table class="report_table">');

print('<tr class="middle_cell_color">');
print('<th class="top_cell_color1" width="90px">名前</th>');


print('<th width="60px">' . $prev6 . '</th>');
print('<th width="60px">' . $prev5 . '</th>');
print('<th width="60px">' . $prev4 . '</th>');
print('<th width="60px">' . $prev3 . '</th>');
print('<th width="60px">' . $prev2 . '</th>');
print('<th width="60px">' . $prev1 . '</th>');
print('<th width="70px" class ="today" >' . $today . '</th>');
print('<th width="60px">' . $next1 . '</th>');
print('<th width="60px">' . $next2 . '</th>');
print('<th width="60px">' . $next3 . '</th>');
print('<th width="60px">' . $next4 . '</th>');
print('<th width="60px">' . $next5 . '</th>');
print('</tr>'); 


foreach ($shain as $row) {
   //var_dump($row);
    $i = $i + 1;
    if ($i > 15) {
        $i = 1;

print('<tr class="middle_cell_color">');
print('<th class="top_cell_color1" width="90px">名前</th>');

print('<th width="60px">' . $prev6 . '</th>');
print('<th width="60px">' . $prev5 . '</th>');
print('<th width="60px">' . $prev4 . '</th>');
print('<th width="60px">' . $prev3 . '</th>');
print('<th width="60px">' . $prev2 . '</th>');
print('<th width="60px">' . $prev1 . '</th>');
print('<th width="70px" class ="today" >' . $today . '</th>');
print('<th width="60px">' . $next1 . '</th>');
print('<th width="60px">' . $next2 . '</th>');
print('<th width="60px">' . $next3 . '</th>');
print('<th width="60px">' . $next4 . '</th>');
print('<th width="60px">' . $next5 . '</th>');
}
    print('</tr>');

    print('<td onclick="alert(\'shain_cd.=' . $row['shain_cd'] . '\')">' . $row['name'] . '</td>');



    /* 週報リンク（1～12月）ファイルがhokushin_utilにあるとき */
    
        /* ファイル名は【社員コード_日付.png】　ex 高橋かなん2019年1月提出のファイル　2018100031-2019-1.pdf　*/
     $report_name = $row['shain_cd'] .'-'.  $prev6 . '.pdf';
     $shain_cd = $row['shain_cd'];
     if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    } 

    $report_name = $row['shain_cd'] .'-'.  $prev5 . '.pdf';  
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $prev4 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $prev3 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $prev2 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $prev1 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $today . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $next1 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $next2 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $next3 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $next4 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }

    $report_name = $row['shain_cd'] .'-'.  $next5 . '.pdf';
    $shain_cd = $row['shain_cd'];
    if(file_exists('report/' . $row['shain_cd'] . '/' . $report_name)){
    print("<td class='bg-edit'><a href='/hokushin_uti_conoha/ajax/report_list/report/$shain_cd/$report_name' target='_blank'>○</a></td>");
    }else{
        print("<td>-</td>");
    }
       
}


print("</table>");
?>


</body>
</html>

