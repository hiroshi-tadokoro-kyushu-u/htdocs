<?php

session_start();

// 1. POSTデータ取得
$user_name = $_POST["user_name"];
$user_email = $_POST["user_email"];
$user_password = password_hash($_POST["user_password"],PASSWORD_DEFAULT);
$user_group = "MC";
$user_access = 1;

// 2. DB接続します

// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=package_matching;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }


require_once('../tools.php');
$pdo = db_connect();

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO users(user_name, user_email, user_password, user_group, user_access)
  VALUES(:user_name, :user_email, :user_password, :user_group, :user_access)");

// 4. バインド変数を用意
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_email', $user_email, PDO::PARAM_STR); //  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_password', $user_password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_group', $user_group, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_access', $user_access, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();


// 6．データ登録処理後
if($status == false){
    sql_error($stmt);
}else{
    $_SESSION['temp_message'] = "user登録に成功しました。Loginしてください";
    redirect('../index.php');
}

?>

