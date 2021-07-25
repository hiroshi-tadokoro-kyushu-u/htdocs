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
            <table class="shipment_table02">
                <tr>
                    <th><?= $result['vessel_name'];?></th>
                    <th><?= $result['project_name'];?></th>
                    <th><?= $result['contract_year'];?></th>
                    <th><?= $result['shipment_number'];?></th>
                    <th><?= $result['work_status'];?></th>
                    <th><?php echo '<a href="input.php?shipment_id='.$result['shipment_id'].'">[入力/</a>'.'<a href="revise.php?shipment_id='.$result['shipment_id'].'">修正/削除]</a>'?></th>
                </tr>
            </table>

<?php
}}
?>

