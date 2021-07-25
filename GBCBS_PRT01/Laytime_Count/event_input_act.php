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
$contract_year = $_POST["contract_year"];
$shipment_number = $_POST["shipment_number"];
$operation_location = $_POST["operation_location"];
$operation_rate = $_POST["operation_rate"];
$dem_rate = $_POST["dem_rate"];
$des_rate = $_POST["des_rate"];
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
  "UPDATE shipments SET vessel_name=:vessel_name, project_name=:project_name, contract_year=:contract_year, shipment_number=:shipment_number, operation_location=:operation_location, operation_rate=:operation_rate, dem_rate=:dem_rate, des_rate=:des_rate
  WHERE shipment_id=:shipment_id;");

// 4. バインド変数を用意
// $stmt->bindValue(':shipment_password', $shipment_password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':vessel_name', $vessel_name, PDO::PARAM_STR); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':project_name', $project_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':contract_year', $contract_year, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':shipment_number', $shipment_number, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':operation_location', $operation_location, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':operation_rate', $operation_rate, PDO::PARAM_INT); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':dem_rate', $dem_rate, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':des_rate', $des_rate, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':input_group', $input_group, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    } else {
      redirect('./LC_main.php');
}

?>
