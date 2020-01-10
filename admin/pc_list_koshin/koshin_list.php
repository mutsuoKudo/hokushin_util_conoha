
<?php
include_once('../../lib/db_config.php');
try {
  $pdo = new PDO(DB_HOST, DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  switch ($_SERVER['REQUEST_METHOD']) {
    
    case 'GET':
    
    $st = $pdo->query("SELECT * FROM pc_list_koshin ORDER BY id");
    echo json_encode($st->fetchAll(PDO::FETCH_ASSOC));
    break;
    
    case 'POST':
    $in = json_decode(file_get_contents('php://input'), true); 
    if (isset($in['id'])) {
      $st = $pdo->prepare("UPDATE pc_list_koshin SET kousinbi=:kousinbi,naiyou=:naiyou WHERE id=:id");
    } else {
      $st = $pdo->prepare("INSERT INTO pc_list_koshin(id,kousinbi,naiyou) VALUES(:newid,:kousinbi,:naiyou)");
    }
    $st->execute($in);
    break;
    
    case 'DELETE':
    $st = $pdo->prepare("DELETE FROM pc_list_koshin WHERE id=?");
    $st->execute([$_GET['id']]);
    break;

  }
  
  } catch (PDOException $e) {
    echo("ERROR!".$e -> getMessage());  
  }
  ?>


