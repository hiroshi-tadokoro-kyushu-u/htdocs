<?php

// 1. POSTデータ取得
$order_number = $_POST["order_number"];
$product_name = $_POST["product_name"];
$point_from = $_POST["point_from"];
$point_to = $_POST["point_to"];
$time_from = $_POST["time_from"];
$time_to = $_POST["time_to"];


echo $order_number.'<br>';
echo $product_name.'<br>';
echo $point_from.'<br>';
echo $point_to.'<br>';
echo $time_from.'<br>';
echo $time_to.'<br>';

// 2. DB接続します

// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=package_matching;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

require_once('tools.php');
$pdo = db_connect();

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "UPDATE product SET order_number=:order_number, product_name=:product_name, point_from=:point_from, point_to=:point_to, time_from=:time_from, time_to=:time_to
  WHERE order_number=:order_number;");

// 4. バインド変数を用意
$stmt->bindValue(':order_number', $order_number, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':product_name', $product_name, PDO::PARAM_STR); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':point_from', $point_from, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':point_to', $point_to, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':time_from', $time_from, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':time_to', $time_to, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


// 5. 実行
$status = $stmt->execute();


// 6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    } else {
      redirect('index.php');
}?>
