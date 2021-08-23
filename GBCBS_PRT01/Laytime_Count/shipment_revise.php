<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../tools.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$shipment_id = $_GET['shipment_id'];
$_SESSION['shipment_id'] = $shipment_id;

$path = '../'; 
include $path.'header.php';




//以下ログインユーザーのみ

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

    <div class="shipment_table01">
        <form method="post" action="./shipment_revise_act.php" onsubmit="return beforeSubmit()">
            <table class="shipment_table03">

                <?php
                $pdo = db_connect();
                $stmt = $pdo->prepare("SELECT * FROM shipments WHERE shipment_id = :shipment_id");
                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);

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
                    <th>船名</th>
                    <td><input type="text" name="vessel_name" value="<?=$result['vessel_name'];?>"></td>
                </tr>
                <tr>
                    <th>案件名</th>
                    <td><input type="text" name="project_name" value="<?=$result['project_name'];?>"></td>
                </tr>
                <tr>
                    <th>契約年度</th>
                    <td><input type="number" name="contract_year" value="<?=$result['contract_year'];?>"></td>
                </tr>
                <tr>
                    <th>配船番号</th>
                    <td><input type="number" name="shipment_number" value="<?=$result['shipment_number'];?>"></td>
                </tr>
                <tr>
                    <th>積地/揚地</th>
                    <td><input type="text" name="operation_location" value="<?=$result['operation_location'];?>"></td>
                </tr>
                <tr>
                    <th>荷役率</th>
                    <td><input type="number" name="operation_rate" value="<?=$result['operation_rate'];?>"></td>
                </tr>
                <tr>
                    <th>滞船料率</th>
                    <td><input type="number" name="dem_rate" value="<?=$result['dem_rate'];?>"></td>
                </tr>
                <tr>
                    <th>早出料率</th>
                    <td><input type="number" name="des_rate" value="<?=$result['des_rate'];?>"></td>
            </tr>
            <?php
            }}
            ?>
            </table>
            <button type="submit" class="shipment_register_button" style="width:100%">
                登録内容修正
            </button>    
        </form>
    </div>
    
    <form method="post" action="./shipment_delete_act.php" class="shipment_delete_form" onsubmit="return beforeDelete()">
            <button type="submit" class="shipment_delete_button">
                登録内容削除
            </button>    

    </form>

        
</body>

<script>
  function beforeSubmit() {
    if(window.confirm('この内容で修正しますがよろしいでしょうか?')) {
      return true;
    } else {
      return false;
    }
  }

  function beforeDelete() {
    if(window.confirm('この内容を削除しますがよろしいでしょうか?')) {
      return true;
    } else {
      return false;
    }
  }

</script>

</html>