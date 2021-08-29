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
    // 登録情報のメール送信 
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    $to = $_POST["user_email"];
    $subject = "ユーザー登録通知";
    $message = "(このメールアドレスに返信しないでください)\r\nユーザー登録が完了しました。\r\nuser_name = ${_POST["user_name"]}\r\nuser_email = ${_POST["user_email"]}\r\nuser_password = ${_POST["user_password"]}\r\nLog-inして機能テストをお願いします";
    $headers = "From:info@GBCBS_PRT.jp";
    if(mb_send_mail($to, $subject, $message, $headers))
    {
      // echo "メール送信成功です";
    }
    else
    {
      $_SESSION['temp_message'] = "user登録が成功しましたがメール送信に失敗しました。こちらの登録情報からLoginしてください。user_name = ".$_POST["user_name"]." // user_email =".$_POST["user_email"]." // user_password =".$_POST["user_password"];
    }
  
    // アラートメッセージ
    $_SESSION['temp_message'] = "user登録に成功しました。Loginしてください。user_name = ".$_POST["user_name"]." // user_email =".$_POST["user_email"]." // user_password =".$_POST["user_password"];
    
    redirect('../index.php');
}

?>

