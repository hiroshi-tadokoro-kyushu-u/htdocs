<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../tools.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
//以下ログインユーザーのみ

$path = '../'; 
include $path.'header.php';


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $path; ?>reset.css">
    <link rel="stylesheet" href="<?php echo $path; ?>general.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?php echo $path; ?>jquery-2.1.3.min.js"></script>
    <title>LC_MAIN</title>
</head>

<!--
以下、共通ヘッダー
-->


<!-- 
以下、メイン部分
 -->
<body class="index_background"> 

    <div class="shipment_register">
        <a class="shipment_register_button" href="./shipment_register.php">新規配船登録</a>    
    </div>

    <div class="shipment_table01">
        <form method="post" action="">
            <table class="shipment_table02">
                <tr>
                    <th>船名</th>
                    <th>案件名</th>
                    <th>契約年度</th>
                    <th>配船番号</th>
                    <th>作業進捗</th>
                    <th>入力/修正/削除</th>
                </tr>

                <?php
                $pdo = db_connect();
                $stmt = $pdo->prepare("SELECT * FROM shipments WHERE input_id = :user_id");
                $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

                //3. 実行
                $status = $stmt->execute();
                //4．データ表示

                if($status==false) {
                //execute（SQL実行時にエラーがある場合）
                $error = $stmt->errorInfo();
                exit("ErrorQuery:".$error[2]);
                }else{
                //Selectデータの数だけ自動でループしてくれる
                //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
                while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><?= $result['vessel_name'];?></td>
                    <td><?= $result['project_name'];?></td>
                    <td><?= $result['contract_year'];?></td>
                    <td><?= $result['shipment_number'];?></td>
                    <td><?= $result['work_status'];?></td>
                    <td><?php echo '<a href="shipment_input.php?shipment_id='.$result['shipment_id'].'"><span class="material-icons edit">edit</span>入力</a>'.'<span> / </span>'.'<a href="shipment_revise.php?shipment_id='.$result['shipment_id'].'"><span class="material-icons edit">update</span>修正/削除</a>'?></td>
                </tr>

                <?php
                }}
                ?>
            </table>
        </form>
    </div>

</body>

<?php
    include $path.'footer.php';
?>

</html>