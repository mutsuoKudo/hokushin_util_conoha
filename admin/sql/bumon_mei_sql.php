<?php
include_once('../../lib/db_main.php');

try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
    //全案件取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "bm.id AS id ";
    $query = $query . ",bm.bumon_mei AS name ";
    $query = $query . " FROM bumon_mei bm";
    $query = $query . " ORDER BY bm.id";
    $bumon_mei = $db->get_all($query);

} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>