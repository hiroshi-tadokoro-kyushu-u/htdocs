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

//以下ログインユーザーのみ

// 1. POSTデータ取得
$subevent_time_from = $_POST["subevent_time_from"];
$subevent_time_to = $_POST["subevent_time_to"];
$subevent_name = $_POST["subevent_name"];
$subevent_count_flag = $_POST["subevent_count_flag"];

$pdo = db_connect();

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name, count_flag) VALUES (:shipment_id, :subevent_time_from, :subevent_time_to, :subevent_name, :subevent_count_flag)");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':subevent_time_from', $subevent_time_from, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':subevent_time_to', $subevent_time_to, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':subevent_name', $subevent_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':subevent_count_flag', $subevent_count_flag, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
  //     // echo $result['user_name'];
  //     $flag = ($result['user_name'])?1:0;
  //     header('Content-Type: application/json; charset=utf-8');
  //     echo json_encode($flag);
  // }
}   

?>
