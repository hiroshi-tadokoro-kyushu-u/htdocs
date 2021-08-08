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

// 1. POSTデータ取得
$subevent_time_from = $_POST["subevent_time_from"];
$subevent_time_to = $_POST["subevent_time_to"];
$subevent_name = $_POST["subevent_name"];

if(isset($_POST["subevent_count_flag"])){
    $subevent_count_flag = $_POST["subevent_count_flag"];  
  }else{
    $subevent_count_flag = 0;
  }

  $pdo = db_connect();
$stmt = $pdo->prepare("UPDATE events SET time_from=:subevent_time_from, time_to=:subevent_time_to, event_name=:subevent_name, count_flag=:subevent_count_flag WHERE event_id=:event_id;");
$stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
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
  redirect('./shipment_input.php?shipment_id='.$shipment_id.'');
}   

?>
