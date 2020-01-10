<?php
include_once('../../lib/db_config.php');
try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'DELETE FROM shain where shain_cd in ';
    $param = $_POST['shain_cd'];
//    inの中身を文字列連結
    $sql = $sql . $param;
    $st = $dbh->prepare($sql);
    $st->execute();
    
}catch(PDOException $e){
    echo("ERROR!" . $e->getMessage());
}finally{
    
}

