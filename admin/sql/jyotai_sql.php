<?php
include_once('../../lib/db_main.php');

try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
    //全案件取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "jtt.id AS id ";
    $query = $query . ",jtt.name AS name ";
    $query = $query . " FROM jyotai_tbl jtt";
    $query = $query . " ORDER BY jtt.id";
    $jyotai_tbl = $db->get_all($query);

} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>