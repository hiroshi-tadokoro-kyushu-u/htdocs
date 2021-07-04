<?php

function db_connect(){
    try {
        $db_name = "mil16_package_matching";    //データベース名
        $db_id   = "mil16";      //アカウント名
        $db_pw   = "GONgon6015";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "mysql1036.db.sakura.ne.jp"; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;//ここを追加！！
      } catch (PDOException $e) {
          exit('DB Connection Error:' . $e->getMessage());
      }
    }

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
    header("Location: " . $file_name );
    exit();
}


?>