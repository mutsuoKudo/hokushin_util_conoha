<?php
include_once('../../lib/db_main.php');

try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
    //全案件取得
    $db = new db;
    $query = "SELECT ";
    $query = $query . "rmt.id AS id ";
    $query = $query . ",rmt.name AS name ";
    $query = $query . ",rmt.short_name AS short_name ";
    $query = $query . " FROM room_tbl rmt";
    $query = $query . " ORDER BY rmt.id";
    $room_tbl = $db->get_all($query);

} catch (PDOException $e) {
    echo("ERROR!" . $e->getMessage());
}
?>