<?php
	$conn = mysql_connect( "localhost", "root", "7656198s" );
	if( $conn == false )
	{
        die("MySQL 接続エラー");
	}
	mysql_set_charset("utf8");
	mysql_select_db( "hokushin_util" );
?>

