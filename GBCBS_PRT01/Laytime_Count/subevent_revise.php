<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../tools.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$shipment_id = $_SESSION['shipment_id'];
$event_id = $_GET['event_id'];
$_SESSION['event_id'] = $event_id;

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
    <title>EVENT_REVISE</title>
</head>

<!--
以下、共通ヘッダー
-->

<!-- 
以下、メイン部分
 -->
<body class="index_background"> 

<div class="event_table01">
        <div class="event_table02">
            <table class="event_table03">
                <tbody id="calculation_sheet">
                    <tr>
                        <th>FROM</th>
                        <th>TO</th>
                        <th>EVENT</th>
                        <th>COUNT</th>
                        <th>MANUAL</th>
                    </tr>

                    <!-- <tr> -->
                        <!-- <form method="post" action="" onsubmit="return before_subevent_register()"> -->
                            <!-- <td>
                                <input type="datetime-local" name="subevent_time_from" id="subevent_time_from" value="">
                            </td>
                            <td>
                                <input type="datetime-local" name="subevent_time_to" id="subevent_time_to" value="">
                            </td>
                            <td>
                                <input type="text" name="subevent_name" id="subevent_name" id="subevent_name">
                            </td>
                            <td>
                                <input type="checkbox" name="subevent_count_flag" id="subevent_count_flag" checked="checked">
                            </td>
                            <td>
                                <button class="subevent_register" id="subevent_register">登録</button>
                            </td> -->
                        <!-- </form> -->
                    <!-- </tr> -->
                    <?php
                        $pdo = db_connect();
                        $stmt = $pdo->prepare("SELECT * FROM events WHERE event_id = :event_id ORDER BY time_from ASC");
                        $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);

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
                        <form method="post" action="./subevent_revise_act.php" class="subevent_revise_form" onsubmit="return beforeSubmit()">
                            <td>
                                <input type="datetime-local" name="subevent_time_from" id="subevent_time_from" value="<?php
                                    echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                ?>">
                            </td>
                            <td>
                                <input type="datetime-local" name="subevent_time_to" id="subevent_time_to" value="<?php
                                    echo date('Y-m-d\TH:i',strtotime($result['time_to']));
                                ?>">
                            </td>
                            <td>
                                <input type="text" name="subevent_name" id="subevent_name" value="<?= $result['event_name'];?>">
                            </td>
                            <td>
                                <input type="checkbox" name="subevent_count_flag" id="subevent_count_flag"
                                    <?php
                                        if($result['count_flag']==1){
                                            echo ' value="1" checked="checked" ';
                                        }else{
                                            echo ' value="0"';
                                        }
                                    ?>
                                >           
                            </td>
                            <td>
                                <span class="material-icons edit">update</span>
                                <button type="submit" class="event_revise_button" name="event_revise_button" id="event_revise_button">
                                    登録内容修正
                                </button>  
                            </td>
                        </form>
                    </tr>
                    <?php
                        }}
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <form method="post" action="./subevent_delete_act.php" class="shipment_delete_form" onsubmit="return beforeDelete()">
            <button type="submit" class="shipment_delete_button">
                登録内容削除
            </button>    
    </form>

        
</body>

<script>

$('#subevent_count_flag').on('change', function(){
    if($('#subevent_count_flag').prop("checked") == true){
        $('#subevent_count_flag').val(1);
    }else{
        $('#subevent_count_flag').val(0);
    };
})

  function beforeSubmit() {
    if(window.confirm('この内容で修正しますがよろしいでしょうか?')) {
      return true;
    } else {
      return false;
    }
  }

  function beforeDelete() {
    if(window.confirm('この内容を削除しますがよろしいでしょうか?')) {

        //更新時にKey Eventならinputを無効化
        if($('#subevent_name').val() == 'arrival_time' || $('#subevent_name').val() == 'nor_tender' || $('#subevent_name').val() == 'berthed_time' ||$('#subevent_name').val() == '#commencement_of_operation' ||$('#subevent_name').val() == 'completion_of_operation' ||$('#subevent_name').val() == 'commencement_of_laytime' ||$('#subevent_name').val() == 'expiration_of_laytime'){
            alert('Key Eventは削除できません');
            return false;
        }

      return true;
    } else {
      return false;
    }
  }

</script>

</html>