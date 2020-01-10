<!-- bootstrapCSS3　※index.phpは4なのでCSS注意 -->

<!-- <?php
        include_once('../../lib/db_main.php');

        $dbh = new PDO(DB_HOST, DB_USER, DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $page = 1;
        // var_dump($_GET['page']);
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        // $sql = 'DELETE FROM shain;
        // INSERT into hokushin_util.shain (shain_cd,shain_mei,shain_mei_kana,shain_mei_romaji,shain_mail,gender,shain_birthday,nyushabi,tensekibi,taishokubi,department,remarks) SELECT shain_cd,shain_mei,shain_mei_kana,shain_mei_romaji,shain_mail,gender,shain_birthday,nyushabi,tensekibi,taishokubi,department,remarks from employees.employees;
        // SELECT COUNT(*) from shain';
        $sql = 'SELECT COUNT(*) from shain WHERE taishokubi IS NULL OR taishokubi = 0000-00-00';

        $file = 'C:\Users\user\Desktop\shain_view_CHECK.txt';
        // ファイルをオープンして既存のコンテンツを取得します
        $current = file_get_contents($file);
        // 新しい人物をファイルに追加します
        $current .= $sql;
        // 結果をファイルに書き出します
        file_put_contents($file, $current);

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
    <title>社員情報</title>

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
        (function() {
            'use strict';
            var $ = jQuery;
            $.fn.extend({
                filterTable: function() {
                    return this.each(function() {
                        $(this).on('keyup', function(e) {
                            $('.filterTable_no_results').remove();
                            var $this = $(this),
                                search = $this.val().toLowerCase(),
                                target = $this.attr('data-filters'),
                                $target = $(target),
                                $rows = $target.find('tbody tr');

                            if (search == '') {
                                $rows.show();
                            } else {
                                $rows.each(function() {
                                    var $this = $(this);
                                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                })
                                if ($target.find('tbody tr:visible').size() === 0) {
                                    var col_count = $target.find('tr').first().find('td').size();
                                    var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                    $target.find('tbody').append(no_results);
                                }
                            }
                        });
                    });
                }
            });
            $('[data-action="filter"]').filterTable();
        })(jQuery);

        $(function() {
            // attach table filter plugin to inputs
            $('[data-action="filter"]').filterTable();

            $('.custom-container').on('click', '.panel-heading span.filter', function(e) {
                var $this = $(this),
                    $panel = $this.parents('.panel');

                $panel.find('.panel-body').slideToggle();
                if ($this.css('display') != 'none') {
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

    $db->shain_update();

    $query = " SELECT ";
    $query = $query . "sh.shain_cd AS id ";
    $query = $query . ",sh.shain_mei AS name ";
    $query = $query . ",sh.shain_mei_kana AS kana ";
    $query = $query . ",sh.shain_mei_romaji AS romaji ";
    $query = $query . ",sh.shain_mail AS mail ";
    $query = $query . ",sh.gender AS gender ";
    $query = $query . ",sh.shain_birthday AS birthday ";
    $query = $query . ",sh.nyushabi AS nyushabi ";
    $query = $query . ",sh.tensekibi AS tensekibi ";
    $query = $query . ",sh.taishokubi AS taishokubi ";
    $query = $query . ",sh.department AS department ";
    // $query = $query . ",sh.pic AS pic ";
    $query = $query . ",sh.remarks AS remarks ";
    $query = $query . " FROM shain sh";
    $query = $query . " WHERE taishokubi IS NULL OR taishokubi = 0000-00-00";
    $query = $query . " ORDER BY sh.shain_cd";
    $query = $query . " LIMIT " . $start . ",8";
    $shain = $db->get_all($query);
    // var_dump($query);
    // var_dump($shain);

    //var_dump($processor_tbl[0]['id']);

    ?>
    <div class="custom-container bottom13" style="margin:0 auto">
        <div class="custom-row-big height600">
            <div class="padding-left50">
                <div class="panel border-color-white width1200">
                    <div class="panel-heading bg-green text-white">
                        <h3 class="font-24"><span class="font-varela">社員情報</span></h3>
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
                                <th class="text-center" style="width:110px">id</th>
                                <th class="text-center" style="width:100px">名前</th>
                                <th class="text-center" style="width:160px">ｶﾅ</th>
                                <th class="text-center" style="width:150px">ﾛｰﾏ字</th>
                                <th class="text-center" style="width:120px">ﾒｰﾙ</th>
                                <th class="text-center" style="width:50px">性別</th>
                                <th class="text-center" style="width:70px">生年<br>月日</th>
                                <th class="text-center" style="width:70px">入社日</th>
                                <th class="text-center" style="width:70px">転籍日</th>
                                <th class="text-center" style="width:70px">退職日</th>
                                <th class="text-center" style="width:50px">部門</th>
                                <!-- <th class="text-center" style="width:75px">写真</th> -->
                                <th class="text-center" style="width:105px">備考</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($shain as $row) {
                                // var_dump($shain);
                                print("<tr>");
                                print("<td class='text-center' style='word-break:break-all'>" . $row['id'] . "</td>");
                                print("<td class='text-center'>" . $row['name'] . "</td>");
                                print("<td class='text-center'>" . $row['kana'] . "</td>");
                                print("<td class='text-center'>" . $row['romaji'] . "</td>");
                                print("<td class='text-center' style='word-break:break-all'>" . $row['mail'] . "</td>");
                                print("<td class='text-center'>" . $row['gender'] . "</td>");
                                print("<td class='text-center'>" . $row['birthday'] . "</td>");
                                print("<td class='text-center'>" . $row['nyushabi'] . "</td>");
                                print("<td class='text-center'>" . $row['tensekibi'] . "</td>");
                                print("<td class='text-center'>" . $row['taishokubi'] . "</td>");
                                print("<td class='text-center'>" . $row['department'] . "</td>");
                                // print("<td class='text-center'>" . $row['pic'] . "</td>");
                                print("<td class='text-center'>" . $row['remarks'] . "</td>");
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
                                <li class="page-item"><a href="shain_view.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
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
                            <li class="page-item"><a href="shain_view.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
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