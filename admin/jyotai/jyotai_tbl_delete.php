<?php
include_once('../../lib/db_config.php');
try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'DELETE FROM jyotai_tbl where id in ';
    $param = $_POST['id'];
    $sql = $sql . $param;
    var_dump($sql);
    $st = $dbh->prepare($sql);
    $st->execute();
    
}catch(PDOException $e){
    echo("ERROR!" . $e->getMessage());
}finally{
    
}

