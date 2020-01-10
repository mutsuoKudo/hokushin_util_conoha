<?php
include_once('../../lib/db_config.php');
try {
    $dbh = new PDO(DB_HOST, DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'];
    $maker_id = $_POST['maker_id'];
    $model_id = $_POST['model_id'];
    $inch = $_POST['inch'];
    $kaizoudo_id = $_POST['kaizoudo_id'];
    $vga = $_POST['vga'];
    $dvi = $_POST['dvi'];
    $hdmi = $_POST['hdmi'];
    $displayport = $_POST['displayport'];
    $other = $_POST['other'];
    $speaker = $_POST['speaker'];
    $usb = $_POST['usb'];
    $jyotai = $_POST['jyotai'];
    $room_id = $_POST['room_id'];
    $user_id = $_POST['user_id'];
    $konyubi = $_POST['konyubi'];
    $kakaku = $_POST['kakaku'];
    $unyo_kikan = $_POST['unyo_kikan'];
    $biko = $_POST['biko'];
    $serial_no = $_POST['serial_no'];

    // $sql = sprintf('UPDATE display_list SET 
    // maker_id = \'%s\',model_id = \'%s\',inch = \'%s\' WHERE id = \'%s\'',$maker_id,$model_id,$inch,$id$);
    $sql = sprintf('UPDATE display_list SET 
    maker_id = \'%s\',model_id = \'%s\',inch = \'%s\',kaizoudo_id = \'%s\',vga = \'%s\',dvi = \'%s\',
    hdmi = \'%s\',displayport = \'%s\',other = \'%s\',speaker = \'%s\',usb = \'%s\',jyotai =\'%s\',room_id = \'%s\',
    user_id = \'%s\',konyubi = \'%s\',kakaku = \'%s\',unyo_kikan = \'%s\',biko = \'%s\',serial_no = \'%s\' WHERE id = \'%s\'',
    $maker_id,$model_id,$inch,$kaizoudo_id,$vga,$dvi,$hdmi,$displayport,$other,$speaker,$usb,
    $jyotai,$room_id,$user_id,$konyubi,$kakaku,$unyo_kikan,$biko,$serial_no,$id);


// // $sql = $sql . $_POST['maker_id'];
//     // var_dump($sql);
//     $file = 'C:\Users\user\Desktop\SQL_CHECK.txt';
//     // ファイルをオープンして既存のコンテンツを取得します
//     $current = file_get_contents($file);
//     // 新しい人物をファイルに追加します
//     $current .= $sql;
//     // 結果をファイルに書き出します
//     file_put_contents($file, $current);

    $st = $dbh->prepare($sql);
    $st->execute();
    
}catch(PDOException $e){
    echo("ERROR!" . $e->getMessage());
}finally{
    
}

