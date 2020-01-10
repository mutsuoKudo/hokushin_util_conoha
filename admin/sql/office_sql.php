<?php
include_once('../../lib/db_main.php');

try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
    //全案件取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "oft.id AS id ";
    $query = $query . ",oft.name AS name ";
    $query = $query . ",oft.product_key AS product_key ";
    $query = $query . " FROM office_tbl oft";
    $query = $query . " ORDER BY oft.id";
    $office_tbl = $db->get_all($query);

} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>