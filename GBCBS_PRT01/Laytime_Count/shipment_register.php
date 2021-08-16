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

    <div class="shipment_table01">
        <form method="post" action="./shipment_register_act.php" onsubmit="return beforeSubmit()">
            <table class="shipment_table03">
                <tr>
                    <th>船名</th>
                    <td><input type="text" id="vessel_name" name="vessel_name" placeholder="vessel_name"></td>
                </tr>
                <tr>
                    <th>案件名</th>
                    <td><input type="text" id="project_name" name="project_name" placeholder="project_name"></td>
                </tr>
                <tr>
                    <th>契約年度</th>
                    <td><input type="number" id="contract_year" name="contract_year" placeholder="contract_year、spotの場合は1"></td>
                </tr>
                <tr>
                    <th>配船番号</th>
                    <td><input type="number" id="shipment_number" name="shipment_number" placeholder="shipment_number、spotの場合は1"></td>
                </tr>
                <tr>
                    <th>積地/揚地</th>
                    <td><input type="text" id="operation_location" name="operation_location" placeholder="operation_location"></td>
                </tr>
                <tr>
                    <th>荷役率</th>
                    <td><input type="number" id="operation_rate" name="operation_rate" placeholder="operation_rate(MT/day)"></td>
                </tr>
                <tr>
                    <th>滞船料率</th>
                    <td><input type="number" id="dem_rate" name="dem_rate" placeholder="dem_rate(USD/day)"></td>
                </tr>
                <tr>
                    <th>早出料率</th>
                    <td><input type="number" id="des_rate" name="des_rate" placeholder="des_rate(USD/day)"></td>
            </tr>
            </table>
            <button type="submit" class="shipment_register_button" style="width:100%">新規配船登録</button>    
        </form>
    </div>

</body>

<?php
    include $path.'footer.php';
?>

<script>
  function beforeSubmit() {
    if(window.confirm('この内容で登録しますがよろしいでしょうか?')) {
        if($('#vessel_name').val()=="" || $('#project_name').val()=="" || $('#contract_year').val()=="" ||$('#shipment_number').val()=="" ||$('#operation_location').val()=="" ||$('#operation_rate').val()==""|| $('#dem_rate').val()==""|| $('#des_rate').val()==""){
            alert('入力されていない項目があります');
            return false;
        }
      return true;
    } else {
      return false;
    }
  }
</script>

</html>