<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../tools.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$shipment_password = $_POST["shipment_password"];

//以下ログインユーザーのみ
// SHIPMENT PASS取得
$pdo = db_connect();
// $stmt = $pdo->prepare("SELECT * FROM shipments WHERE shipment_password = :shipment_password");
// $stmt->bindValue(':shipment_password', $shipment_password, PDO::PARAM_INT);
// $status = $stmt->execute();

// if($status==false) {
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);
// }else{
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//   $shipment_password = $result['shipment_password'];
//   $vessel_name = $result['vessel_name'];

// }}

// WORK STATUS更新
$stmt = $pdo->prepare("UPDATE shipments SET `confirm_id`=:user_id WHERE `shipment_password`= :shipment_password");
$stmt->bindValue(':shipment_password', $shipment_password, PDO::PARAM_STR); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  // アラートメッセージ
  $_SESSION['temp_message'] = "確認配船を登録しました。配船pass = ".$shipment_password;

  redirect('./LC_main.php');
}   

?>
