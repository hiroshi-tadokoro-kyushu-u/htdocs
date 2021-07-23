<?php

session_start();

// 1. POSTデータ取得
$user_name = $_POST["user_name"];
// $user_email = $user_name;
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
$stmt = $pdo->prepare("SELECT * FROM Users WHERE user_name = :user_name AND user_password = :user_password");

// 4. バインド変数を用意
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_password', $user_password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

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
if( $val['user_id'] != "" ){
    
//Login成功時
$_SESSION['chk_ssid']  = session_id();
$_SESSION['user_access'] = $val['user_access'];
$_SESSION['user_name'] = $val['user_name'];

redirect('../index.php');

}else{
//Login失敗時(Logout経由)

redirect('./login.php');
}

exit();

?>


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../general.css">
    <script src="../jquery-2.1.3.min.js"></script>
    <title>USER_REGISTER</title>
</head>

<!--
以下、共通ヘッダー
-->

<div class="site_header01">
    <a href="../index.php">
        <img class="site_logo" src="../logo.png">
        </img>
    </a>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item01"><a href="./login.php">LOG-IN</a></li>
            <li class="gnav_menu_item01"><a href="./user_register.php">User登録</a></li>
            <li class="gnav_menu_item01"><a href="">XXX</a></li>
        </ul>
    </nav>
</div>

<div class="site_header02">
    <div></div>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item02"><a href="../Laytime_Count/LC_main.php">LAYTIME CALCULATION</a></li>
            <li class="gnav_menu_item02"><a href="">SHIPMENT LOCATION</a></li>
            <li class="gnav_menu_item02"><a href="">DELIVERY MANAGEMENT</a></li>
            <li class="gnav_menu_item02"><a href="">VESSEL NOMINATION</a></li>
        </ul>
    </nav>
</div>

<!-- 
以下、メイン部分
 -->


</html>