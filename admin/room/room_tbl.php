<!-- bootstrapCSS3　※index.phpは4なのでCSS注意 -->

<?php
include_once('../../lib/db_config.php');
try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $page = 1;
    // var_dump($_GET['page']);
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $sql = 'SELECT COUNT(*) from room_tbl';
    $stmt = $dbh->query($sql);

    $st = $stmt->fetchColumn();
    // var_dump($st);
    $page = max($page, 1);
    $maxPage = ceil($st / 5);
    $page = min($page, $maxPage);
    $start = ($page - 1) * 5;
} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>使用場所名称</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="../admin_tbl.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-resource.min.js"></script>
        <script src="room_controller.js"></script>

    </head>


    <body ng-controller="MainCtrl">
        <div class="container height560 padding-top30">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b> 使用場所名称</b></h2>
                        </div>
                        <!--追加・削除ボタン-->
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> <span>追加</span></a>
                            <!-- <a href="#addEmployeeModal" class="btn btn-success material-icons" data-toggle="modal">
                            <span>&#xE147;追加</span></a> -->

                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                            <!--<div class="btn btn-danger" id="kudo">-->
                                <i class="material-icons">&#xE15C;</i> <span>選択削除</span>
                            <!--</div>-->
                            </a>
                            <!-- <form id="form1" action="processor_tbl.php" method="POST" >
                            <input type="submit" value="&#xE15C;選択削除" name="selectDelete" class="btn btn-danger material-icons">
                            </form> -->
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <!--チェックボックスALL-->
					　　<th>
                                <form class="custom-checkbox" action="room_tbl.php" method="POST">
                                    <input type="checkbox" id="selectAll" name="selectAll" value="0" form="form1">
                                    <label for="selectAll"></label>
                                </form>
                            </th>
                            <th width="80px">ID</th>
                            <th width="150px">部屋名</th>
                            <th width="200px">略称</th>
                            <th width="150px">操作</th>
                        </tr>
                    </thead>

                    <tbody>						
                        <tr ng-controller="DetailCtrl" ng-repeat="room in rooms| limitTo: 5: <?php echo($start); ?>">
                            <!--チェックボックス個別-->
                            <td>
                                <form class="custom-checkbox" action="room_tbl.php" method="POST">
                                    <input type="checkbox" class="selectCheckbox" name="options[{{room.id}}]" value="{{room.id}}" form="form1">
                                    <label for="checkbox{room.id}}"></label>
                                </form>
                            </td> 

                            <td >{{room.id}}</td>
                            <td ><input ng-model="room.name" size="30" required></td>
                            <td ><input ng-model="room.short_name" size="15" required></td>
                            <td>
                                <button ng-click="update()" class="edit-icon">
                                    <i class="material-icons" data-toggle="tooltip" title="編集">&#xE254;</i></button>
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
                            <li class="page-item"><a href="room_tbl.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
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
                            <li class="page-item"><a href="room_tbl.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
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
                        <div class="modal-body">										
                            <div class="form-group">
                                <label>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input ng-model="new_room.newid" size="15" required>
                            </div>
                            <div class="form-group">
                                <label>部屋名&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input ng-model="new_room.name" size="30" required>
                            </div>
                            <div class="form-group">
                                <label>略称&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input ng-model="new_room.short_name" size="15" required>
                            </div>				
                        </div>
                        <div class="modal-footer">
                            <button onclick="location.href = 'room_tbl.php'" class="btn btn-default">キャンセル</button>
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
                            <input type="submit" onclick="location.href = 'room_tbl.php'" class="btn btn-default" value="キャンセル">
                            <!--                            <form id="form1" action="room_tbl.php" method="POST">
                                                            <input type="submit" value="削除" name="selectDelete" class="btn btn-danger">
                                                        </form>-->
<!--                            <button onclick="location.href = 'room_tbl.php?selectDelete=ok'" class="btn btn-danger">削除</button> -->
                            <button id='kanan' class="btn btn-danger">削除</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>	
        <script type="text/javascript">
            $(document).ready(function(){
            // 個別の更新・削除のツールチップ
            $('[data-toggle="tooltip"]').tooltip();
            // チェックボックス（すべて選択）の判断
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function(){

            if (this.checked){
            // alert("チェックきいてる");
            $(".selectCheckbox").prop("checked", true);
            } else{
            // alert("チェックなし");
            $(".selectCheckbox").prop("checked", false);
            }
            });
            checkbox.click(function(){
            if (!this.checked){
            $("#selectAll").prop("checked", false);
            }
            });

            $('#kanan').click(function () {
            var id = "(";
            var count = 0;
            $("input[type='checkbox']").filter(":checked").not("[name=selectAll]").each(function() {
            //チェックされたチェックボックスの値を取得
            var val = $(this).val();
            //in句に使えるよう整形
            if (count == 0){
            id = id + val;
            } else{
            id = id + ',' + val;
            }
            count = count + 1;
            })
                    id = id + ')';
//            alert(id);
            $.ajax({
            type : 'post',
                    url : 'room_tbl_delete.php',
                    data : {
                    'id' : id
                    },
            })
                    // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
                    .done(function (response) {
//                    alert('成功');
                    })
                    // ・サーバからステータスコード400以上が返ってきたとき
                    // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
                    // ・通信に失敗したとき
                    .fail(function () {
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