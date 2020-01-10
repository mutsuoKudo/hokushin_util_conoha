<?php

include_once('db_config.php');

class db
{
    function shain_update()
    {
        try {
            $dbh = new PDO(DB_HOST, DB_USER, DB_PASS);


            //接続時、shainテーブルにemployeesテーブルのデータを上書きする
            $sth = $dbh->prepare('DELETE FROM shain;
            INSERT into shain (shain_cd,shain_mei,shain_mei_kana,shain_mei_romaji,shain_mail,gender,shain_birthday,nyushabi,tensekibi,taishokubi,department,remarks) SELECT shain_cd,shain_mei,shain_mei_kana,shain_mei_romaji,shain_mail,gender,shain_birthday,nyushabi,tensekibi,taishokubi,department,remarks from employees;');
                        
            // var_dump($sth);

            $sth->execute();
            $dbh = null;
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }
    }
    
    function get_all($sql)
    {
        try {
            $dbh = new PDO(DB_HOST, DB_USER, DB_PASS);
          
            $sth = $dbh->prepare($sql);
            
            // var_dump($sth);

            $sth->execute();
            $dbh = null;
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }
    }

    function get_pclist_all()
    {
        $sql_command = "SELECT * FROM `pc_list`";
        $result = $this->get_all($sql_command);
        foreach ($result as $key => $value) {
            $tp = $value['type'];
            $rows[$tp][] = $value;
        }
        return $rows;
    }

}
