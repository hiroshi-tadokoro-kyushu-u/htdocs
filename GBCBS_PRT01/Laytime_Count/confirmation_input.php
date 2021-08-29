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
        <form method="post" action="confirmation_input_act.php" onsubmit="return beforeSubmit()">
            <table class="confirmation_table03">
                <tr>
                    <th>配船pass</th>
                    <td><input type="text" id="shipment_password" name="shipment_password" placeholder="shipment_password" required></td>
                </tr>
            </table>
            <button type="submit" class="shipment_confirmation_button" style="width:100%">新規配船登録</button>    
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