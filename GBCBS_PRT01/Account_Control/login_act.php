<?php

session_start();

// 1. POSTデータ取得
$user_name = $_POST["user_name"];
$user_email = $_POST["user_email"];
$user_password = $_POST["user_password"];
// $user_group = "MC";
// $user_access = 1;

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
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name and user_email = :user_email");

// 4. バインド変数を用意
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_email', $user_email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':user_password', $user_password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    } 
    
$val = $stmt->fetch(); //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
//* if(password_verify($lpw, $val["lpw"])){
if( password_verify($user_password, $val['user_password'])){

//Login成功時
$_SESSION['chk_ssid']  = session_id();
$_SESSION['user_access'] = $val['user_access'];
$_SESSION['user_name'] = $val['user_name'];
$_SESSION['user_id'] = $val['user_id'];

$_SESSION['temp_message'] = "Loginに成功しました。";
redirect('../index.php');

}else{
//Login失敗時(Logout経由)
$_SESSION['temp_message'] = "Loginに失敗しました。再度Loginしてください";
redirect('./login.php');
}

exit();

?>
