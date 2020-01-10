
<?php
include_once('../../lib/db_config.php');
try {
  $pdo = new PDO(DB_HOST, DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

  switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':
    
    $st = $pdo->query("SELECT * FROM dependent_info ORDER BY id");
    echo json_encode($st->fetchAll(PDO::FETCH_ASSOC));
    break;
    
    case 'POST':
    $in = json_decode(file_get_contents('php://input'), true); 
    if (isset($in['id'])) {
      $st = $pdo->prepare("UPDATE dependent_info SET shain_cd=:shain_cd, name=:name, name_kana=:name_kana, gender=:gender, birthday=:birthday, haigusha=:haigusha, kisonenkin_bango=:kisonenkin_bango, shikakushutokubi=:shikakushutokubi WHERE id=:id");
    } else {
      $st = $pdo->prepare("INSERT INTO dependent_info(id,shain_cd,name,name_kana,gender,birthday,haigusha,kisonenkin_bango,shikakushutokubi) VALUES(:newid,:shain_cd,:name,:name_kana,:gender,:birthday,:haigusha,:kisonenkin_bango,:shikakushutokubi)");
    }
    $st->execute($in);
    break;
    
    case 'DELETE':
    $st = $pdo->prepare("DELETE FROM dependent_info WHERE id=?");
    $st->execute([$_GET['id']]);
    break;

  }
  
  } catch (PDOException $e) {
    echo("ERROR!".$e -> getMessage());  
  }
  ?>


