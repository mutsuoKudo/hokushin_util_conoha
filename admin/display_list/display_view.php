<!-- bootstrapCSS3　※index.phpは4なのでCSS注意 -->

<!-- ページャー -->
<!-- <?php
 include_once('../../lib/db_main.php');

 $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $page = 1;
 // var_dump($_GET['page']);
 if (isset($_GET['page'])) {
     $page = $_GET['page'];
 }

 $sql = 'SELECT COUNT(*) from display_list';
 $stmt = $dbh->query($sql);
 
 $st = $stmt->fetchColumn();
var_dump($st);
 $page = max($page, 1);
 $maxPage = ceil($st / 8);
 var_dump($maxPage);
 $page = min($page, $maxPage);
 $start = ($page - 1) * 8;

?> -->


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<link rel="stylesheet" href="../admin_tbl.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<title>ディスプレイの種類</title>

<script>
/**
*   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
*   but will likely encounter performance issues on larger tables.
*
*		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
*		$(input-element).filterTable()
*		
*	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
*/
(function(){
'use strict';
var $ = jQuery;
$.fn.extend({
    filterTable: function(){
        return this.each(function(){
            $(this).on('keyup', function(e){
                $('.filterTable_no_results').remove();
                var $this = $(this), 
                    search = $this.val().toLowerCase(), 
                    target = $this.attr('data-filters'), 
                    $target = $(target), 
                    $rows = $target.find('tbody tr');
                    
                if(search == '') {
                    $rows.show(); 
                } else {
                    $rows.each(function(){
                        var $this = $(this);
                        $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                    })
                    if($target.find('tbody tr:visible').size() === 0) {
                        var col_count = $target.find('tr').first().find('td').size();
                        var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
                        $target.find('tbody').append(no_results);
                    }
                }
            });
        });
    }
});
$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
// attach table filter plugin to inputs
$('[data-action="filter"]').filterTable();

$('.custom-container').on('click', '.panel-heading span.filter', function(e){
    var $this = $(this), 
        $panel = $this.parents('.panel');
    
    $panel.find('.panel-body').slideToggle();
    if($this.css('display') != 'none') {
        $panel.find('.panel-body input').focus();
    }
});
$('[data-toggle="tooltip"]').tooltip();
})
</script>
</head>
<body>

<?php
    include_once('../../lib/db_main.php');

    //データ取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "dl.id AS id ";
    $query = $query . ",dl.maker_id AS maker_id ";
    $query = $query . ",dl.model_id AS model_id ";
    $query = $query . ",dl.inch AS inch ";
    $query = $query . ",dl.kaizoudo_id AS kaizoudo_id ";
    $query = $query . ",dl.vga AS vga ";
    $query = $query . ",dl.dvi AS dvi ";
    $query = $query . ",dl.hdmi AS hdmi ";
    $query = $query . ",dl.displayport AS displayport ";
    $query = $query . ",dl.other AS other ";
    $query = $query . ",dl.speaker AS speaker ";
    $query = $query . ",dl.usb AS usb ";
    $query = $query . ",dl.jyotai AS jyotai ";
    $query = $query . ",dl.room_id AS room_id ";
    $query = $query . ",dl.user_id AS user_id ";
    $query = $query . ",dl.konyubi AS konyubi ";
    $query = $query . ",dl.kakaku AS kakaku ";
    $query = $query . ",dl.unyo_kikan AS unyo_kikan ";
    $query = $query . ",dl.biko AS biko ";
    $query = $query . ",dl.serial_no AS serial_no ";

    // $query = $query . ",mkt.name AS maker_name ";
    // $query = $query . ",mdt.name AS model_name ";
    // $query = $query . ",kzt.kaizoudo AS kaizoudo_name ";
    // $query = $query . ",jtt.name AS jyotai_name ";
    // $query = $query . ",rmt.name AS room_name ";
    // $query = $query . ",sh.shain_mei AS shain_name ";

    
    $query = $query . " FROM display_list dl";
    // $query = $query . " LEFT OUTER JOIN maker_tbl mkt ON dl.maker_id = mkt.id";
    // $query = $query . " LEFT OUTER JOIN model_tbl mdt ON dl.model_id = mdt.id";
    // $query = $query . " LEFT OUTER JOIN kaizoudo_tbl kzt ON dl.kaizoudo_id = kzt.id";
    // $query = $query . " LEFT OUTER JOIN jyotai_tbl jtt ON dl.jyotai = jtt.id";
    // $query = $query . " LEFT OUTER JOIN room_tbl rmt ON dl.room_id = rmt.id";
    // $query = $query . " LEFT OUTER JOIN shain sh ON dl.user_id = sh.shain_cd";
    $query = $query . " ORDER BY dl.id";
    $query = $query . " LIMIT " . $start . ",8" ;
    // var_dump($query);
    $display_list = $db->get_all($query);
    //var_dump($processor_tbl[0]['id']);
    
?>  
<div class="custom-container bottom13" style="margin:0 auto">
    <div class="custom-row-big height600">
        <div class="padding-left50">
            <div class="panel border-color-white width1200">
                <div class="panel-heading bg-green text-white">
                    <h3 class="font-24"><span class="font-varela">ディスプレイの種類</span></h3>
                    <div class="pull-right">
                        <span class="clickable filter" data-toggle="tooltip" title="Search Filter" data-container="body">
                            <i class="glyphicon glyphicon-filter" class="text-white"></i>
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Filter" />
                </div>
                <table class="table table-hover" id="dev-table">
                    <thead >
                        <tr>
                            <th class="text-center" style="width:90px">id</th>
                            <th class="text-center" style="width:40px">ﾒｰ<br>ｶｰ</th>
                            <th class="text-center" style="width:40px">ﾓﾃﾞﾙ</th>
                            <th class="text-center" style="width:45px">ｲﾝﾁ</th>
                            <th class="text-center" style="width:40px">解像度</th>
                            <th class="text-center" style="width:40px">vga</th>
                            <th class="text-center" style="width:40px">dvi</th>
                            <th class="text-center" style="width:40px">hd<br>mi</th>
                            <th class="text-center" style="width:40px">Dp</th>
                            <th class="text-center" style="width:50px">その他</th>
                            <th class="text-center" style="width:40px">ｽﾋﾟｰｶｰ</th>
                            <th class="text-center" style="width:40px">USB</th>
                            <th class="text-center" style="width:40px">状態</th>
                            <th class="text-center" style="width:40px">使用場所</th>
                            <th class="text-center" style="width:105px">ﾕｰｻﾞｰ</th>
                            <th class="text-center" style="width:100px">購入日</th>
                            <th class="text-center" style="width:65px">価格</th>
                            <th class="text-center" style="width:95px">運用期間</th>
                            <th class="text-center" style="width:80px">備考</th>
                            <th class="text-center" style="width:130px">ｼﾘｱﾙNO.</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($display_list as $row ) {
                        // var_dump($row);
                        print("<tr>");
                        print("<td class='text-center'>" . $row['id'] . "</td>");
                        print("<td class='text-center'>" . $row['maker_id'] . "</td>");
                        print("<td class='text-center'>" . $row['model_id'] . "</td>");
                        print("<td class='text-center'>" . $row['inch'] . "</td>");
                        print("<td class='text-center'>" . $row['kaizoudo_id'] . "</td>");
                        print("<td class='text-center'>" . $row['vga'] . "</td>");
                        print("<td class='text-center'>" . $row['dvi'] . "</td>");
                        print("<td class='text-center'>" . $row['hdmi'] . "</td>");
                        print("<td class='text-center'>" . $row['displayport'] . "</td>");
                        print("<td>" . $row['other'] . "</td>");
                        print("<td class='text-center'>" . $row['speaker'] . "</td>");
                        print("<td class='text-center'>" . $row['usb'] . "</td>");
                        print("<td class='text-center'>" . $row['jyotai'] . "</td>");
                        print("<td>" . $row['room_id'] . "</td>");
                        print("<td class='text-center' style='word-break:break-all'>" . $row['user_id'] . "</td>");
                        print("<td class='text-center'>" . $row['konyubi'] . "</td>");
                        print("<td class='text-center'>" . $row['kakaku'] . "</td>");
                        print("<td>" . $row['unyo_kikan'] . "</td>");
                        print("<td>" . $row['biko'] . "</td>");
                        print("<td style='word-break:break-all'>" . $row['serial_no'] . "</td>");
                        print("</tr>");
                    }
                    ?>
                    </tbody>
                </table>
                 <!-- ページャー -->
                <div class="clearfix">
                    <ul class="pagination">
                    <?php
                    if ($page > 1) {
                        ?>
                        <li class="page-item"><a href="processor_tbl_view.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
                        <?php
                    } else {
                        ?>
                        <!-- 前のページ -->
                        <?php
                    }
                    ?>

                    <?php
                    if ($page < $maxPage) {
                        ?>　　
                        <li class="page-item"><a href="processor_tbl_view.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
                        <?php
                    } else {
                        ?>
                        <!-- 次のページ -->
                        <?php
                    }
                    ?>
                        <li class="page-item"><a href=""><?php print($page . '/' . $maxPage); ?></a></li>
                    </ul>
                </div>		
            </div>
        </div>
    </div>
</div>
<!-- フッター -->
<footer class="text-white bg-yellow footer">
    <div class="container">
        <p class="float-right" class="text-white">
            <a href="#" class="text-white">ページ上部へ</a>
            <br>
            <a href="../index.php" class="text-white">HOMEにもどる</a>
        </p>
    </div>
</footer>
</body>
</html>