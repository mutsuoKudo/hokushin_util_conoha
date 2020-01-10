<?php
include_once('../../lib/db_main.php');

try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
    //全案件取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "prt.id AS id ";
    $query = $query . ",prt.ryaku AS name ";
    $query = $query . ",prt.seishiki AS seishiki ";
    $query = $query . " FROM processor_tbl prt";
    $query = $query . " ORDER BY prt.id";
    $processor_tbl = $db->get_all($query);

} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>