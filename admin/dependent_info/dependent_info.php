<!-- bootstrapCSS3　※index.phpは4なのでCSS注意 -->

<?php
include_once('../../lib/db_config.php');
try {
    $dbh = new PDO(DB_HOST, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $page = 1;
    // var_dump($_GET['page']);
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $sql = 'SELECT COUNT(*) from dependent_info';
    $stmt = $dbh->query($sql);

    $st = $stmt->fetchColumn();
    // var_dump($st);
    $page = max($page, 1);
    $maxPage = ceil($st / 5);
    $page = min($page, $maxPage);
    $start = ($page - 1) * 5;
} catch (PDOException $e) {
    echo ("ERROR!" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja" ng-app="app">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>扶養家族リスト</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="../admin_tbl.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-resource.min.js"></script>
    <script src="dependent_info_controller.js"></script>

</head>


<body ng-controller="MainCtrl">
    <div class="container height560 padding-top30">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b> 扶養家族リスト</b></h2>
                    </div>
                    <!--追加・削除ボタン-->
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                            <i class="material-icons">&#xE147;</i> <span>追加</span></a>

                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                            <i class="material-icons">&#xE15C;</i> <span>選択削除</span></a>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <!--チェックボックスALL-->
                        <th>
                            <form class="custom-checkbox" action="dependent_info.php" method="POST">
                                <input type="checkbox" id="selectAll" name="selectAll" value="0" form="form1">
                                <label for="selectAll"></label>
                            </form>
                        </th>
                        <th>ID</th>
                        <th>社員コード</th>
                        <th>名前</th>
                        <th>名前（カナ）</th>
                        <th>性別</th>
                        <th>誕生日</th>
                        <th>配偶者</th>
                        <th>基礎年金番号</th>
                        <th>資格取得日</th>
                    </tr>

                </thead>

                <tbody>
                    <tr ng-controller="DetailCtrl" ng-repeat="dependent_info in dependent_infos| limitTo: 5: <?php echo ($start); ?>">
                        <!--チェックボックス個別-->
                        <td>
                            <form class="custom-checkbox" action="dependent_info.php" method="POST">
                                <input type="checkbox" class="selectCheckbox" name="options[{{dependent_info.id}}]" value="{{dependent_info.id}}" form="form1">
                                <label for="checkbox{{dependent_info.id}}"></label>
                            </form>
                        </td>

                        <td>{{dependent_info.id}}</td>
                        <td><input ng-model="dependent_info.shain_cd" required style="width:100px"></td>
                        <td><input ng-model="dependent_info.name" required style="width:90px"></td>
                        <td><input ng-model="dependent_info.name_kana" required style="width:120px"></td>
                        <td>
                            <select ng-model="dependent_info.gender" required style="width:50px">
                                <option disabled="disabled" [value]="undefined">選択してください</option>
                                <option [value]="'男'">男</option>
                                <option [value]="'女'">女</option>
                            </select>
                        </td>
                        <td><input ng-model="dependent_info.birthday" required style="width:100px"></td>
                        <td>
                            <select ng-model="dependent_info.haigusha" required style="width:50px">
                                <option disabled="disabled" [value]="undefined">選択してください</option>
                                <option [value]="'0'">0</option>
                                <option [value]="'1'">1</option>
                            </select>
                        </td>
                        <td><input ng-model="dependent_info.kisonenkin_bango" style="width:100px"></td>
                        <td><input ng-model="dependent_info.shikakushutokubi" style="width:100px"></td>

                        <td>
                            <button ng-click="update()" class="edit-icon">
                                <i class="material-icons" data-toggle="tooltip" title="更新">&#xE254;</i></button>
                            <button ng-click="delete()" class="delete">
                                <i class="material-icons" data-toggle="tooltip" title="削除">&#xE872;</i></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- ページャー -->
            <div class="clearfix">
                <ul class="pagination">
                    <?php
                    if ($page > 1) {
                        ?>
                        <li class="page-item"><a href="dependent_info.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
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
                    <li class="page-item"><a href="dependent_info.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
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

    <footer class="text-white bg-yellow footer">
        <div class="container">
            <p class="float-right" class="text-white">
                <a href="#" class="text-white">ページ上部へ</a>
                <br>
                <a href="../index.php" class="text-white">HOMEにもどる</a>
            </p>
        </div>
    </footer>

    <!-- Add Modal HTML ※追加ボタンを押すとでてくる画面 -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">データの追加</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="text-center" style="margin-top:2%; color:red; font-size:15px;">
                        <p><strong>※すべての欄を入力してください。</strong><br>
                            入力する内容がない場合は、0と入力してください。<br>
                            誕生日などの日付を入力する場合は、<br>
                            0000-00-00というようにハイフンを入れてください。
                        </p>
                    </div>

                    <table class="modal-body" style="margin: 0 15%;font-size:15px;width: 80%;" id="dependent_table">
                        <tr class="form-group">
                            <th>ID</th>
                            <td><input ng-model="new_dependent_info.newid" size="15" required></td>
                        </tr>
                        <tr class="form-group">
                            <th>社員コード</th>
                            <td><input ng-model="new_dependent_info.shain_cd" size="15" required></td>
                        </tr>
                        <tr class="form-group">
                            <th>名前</th>
                            <td><input ng-model="new_dependent_info.name" size="15" required></td>
                        </tr>
                        <tr class="form-group">
                            <th>名前（カナ）</th>
                            <td><input ng-model="new_dependent_info.name_kana" size="15" required></td>
                        </tr>
                        <tr class="form-group">
                            <th>性別</th>
                            <td>
                                <select ng-model="new_dependent_info.gender" required>
                                    <option disabled="disabled" selected>選択してください</option>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th>誕生日</th>
                            <td><input ng-model="new_dependent_info.birthday" size="15" required></td>
                        </tr>
                        <tr class="form-group">
                            <th>配偶者</th>
                            <td>
                                <select ng-model="new_dependent_info.haigusha" required>
                                    <option disabled="disabled" selected>選択してください</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th colspan="2" style="padding-top:0 !important;font-weight: normal;"><small>※配偶者の場合は1を選択してください。<br>それ以外の場合は0を選択してください。</small></th>
                        </tr>

                        <tr class="form-group">
                            <th>基礎年金番号</th>
                            <td><input ng-model="new_dependent_info.kisonenkin_bango" size="15"></td>
                        </tr>
                        <tr class="form-group">
                            <th style="padding-bottom:8%">資格取得日</th>
                            <td style="padding-bottom:8%"><input ng-model="new_dependent_info.shikakushutokubi" size="15"></td>
                        </tr>
                    </table>

                    <div class="modal-footer">
                        <button onclick="location.href = 'dependent_info.php'" class="btn btn-default">キャンセル</button>
                        <button ng-click="add()" class="btn btn-success">追加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">データの削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>レコードを削除してもよろしいですか？</p>
                        <p class="text-warning"><small>この操作を元に戻すことはできません。</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" onclick="location.href = 'dependent_info.php'" class="btn btn-default" value="キャンセル">

                        <button id='kanan' class="btn btn-danger">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // 個別の更新・削除のツールチップ
            $('[data-toggle="tooltip"]').tooltip();
            // チェックボックス（すべて選択）の判断
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {

                if (this.checked) {
                    // alert("チェックきいてる");
                    $(".selectCheckbox").prop("checked", true);
                } else {
                    // alert("チェックなし");
                    $(".selectCheckbox").prop("checked", false);
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });

            $('#kanan').click(function() {
                var id = "(";
                var count = 0;
                $("input[type='checkbox']").filter(":checked").not("[name=selectAll]").each(function() {
                    //チェックされたチェックボックスの値を取得
                    var val = $(this).val();
                    //in句に使えるよう整形
                    if (count == 0) {
                        id = id + val;
                    } else {
                        id = id + ',' + val;
                    }
                    count = count + 1;
                })
                id = id + ')';
                //    alert(id);
                $.ajax({
                        type: 'post',
                        url: 'dependent_info_delete.php',
                        data: {
                            'id': id
                        },
                    })
                    // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
                    .done(function(response) {
                        //                    alert('成功');
                    })
                    // ・サーバからステータスコード400以上が返ってきたとき
                    // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
                    // ・通信に失敗したとき
                    .fail(function() {
                        // jqXHR, textStatus, errorThrown と書くのは長いので、argumentsでまとめて渡す
                        // (PHPのfunc_get_args関数の返り値のようなもの)
                        //                    $('#result').val('失敗');
                        //                    $('#detail').val(errorHandler(arguments));
                        alert(errorHandler(arguments));
                    });
                $('#deleteEmployeeModal').modal('hide');
                location.reload();
                alert('チェックしたレコードを削除しました。');
            });
        });
    </script>


</body>

</html>