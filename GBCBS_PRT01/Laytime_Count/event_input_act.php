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
// $shipment_id;
// $shipment_password = chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90));
$loading_volume = $_POST["loading_volume"];
$arrival_time = $_POST["arrival_time"];
$nor_tender = $_POST["nor_tender"];
$berthed_time = $_POST["berthed_time"];
$commencement_of_operation = $_POST["commencement_of_operation"];
$completion_of_operation = $_POST["completion_of_operation"];
$commencement_of_laytime = $_POST["commencement_of_laytime"];
// $work_status;
// $input_id = $_SESSION['user_id'];
// $input_group = "MC";
// $input_datetime;
// $confirm_id;
$pdo = db_connect();
$stmt = $pdo->prepare("UPDATE shipments SET loading_volume=:loading_volume WHERE shipment_id=:shipment_id;");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':loading_volume', $loading_volume, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)


// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    } else {
  }

$pdo = db_connect();

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name) VALUES (:shipment_id, :arrival_time, :arrival_time, 'arrival_time')");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':arrival_time', $arrival_time, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
if ($status == false) {sql_error($stmt);} else {}

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name) VALUES (:shipment_id, :nor_tender, :nor_tender, 'nor_tender')");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nor_tender', $nor_tender, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
if ($status == false) {sql_error($stmt);} else {}

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name) VALUES (:shipment_id, :berthed_time, :berthed_time, 'berthed_time')");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':berthed_time', $berthed_time, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
if ($status == false) {sql_error($stmt);} else {}

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name) VALUES (:shipment_id, :commencement_of_operation, :commencement_of_operation, 'commencement_of_operation')");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':commencement_of_operation', $commencement_of_operation, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
if ($status == false) {sql_error($stmt);} else {}

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name) VALUES (:shipment_id, :completion_of_operation, :completion_of_operation, 'completion_of_operation')");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':completion_of_operation', $completion_of_operation, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
if ($status == false) {sql_error($stmt);} else {}

$stmt = $pdo->prepare("INSERT INTO events(shipment_id, time_from, time_to, event_name) VALUES (:shipment_id, :commencement_of_laytime, :commencement_of_laytime, 'commencement_of_laytime')");
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':commencement_of_laytime', $commencement_of_laytime, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// 6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    } else {
      redirect('./shipment_input.php?shipment_id='.$shipment_id);
}

?>
