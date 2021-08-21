<?php

function db_connect(){
    try {
        // デプロイ用
        // $db_name = "mil16_gbcbs_prt01";    //データベース名
        // $db_id   = "mil16";      //アカウント名
        // $db_pw   = "GONgon6015";      //パスワード：XAMPPはパスワード無しに修正してください。
        // $db_host = "mysql1036.db.sakura.ne.jp"; //DBホスト

      // //内部テスト用
        $db_name = "mil16_gbcbs_prt01";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト

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

function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//ログインチェック
function loginCheck(){
  if( $_SESSION["chk_ssid"] != session_id() ){
    exit('LOGIN ERROR / 戻るを押して、画面右上からログインして下さい<br>ユーザー登録がお済み出ない方は先にユーザー登録→ログインの順にご対応ください。');
  }else{
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}

// EOLアップデート
function expiration_of_laytime_update($eol,$shipment_id){
  $pdo = db_connect();
  $stmt = $pdo->prepare("UPDATE `events` SET time_from=:eol, time_to=:eol WHERE shipment_id=:shipment_id AND event_name='expiration_of_laytime';");
  $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':eol', $eol, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $status = $stmt->execute();
  if($status==false) {
      $error = $stmt->errorInfo();
      exit("ErrorQuery:".$error[2]);
  }else{
  }   
}
