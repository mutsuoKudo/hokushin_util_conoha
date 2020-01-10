<?php
include_once('../../lib/db_main.php');

try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
    //全案件取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "ost.id AS id ";
    $query = $query . ",ost.name AS name ";
    $query = $query . " FROM os_tbl ost";
    $query = $query . " ORDER BY ost.id";
    $os_tbl = $db->get_all($query);

} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>