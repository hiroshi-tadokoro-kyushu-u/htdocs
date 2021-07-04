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

//SQLエラー
function sql_error($stmt){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}
?>

<?php
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//ログインチェック
function loginCheck(){
  if( $_SESSION["chk_ssid"] != session_id() ){
    exit('LOGIN ERROR');
  }else{
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}

?>