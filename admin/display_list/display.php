<!-- bootstrapCSS3　※index.phpは4なのでCSS注意 -->

<!-- ページャー -->
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

    $sql = 'SELECT COUNT(*) from display_list';
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
        <title>ディスプレイの種類</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="../admin_tbl.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-resource.min.js"></script>
        <script src="display_controller.js"></script>
    </head>


    <body ng-controller="MainCtrl">
        <div class="container height700 width1400">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b> ディスプレイの種類</b></h2>
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
                                <form class="custom-checkbox" action="display.php" method="POST">
                                    <input type="checkbox" id="selectAll" name="selectAll" value="0" form="form1">
                                    <label for="selectAll"></label>
                                </form>
                            </th>
                            <th class="text-center" style="width:100px">id</th>
                            <th class="text-center" style="width:40px">ﾒｰｶｰ</th>
                            <th class="text-center" style="width:40px">ﾓﾃﾞﾙ</th>
                            <th class="text-center" style="width:40px">ｲﾝﾁ</th>
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
                            <th class="text-center" style="width:70px">ﾕｰｻﾞｰ</th>
                            <th class="text-center" style="width:60px">購入日</th>
                            <th class="text-center" style="width:65px">価格</th>
                            <th class="text-center" style="width:95px">運用期間</th>
                            <th class="text-center" style="width:90px">備考</th>
                            <th class="text-center" style="width:140px">ｼﾘｱﾙNO.</th>
                            <th class="text-center" width="150px">操作</th>
                        </tr>
                    </thead>

                    <tbody>						
                        <tr ng-controller="DetailCtrl" ng-repeat="display in displays| limitTo: 5: <?php echo($start); ?>">
                            <!--チェックボックス個別-->
                            <td>
                                <form class="custom-checkbox" action="display.php" method="POST">
                                    <input type="checkbox" class="selectCheckbox" name="options[{{display.id}}]" value="{{display.id}}" form="form1">
                                    <label for="checkbox{{display.id}}"></label>
                                </form>
                            </td> 

                            <td class="text-center" style="word-break:break-all">{{display.id}}</td>
                            <td class="text-center">{{display.maker_id}}</td>
                            <td class="text-center">{{display.model_id}}</td>
                            <td class="text-center">{{display.inch}}</td>
                            <td class="text-center">{{display.kaizoudo_id}}</td>
                            <td class="text-center">{{display.vga}}</td>
                            <td class="text-center">{{display.dvi}}</td>
                            <td class="text-center">{{display.hdmi}}</td>
                            <td class="text-center">{{display.displayport}}</td>
                            <td class="text-center" style="word-break:break-all">{{display.other}}</td>
                            <td class="text-center">{{display.speaker}}</td>
                            <td class="text-center">{{display.usb}}</td>
                            <td class="text-center">{{display.jyotai}}</td>
                            <td class="text-center">{{display.room_id}}</td>
                            <td class="text-center" style="word-break:break-all">{{display.user_id}}</td>
                            <td class="text-center" style="word-break:break-all">{{display.konyubi}}</td>
                            <td class="text-center">{{display.kakaku}}</td>
                            <td class="text-center" style="word-break:break-all">{{display.unyo_kikan}}</td>
                            <td class="text-center" style="word-break:break-all">{{display.biko}}</td>
                            <td style="word-break:break-all">{{display.serial_no}}</td>
                            <td class="text-center edit-button">
                                <!-- <button ng-click="update()" class="edit"> -->
                                <button a href="#editEmployeeModal" data-toggle="modal" class="edit-icon">
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
                            <li class="page-item"><a href="display.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
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
                            <li class="page-item"><a href="display.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
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



    <!-- Edit Modal HTML ※編集ボタンを押すとでてくる画面 -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="container  bg-white">
            <div class="modal-header py-5 text-center">
                <h2 class="modal-title">データの編集</h2>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <form class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                        <div class="form-group col-md-6 mb-2">
                                <label>ID<small>　※IDの変更はできません</small></label>
                                <input id="id1" ng-model="display.id" class="form-control input-lg" required>
                            </div>
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>メーカー</label> 
                                <select id="id2" ng-model="display.maker_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/maker_sql.php');
                                    foreach ($maker_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>	

                            <div class="form-group col-md-6 mb-2">
                                <label>モデル</label> 
                                <select id="id3" ng-model="display.model_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/display_model_sql.php');
                                    foreach ($display_model_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>                           
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>インチ</label>
                                <input id="id4" ng-model="display.inch" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>解像度</label> 
                                <select id="id5" ng-model="new_display.kaizoudo_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/kaizoudo_sql.php');
                                    foreach ($kaizoudo_tbl as $row ) {
                                        print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>    
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-3 mb-2">
                            <label>vga</label>
                                <input id="id6" ng-model="display.vga" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>dvi</label>
                                <input id="id7" ng-model="display.dvi" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>hdmi</label>
                                <input id="id8" ng-model="display.hdmi" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>displayport</label>
                                <input id="id9" ng-model="display.displayport" class="form-control input-lg" required>
                            </div>
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-12 mb-2">
                                <label>その他</label>
                                <textarea id="id10" ng-model="display.other" cols="50" rows="2" class="form-control input-lg"required></textarea>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-4 mb-2">
                                <label>スピーカー</label>
                                <input id="id11" ng-model="display.speaker" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>usb</label>
                                <input id="id12" ng-model="display.usb"  class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>状態</label> 
                                <select id="id13" ng-model="display.jyotai" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/jyotai_sql.php');
                                    foreach ($jyotai_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>使用場所</label> 
                                <select id="id14" ng-model="display.room_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/room_sql.php');
                                    foreach ($room_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . ":"  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>使用者</label> 
                                <select id="id15" ng-model="display.user_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/shain_sql.php');
                                    foreach ($shain_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-4 mb-2">
                                <label>購入日<small>　例：2019-03-13</small></label>
                                <input id="id16" ng-model="display.konyubi" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>価格</label>
                                <input id="id17" ng-model="display.kakaku" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>運用期間</label>
                                <input id="id18" ng-model="display.unyo_kikan" class="form-control input-lg" required>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>備考</label>
                                <textarea id="id19" ng-model="display.biko" cols="30" rows="2" class="form-control input-lg" required></textarea>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>シリアルNO.</label>
                                <textarea id="id20" ng-model="display.serial_no" cols="30" rows="2" class="form-control input-lg" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="location.href = 'display.php'" class="btn btn-default">キャンセル</button>
                        <button id='edit' class="btn btn-success">編集完了</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add Modal HTML ※追加ボタンを押すとでてくる画面 -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="container  bg-white">
            <div class="modal-header py-5 text-center">
                <h2 class="modal-title">データの追加</h2>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            
            <div class="col-md-8 col-md-offset-2">
                <form class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6 mb-2">
                                <label>ID</label>
                                <input ng-model="new_display.newid" class="form-control input-lg" required>
                            </div>
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>メーカー</label> 
                                <select ng-model="new_display.maker_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/maker_sql.php');
                                    foreach ($maker_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>	

                            <div class="form-group col-md-6 mb-2">
                                <label>モデル</label> 
                                <select ng-model="new_display.model_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/display_model_sql.php');
                                    foreach ($display_model_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>                           
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>インチ</label>
                                <input ng-model="new_display.inch" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>解像度</label> 
                                <select ng-model="new_display.kaizoudo_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/kaizoudo_sql.php');
                                    foreach ($kaizoudo_tbl as $row ) {
                                        print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>    
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-3 mb-2">
                            <label>vga</label>
                                <input ng-model="new_display.vga" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>dvi</label>
                                <input ng-model="new_display.dvi" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>hdmi</label>
                                <input ng-model="new_display.hdmi" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>displayport</label>
                                <input ng-model="new_display.displayport" class="form-control input-lg" required>
                            </div>
                        </div>
                        
                        <div class="row row-top">
                            <div class="form-group col-md-12 mb-2">
                                <label>その他</label>
                                <textarea ng-model="new_display.other" cols="50" rows="2" class="form-control input-lg"required></textarea>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-4 mb-2">
                                <label>スピーカー</label>
                                <input ng-model="new_display.speaker" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>usb</label>
                                <input ng-model="new_display.usb"  class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>状態</label> 
                                <select ng-model="new_display.jyotai" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/jyotai_sql.php');
                                    foreach ($jyotai_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>使用場所</label> 
                                <select ng-model="new_display.room_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/room_sql.php');
                                    foreach ($room_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . ":"  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>使用者</label> 
                                <select ng-model="new_display.user_id" class="form-control input-lg">
                                    <?php
                                    include_once('../sql/shain_sql.php');
                                    foreach ($shain_tbl as $row ) {
                                    print("<option value='$row[id]'>" . $row['id'] . "."  . $row['name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-4 mb-2">
                                <label>購入日<small>　例：2019-03-13</small></label>
                                <input ng-model="new_display.konyubi" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>価格</label>
                                <input ng-model="new_display.kakaku" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label>運用期間</label>
                                <input ng-model="new_display.unyo_kikan" class="form-control input-lg" required>
                            </div>
                        </div>

                        <div class="row row-top">
                            <div class="form-group col-md-6 mb-2">
                                <label>備考</label>
                                <textarea ng-model="new_display.biko" cols="30" rows="2" class="form-control input-lg" required></textarea>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>シリアルNO.</label>
                                <textarea ng-model="new_display.serial_no" cols="30" rows="2" class="form-control input-lg" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="location.href = 'display.php'" class="btn btn-default">キャンセル</button>
                        <button ng-click="add()" class="btn btn-success">追加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Delete Modal HTML ※選択削除ボタンを押すとでてくる画面-->
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
                            <input type="submit" onclick="location.href = 'display.php'" class="btn btn-default" value="キャンセル">
                            <!--                            <form id="form1" action="processor_tbl.php" method="POST">
                                                            <input type="submit" value="削除" name="selectDelete" class="btn btn-danger">
                                                        </form>-->
<!--                            <button onclick="location.href = 'processor_tbl.php?selectDelete=ok'" class="btn btn-danger">削除</button> -->
                            <button id='kanan' class="btn btn-danger">削除</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- チェックボックス判定 -->
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
//モーダル画面上の削除確認ボタン押下事の動き
            $('#kanan').click(function () {
                //変数idに、最初に左かっこを設定
            var id = "('";
            var count = 0;
            //明細行（ヘダー行のチェックボックスは対象外）のチェックボックスを全部見て、チェックされていたら、前にカンマをつけてチェックボックスに設定された値をidに文字列連結する、ただし、最初だけは前のカンマをつけない
            $("input[type='checkbox']").filter(":checked").not("[name=selectAll]").each(function() {
            //チェックされたチェックボックスの値を取得
            var val = $(this).val();
            //in句に使えるよう整形
            if (count == 0){
            id = id + val;
            } else{
            id = id  + "'" + "," + "'" + val;
            }
            count = count + 1;
            })
            //最後に変数idに右かっこを文字列連結する
            id = id + "')";
            console.log(id);
//            ajaxでテーブル削除用phpを呼び出し、引数にidをpostで渡す
            $.ajax({
            type : 'post',
                    url : 'display_delete.php',
                    data : {
                    'id' : id
                    },
            })
                    // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき→今回は特に何もしないテーブルの削除対象レコードが削除されて終わり
                    .done(function (response) {
//                    alert('成功');
                    })
                    // ・サーバからステータスコード400以上が返ってきたとき
                    // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
                    // ・通信に失敗したとき→失敗理由をalert表示
                    .fail(function () {
                    // jqXHR, textStatus, errorThrown と書くのは長いので、argumentsでまとめて渡す
                    // (PHPのfunc_get_args関数の返り値のようなもの)
//                    $('#result').val('失敗');
//                    $('#detail').val(errorHandler(arguments));
                    alert(errorHandler(arguments));
                    });
                    //モーダルを閉じて
            $('#deleteEmployeeModal').modal('hide');
            //一覧を再表示
            location.reload();
            //削除完了メッセージ表示
            alert('チェックしたレコードを削除しました。');
            });
            });

// 編集モーダルにデータを渡す
        $(document).on('click', '.edit-button', function () {
            $('#id1').val($(this).prevAll().eq(19).text());
            $('#id2').val($(this).prevAll().eq(18).text());
            $('#id3').val($(this).prevAll().eq(17).text());
            $('#id4').val($(this).prevAll().eq(16).text());
            $('#id6').val($(this).prevAll().eq(15).text());
            $('#id5').val($(this).prevAll().eq(14).text());
            $('#id7').val($(this).prevAll().eq(13).text());
            $('#id8').val($(this).prevAll().eq(12).text());
            $('#id9').val($(this).prevAll().eq(11).text());
            $('#id10').val($(this).prevAll().eq(10).text());
            $('#id11').val($(this).prevAll().eq(9).text());
            $('#id12').val($(this).prevAll().eq(8).text());
            $('#id13').val($(this).prevAll().eq(7).text());
            $('#id14').val($(this).prevAll().eq(6).text());
            $('#id15').val($(this).prevAll().eq(5).text());
            $('#id16').val($(this).prevAll().eq(4).text());
            $('#id17').val($(this).prevAll().eq(3).text());
            $('#id18').val($(this).prevAll().eq(2).text());
            $('#id19').val($(this).prevAll().eq(1).text());
            $('#id20').val($(this).prevAll().eq(0).text());
        });

// クリック動作確認
        $(function(){
            $('button#edit').on("click",function(){
                alert("click!");
            })
        })

//モーダル画面上の編集ボタン押下事の動き
        $('#edit').click(function () {

            var id = $('#id1').val();
            var maker_id = $('#id2').val();
            var model_id = $('#id3').val();
            var inch = $('#id4').val();
            var kaizoudo_id = $('#id5').val();
            var vga = $('#id6').val();
            var dvi = $('#id7').val();
            var hdmi = $('#id8').val();
            var displayport = $('#id9').val();
            var other = $('#id10').val();
            var speaker = $('#id11').val();
            var usb = $('#id12').val();
            var jyotai = $('#id13').val();
            var room_id = $('#id14').val();
            var user_id = $('#id15').val();
            var konyubi = $('#id16').val();
            var kakaku = $('#id17').val();
            var unyo_kikan = $('#id18').val();
            var biko = $('#id19').val();
            var serial_no = $('#id20').val();

            console.log(id,maker_id,model_id,inch,kaizoudo_id,vga,dvi,hdmi,displayport,
            other,speaker,usb,jyotai,room_id,user_id,konyubi,kakaku,unyo_kikan,biko,serial_no);         
            
            $.ajax({
                type : 'post',
                url : 'display_update.php',
                data : {
                    'id' : id,
                    'maker_id' : maker_id,
                    'model_id' : model_id,
                    'inch' : inch,
                    'kaizoudo_id' : kaizoudo_id,
                    'vga' : vga,
                    'dvi' : dvi,
                    'hdmi' : hdmi,
                    'displayport' : displayport,
                    'other' : other,
                    'speaker' : speaker,
                    'usb' : usb,
                    'jyotai' : jyotai,
                    'room_id' : room_id,
                    'user_id' : user_id,
                    'konyubi' : konyubi,
                    'kakaku' : kakaku,
                    'unyo_kikan' : unyo_kikan,
                    'biko' : biko,
                    'serial_no' : serial_no
                },
            })
            // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき→今回は特に何もしないテーブルの削除対象レコードが削除されて終わり
            .done(function (response) {
             alert('成功');
            //  alert(user_id);
            })
            // ・サーバからステータスコード400以上が返ってきたとき
            // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
            // ・通信に失敗したとき→失敗理由をalert表示
            .fail(function () {
                // jqXHR, textStatus, errorThrown と書くのは長いので、argumentsでまとめて渡す
                // (PHPのfunc_get_args関数の返り値のようなもの)
                $('#result').val('失敗');
                $('#detail').val(errorHandler(arguments));
                alert(errorHandler(arguments));
            });
            //モーダルを閉じて
            $('#editEmployeeModal').modal('hide');
            //一覧を再表示
            location.reload();
            //更新完了メッセージ表示
            alert('更新しました。');
    // });
});
        </script>

    </body>
</html>                                		                            