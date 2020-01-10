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

 $sql = 'SELECT COUNT(*) from dependent_info';
 $stmt = $dbh->query($sql);
 
 $st = $stmt->fetchColumn();
var_dump($st);
 $page = max($page, 1);
 $maxPage = ceil($st / 10);
 var_dump($maxPage);
 $page = min($page, $maxPage);
 $start = ($page - 1) * 10;

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
<title>扶養家族リスト</title>
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

$('.container').on('click', '.panel-heading span.filter', function(e){
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
    $query = $query . "dependent.id AS id, ";
    $query = $query . "dependent.shain_cd AS shain_cd, ";
    $query = $query . "dependent.name AS name, ";
    $query = $query . "dependent.name_kana AS name_kana, ";
    $query = $query . "dependent.gender AS gender, ";
    $query = $query . "dependent.birthday AS birthday, ";
    $query = $query . "dependent.haigusha AS haigusha, ";
    $query = $query . "dependent.kisonenkin_bango AS kisonenkin_bango, ";
    $query = $query . "dependent.shikakushutokubi AS shikakushutokubi ";

    $query = $query . " FROM dependent_info dependent";
    $query = $query . " ORDER BY dependent.id";
    $query = $query . " LIMIT " . $start . ",10" ;
    $dependent_info = $db->get_all($query);
?>  
<div class="container bottom13">
    <!-- <h1>Click the filter icon <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h1> -->
    <div class="custom-row height450">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel border-color-white">
                <div class="panel-heading bg-green text-white">
                    <h3 class="font-24"><span class="font-varela">扶養家族リスト</span></h3>
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
                    <thead>
                        <tr>
                            <th class="text-center" style="width:5%">id</th>
                            <th>社員コード</th>
                            <th>名前</th>
                            <th>名前（カナ）</th>
                            <th>性別</th>
                            <th>誕生日</th>
                            <th>配偶者</th>
                            <th>基礎年金番号</th>
                            <th>資格取得日</th>
                            <!-- <th class="col-md-2 text-center">id</th>
                            <th class="col-md-2">社員コード</th>
                            <th class="col-md-2">名前</th>
                            <th class="col-md-2">名前（カナ）</th>
                            <th class="col-md-2">性別</th>
                            <th class="col-md-2">誕生日</th>
                            <th class="col-md-2">配偶者</th>
                            <th class="col-md-2">基礎年金番号</th>
                            <th class="col-md-2">資格取得日</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($dependent_info as $row ) {
                        // var_dump($row);
                        print("<tr>");
                        print("<td class='text-center'>" . $row['id'] . "</td>");
                        print("<td>" . $row['shain_cd'] . "</td>");
                        print("<td>" . $row['name'] . "</td>");
                        print("<td>" . $row['name_kana'] . "</td>");
                        print("<td>" . $row['gender'] . "</td>");
                        print("<td>" . $row['birthday'] . "</td>");
                        print("<td class='text-center'>" . $row['haigusha'] . "</td>");
                        print("<td>" . $row['kisonenkin_bango'] . "</td>");
                        print("<td>" . $row['shikakushutokubi'] . "</td>");
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
                        <li class="page-item"><a href="dependent_info_view.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
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
                        <li class="page-item"><a href="dependent_info_view.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
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
<footer class="text-white bg-yellow footer-big">
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