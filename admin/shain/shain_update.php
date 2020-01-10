<?php
include_once('../../lib/db_config.php');
try {
    $dbh = new PDO(DB_HOST, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['shain_cd'];
    $name = $_POST['shain_mei'];
    $kana = $_POST['shain_mei_kana'];
    $romaji = $_POST['shain_mei_romaji'];
    $mail = $_POST['shain_mail'];
    $gender = $_POST['gender'];
    $birthday = $_POST['shain_birthday'];
    $nyushabi = $_POST['nyushabi'];
    $tensekibi = $_POST['tensekibi'];
    $taishokubi = $_POST['taishokubi'];
    $department = $_POST['department'];
    // $pic = $_POST['pic'];
    $remarks = $_POST['remarks'];

    // $sql = 'UPDATE shain SET shain_mei = "edit" WHERE shain_cd = "0001"';
    $sql = sprintf(
        'UPDATE shain SET 
    shain_mei = \'%s\',shain_mei_kana = \'%s\',shain_mei_romaji = \'%s\',
    gender = \'%s\',shain_mail = \'%s\',shain_birthday = \'%s\',nyushabi = \'%s\',
    tensekibi = \'%s\',taishokubi = \'%s\',department = \'%s\',remarks = \'%s\' WHERE shain_cd = \'%s\'',
        $name,
        $kana,
        $romaji,
        $mail,
        $gender,
        $birthday,
        $nyushabi,
        $tensekibi,
        $taishokubi,
        $department,
        $remarks,
        $id
    );

    // $sql = $sql . $param;
    // var_dump($sql);
    $file = 'C:\Users\user\Desktop\update_CHECK.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= $sql;
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

    $st = $dbh->prepare($sql);
    $st->execute();
} catch (PDOException $e) {
    echo ("ERROR!" . $e->getMessage());
} finally { }
