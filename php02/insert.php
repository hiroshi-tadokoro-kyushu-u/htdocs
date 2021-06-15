<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ



// 2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=データベース名;charset=utf8;host=localhost','ユーザー名','パスワード');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}


// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "******* ***** ********( ************* )
  VALUES( ************ )"
);

// 4. バインド変数を用意
$stmt->bindValue('******', *****, ****************);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('******', *****, ****************);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('******', *****, ****************);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  
}
?>
