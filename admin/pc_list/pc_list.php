
<?php
include_once('../../lib/db_config.php');
try {
  $pdo = new PDO(DB_HOST, DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  switch ($_SERVER['REQUEST_METHOD']) {
    
    case 'GET':
    $st = $pdo->query("SELECT * FROM pc_list ORDER BY id");
    echo json_encode($st->fetchAll(PDO::FETCH_ASSOC));
    break;
    
    case 'POST':
    $in = json_decode(file_get_contents('php://input'), true); 
    if (isset($in['id'])) {
      $st = $pdo->prepare("UPDATE pc_list SET 
      maker_id=:maker_id,model_id=:model_id,os_id=:os_id,processor_id=:processor_id,
      memori=:memori,office_id=:office_id,jyotai=:jyotai,room_id=:room_id,user_id=:user_id,
      konyubi=:konyubi,kakaku=:kakaku,unyo_kikan=:unyo_kikan,biko=:biko,serial_no=:serial_no
      WHERE id=:id");
    } else {
      $st = $pdo->prepare("INSERT INTO pc_list(
      id,maker_id,model_id,os_id,processor_id,memori,office_id,jyotai,
      room_id,user_id,konyubi,kakaku,unyo_kikan,biko,serial_no) 
      VALUES(:newid,:maker_id,:model_id,:os_id,:processor_id,:memori,
      :office_id,:jyotai,:room_id,:user_id,:konyubi,:kakaku,:unyo_kikan,:biko,:serial_no)");
    }
    $st->execute($in);
    break;
    
    case 'DELETE':
    $st = $pdo->prepare("DELETE FROM pc_list WHERE id=?");
    $st->execute([$_GET['id']]);
    break;

  }
  
  } catch (PDOException $e) {
    echo("ERROR!".$e -> getMessage());  
  }
  ?>


