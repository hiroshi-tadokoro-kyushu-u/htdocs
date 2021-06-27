<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$age    = $_POST["age"];
$content = $_POST["content"];


//2. DB接続します
//以下を関数化！
try {
  $db_name = "gs_db3";    //データベース名
  $db_id   = "root";      //アカウント名
  $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
  $db_host = "localhost"; //DBホスト
  $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
exit('DBConnectError:'.$e->getMessage());
}


//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_an_table( id, name, age, email, content, indate )
  VALUES( NULL, :name, :age, :email, :content, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $content, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
  }else{
    //５．index.phpへリダイレクト
    //以下を関数化
    header("Location: index.php");
    exit();
  }