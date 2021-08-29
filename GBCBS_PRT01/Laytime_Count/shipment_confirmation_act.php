<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../tools.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$shipment_id = $_SESSION['shipment_id'];
$confirmer_email = $_POST["confirmer_email"];

//以下ログインユーザーのみ
// SHIPMENT PASS取得
$pdo = db_connect();
$stmt = $pdo->prepare("SELECT * FROM shipments WHERE shipment_id = :shipment_id");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $shipment_password = $result['shipment_password'];
  $vessel_name = $result['vessel_name'];

}}

// WORK STATUS更新
$stmt = $pdo->prepare("UPDATE shipments SET `work_status`='Now_Confirming' WHERE `shipment_id`= :shipment_id");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{

  //確認先へのメール送信 
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  $to = $_POST["confirmer_email"];
  $subject = "LAYTIME確認依頼";
  $message = "(このメールアドレスに返信しないでください)\r\nLAYTIME確認依頼を受領しました。\r\n登録者 = ${user_name}\r\n配船名 = ${vessel_name}\r\n配船pass = ${shipment_password}\r\nLog-inして機能テストをお願いします";
  $headers = "From:info@GBCBS_PRT.jp";
  if(mb_send_mail($to, $subject, $message, $headers))
  {
  // echo "メール送信成功です";
  }
  else
  {
  $_SESSION['temp_message'] = "確認依頼が登録されましたがメール送信に失敗しました。こちらの配船passから確認してください。配船pass = ".$shipment_password;
  }

  // アラートメッセージ
  $_SESSION['temp_message'] = "確認依頼が送信されました。配船pass = ".$shipment_password;

  redirect('./LC_main.php');
}   

?>
