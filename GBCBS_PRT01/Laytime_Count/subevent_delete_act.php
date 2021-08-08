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
$event_id = $_SESSION['event_id'];

//以下ログインユーザーのみ

$pdo = db_connect();
$stmt = $pdo->prepare("DELETE FROM events WHERE event_id=:event_id;");
$stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  redirect('./shipment_input.php?shipment_id='.$shipment_id.'');
}   

?>
