
<?php
include_once('../../lib/db_config.php');
try {
  $pdo = new PDO(DB_HOST, DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  switch ($_SERVER['REQUEST_METHOD']) {
    
    case 'GET':
    
    // $st = $pdo->query("SELECT dl.id AS id, dl.maker_id AS maker_id, dl.model_id AS model_id, 
    // mkt.name AS maker_name, dmt.name AS desplay_model_name
    //  FROM display_list dl 
    //  LEFT OUTER JOIN maker_tbl mkt ON dl.maker_id = mkt.id
    //  LEFT OUTER JOIN display_model_tbl dmt ON dl.model_id = dmt.id
    //  ORDER BY id");
    $st = $pdo->query("SELECT * FROM display_list ORDER BY id");
    echo json_encode($st->fetchAll(PDO::FETCH_ASSOC));
    break;
    
    case 'POST':
    $in = json_decode(file_get_contents('php://input'), true); 
    if (isset($in['id'])) {
      $st = $pdo->prepare("UPDATE display_list SET 
      maker_id=:maker_id,model_id=:model_id,inch=:inch,kaizoudo_id=:kaizoudo_id,vga=:vga,dvi=:dvi,hdmi=:hdmi,
      displayport=:displayport,other=:other,speaker=:speaker,usb=:usb,jyotai=:jyotai,room_id=:room_id,user_id=:user_id,
      konyubi=:konyubi,kakaku=:kakaku,unyo_kikan=:unyo_kikan,biko=:biko,serial_no=:serial_no
      WHERE id=:id");
    } else {
      $st = $pdo->prepare("INSERT INTO display_list(
      id,maker_id,model_id,inch,kaizoudo_id,vga,dvi,hdmi,
      displayport,other,speaker,usb,jyotai,room_id,user_id,
      konyubi,kakaku,unyo_kikan,biko,serial_no) 
      VALUES(:newid,:maker_id,:model_id,:inch,:kaizoudo_id,:vga,:dvi,:hdmi,
      :displayport,:other,:speaker,:usb,:jyotai,:room_id,:user_id,
      :konyubi,:kakaku,:unyo_kikan,:biko,:serial_no)");
    }
    $st->execute($in);
    break;
    
    case 'DELETE':
    $st = $pdo->prepare("DELETE FROM display_list WHERE id=?");
    $st->execute([$_GET['id']]);
    break;

  }
  
  } catch (PDOException $e) {
    echo("ERROR!".$e -> getMessage());  
  }
  ?>


