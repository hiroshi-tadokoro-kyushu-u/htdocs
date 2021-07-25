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
// $vessel_name = $_POST["vessel_name"];
// $project_name = $_POST["project_name"];
// $contract_year = $_POST["contract_year"];
// $shipment_number = $_POST["shipment_number"];
// $operation_location = $_POST["operation_location"];
// $operation_rate = $_POST["operation_rate"];
// $dem_rate = $_POST["dem_rate"];
// $des_rate = $_POST["des_rate"];
// $work_status;
// $input_id = $_SESSION['user_id'];
// $input_group = "MC";
// $input_datetime;
// $confirm_id;

// 2. DB接続します

// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=package_matching;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

$pdo = db_connect();

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "DELETE FROM shipments WHERE shipment_id=:shipment_id;");

// 4. バインド変数を用意
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    } else {
      redirect('./LC_main.php');
}

?>
