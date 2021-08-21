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

//LAYTIME CALCULATION用の関数用意
$commencement_of_laytime = null;
$allowed_laytime = null;
$total_nocount_time = 0;
$completion_of_operation = null;
$dem_rate = null;
$des_rate = null;

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
    <title>SHIPMENT INPUT</title>
</head>

<!--
以下、共通ヘッダー
-->

<!-- 
以下、メイン部分
 -->
<body class="index_background"> 

    <div class="shipment_table01">
        <div class="shipment_table04_outline">
            <table class="shipment_table04">
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
                    <th colspan="2">「入力済み情報」</th>
                </tr>
                <tr>
                    <th>船名</th>
                    <td><?=$result['vessel_name'];?></td>
                </tr>
                <tr>
                    <th>案件名</th>
                    <td><?=$result['project_name'];?></td>
                </tr>
                <tr>
                    <th>契約年度</th>
                    <td><?=$result['contract_year'];?></td>
                </tr>
                <tr>
                    <th>配船番号</th>
                    <td><?=$result['shipment_number'];?></td>
                </tr>
                <tr>
                    <th>積地/揚地</th>
                    <td><?=$result['operation_location'];?></td>
                </tr>
                <tr>
                    <th>荷役率</th>
                    <td><?=$result['operation_rate'];?></td>
                </tr>
                <tr>
                    <th>滞船料率</th>
                    <td><?php
                        echo $result['dem_rate'];
                        $dem_rate = $result['dem_rate'];
                    ?></td>
                </tr>
                <tr>
                    <th>早出料率</th>
                    <td><?php
                        echo $result['des_rate'];
                        $des_rate = $result['des_rate'];
                    ?></td>
                </tr>
            <?php
            }}
            ?>
            </table>
        </div>


<!-- MAIN EVENT入力部分 -->
        <div class="shipment_table04_outline">
            <form method="post" action="./event_input_act.php" onsubmit="return beforeSubmit()">
                <table class="shipment_table05">

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
                        <th>Loading Volume(MT)</th>
                        <td><input type="number" name="loading_volume" id="loading_volume" min="1" value="<?php
                            echo $result['loading_volume'];?>">
                        </td>
                    </tr>

                    <tr>
                        <th>Allowed Laytime(days)</th>
                        <td>
                            <?php
                                $allowed_laytime = $result['loading_volume'] / $result['operation_rate'];
                                echo number_format($allowed_laytime,6);
                            ?>
                        </td>
                    </tr>

                    <?php
                        }}
                    ?>

<!--KEY TIME入力部分-->

                    <?php
                    ?>
                    <tr>
                        <th>Arrival Time</th>
                        <td>
                            <input type="datetime-local" name="arrival_time" id="arrival_time" value="<?php
                                $pdo = db_connect();
                                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'arrival_time';");
                                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                $status = $stmt->execute();
                                if($status==false){
                                    $error = $stmt->errorInfo();
                                    exit("ErrorQuery:".$error[2]);
                                }else{                                
                                    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                    }
                                }
                            ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Notice of Readiness Tender</th>
                        <td><input type="datetime-local" name="nor_tender" id="nor_tender" value="<?php
                                $pdo = db_connect();
                                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'nor_tender';");
                                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                $status = $stmt->execute();
                                if($status==false){
                                    $error = $stmt->errorInfo();
                                    exit("ErrorQuery:".$error[2]);
                                }else{                                
                                    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                    }
                                }
                            ?>"></td>
                    </tr>
                    <tr>
                        <th>Berthed Time</th>
                        <td><input type="datetime-local" name="berthed_time" id="berthed_time" value="<?php
                                $pdo = db_connect();
                                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'berthed_time';");
                                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                $status = $stmt->execute();
                                if($status==false){
                                    $error = $stmt->errorInfo();
                                    exit("ErrorQuery:".$error[2]);
                                }else{                                
                                    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                    }
                                }
                            ?>"></td>
                    </tr>
                    <tr>
                        <th>Commencement of Operation</th>
                        <td><input type="datetime-local" name="commencement_of_operation" id="commencement_of_operation" value="<?php
                                $pdo = db_connect();
                                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'commencement_of_operation';");
                                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                $status = $stmt->execute();
                                if($status==false){
                                    $error = $stmt->errorInfo();
                                    exit("ErrorQuery:".$error[2]);
                                }else{                                
                                    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                    }
                                }
                            ?>"></td>
                    </tr>
                    <tr>
                        <th>Completion of Operation</th>
                        <td><input type="datetime-local" name="completion_of_operation" id="completion_of_operation" value="<?php
                                $pdo = db_connect();
                                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'completion_of_operation';");
                                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                $status = $stmt->execute();
                                if($status==false){
                                    $error = $stmt->errorInfo();
                                    exit("ErrorQuery:".$error[2]);
                                }else{                                
                                    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                        $completion_of_operation = date('Y-m-d\TH:i',strtotime($result['time_from']));
                                    }
                                }
                            ?>"></td>
                    </tr>
                    <tr>
                        <th>Commencement of Laytime</th>
                        <td><input type="datetime-local" name="commencement_of_laytime" id="commencement_of_laytime" value="<?php
                                $pdo = db_connect();
                                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'commencement_of_laytime';");
                                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                $status = $stmt->execute();
                                if($status==false){
                                    $error = $stmt->errorInfo();
                                    exit("ErrorQuery:".$error[2]);
                                }else{                                
                                    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo date('Y-m-d\TH:i',strtotime($result['time_from']));
                                        $commencement_of_laytime = date('Y-m-d\TH:i',strtotime($result['time_from']));
                                    }
                                }
                            ?>"></td>
                    </tr>
                    <tr>
                        <th>Expiration of Laytime</th>
                        <td><?php                          
                            if($commencement_of_laytime == null){

                            }else{
                                echo date('Y-m-d H:i',strtotime($commencement_of_laytime)+$allowed_laytime*(60 * 60 * 24)+$total_nocount_time);
                                $eol = date('Y-m-d H:i',strtotime($commencement_of_laytime)+$allowed_laytime*(60 * 60 * 24)+$total_nocount_time);
                                expiration_of_laytime_update($eol,$shipment_id);
                            }
                        ?></td>
                    </tr>
                </table>
                <button type="submit" class="key_event_register_button" id="key_event_register_button" style="width:100%">
                    Key Event登録 / 詳細入力
                </button>    
            </form>
        </div>
    </div>
    
    <hr class="hr01">
    
<!--TIME SHEET部分-->

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
                        $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id ORDER BY time_from ASC");
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
                        <td><?= $result['time_from'];?></td>
                        <td><?= $result['time_to'];?></td>
                        <td><?= $result['event_name'];?></td>
                        <td>
                            <?php
                                if($result['count_flag']==1){
                                    echo '<input type="checkbox" checked="checked" disabled="disabled">';
                                }else{
                                    echo '<input type="checkbox" disabled="disabled">';
                                    $time_dif = (strtotime($result['time_to']) - strtotime($result['time_from']))/60/60/24;
                                    $total_nocount_time = $total_nocount_time + $time_dif;
                                }
                            ?>
                        </td>
                        <td><?php echo '<a href="./subevent_revise.php?event_id='.$result['event_id'].'"><span class="material-icons edit">update</span>修正/削除</a>'?></td>
                    </tr>
                    <?php
                        }}
                    ?>
                    <tr>
                        <!-- <form method="post" action="" onsubmit="return before_subevent_register()"> -->
                            <td>
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
                            </td>
                        <!-- </form> -->
                    </tr>

                </tbody>
            </table>
            <button id="page_reload">ページを更新</button>
        </div>
    </div>
    
    <hr class="hr01">
    
<!--LAYTIME CAL部分-->

    <div class="event_table01">
        <div>「LAYTIME CALCULATION」
            <table class="laytime_count_table01">
                <tr>
                    <td>
                        Commencement_of_Laytime <br>
                        <?php
                            echo date('Y-m-d H:i',strtotime($commencement_of_laytime));
                        ?>
                    </td>
                    <td>
                        Allowed_Laytime <br>
                        <?=$allowed_laytime;?>days
                    </td>
                    <td>
                        Total_no count_time <br>
                        <?=$total_nocount_time;?>days<br>
                        (<?=floor($total_nocount_time);?> d / <?= floor(($total_nocount_time - floor($total_nocount_time))*24);?> h / <?= floor((($total_nocount_time - floor($total_nocount_time))*24 - floor(($total_nocount_time - floor($total_nocount_time))*24))*60);?> m)
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        (A)Expiration_of_Laytime
                    </td>
                    <td>
                        <?php    
                        echo date('Y-m-d H:i',strtotime($commencement_of_laytime)+$allowed_laytime*(60 * 60 * 24)+$total_nocount_time*(60 * 60 * 24));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                       (B)Completion_of_Operation
                    </td>
                    <td>
                        <?php    
                        echo date('Y-m-d H:i',strtotime($completion_of_operation));
                        ?>
                    </td>
                </tr>
                <tr>
                <td colspan="2">
                       (B) - (A)
                    </td>
                    <td>
                        <?php    
                        echo $dem_des = (strtotime($completion_of_operation) - (strtotime($commencement_of_laytime)+$allowed_laytime*(60 * 60 * 24)+$total_nocount_time*(60 * 60 * 24)))/60/60/24;
                        ?>days
                    </td>
                </tr>
                <tr>
                    <td>
                        (+)Demurrage Amount <br>
                        (-)Despatch Amount
                    </td>
                    <td>
                        <?php
                            if($dem_des >=0){
                                echo 'Demurrage Rate<br>'.$dem_rate.'USD/day';
                            }else{
                                echo 'Despatch Rate<br>'.$des_rate.'USD/day';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($dem_des >=0){
                                echo $dem_des_amount = ((strtotime($completion_of_operation) - (strtotime($commencement_of_laytime)+$allowed_laytime*(60 * 60 * 24)+$total_nocount_time*(60 * 60 * 24)))/60/60/24)*$dem_rate.'USD';
                            }else{
                                echo $dem_des_amount = ((strtotime($completion_of_operation) - (strtotime($commencement_of_laytime)+$allowed_laytime*(60 * 60 * 24)+$total_nocount_time*(60 * 60 * 24)))/60/60/24)*$des_rate.'USD';
                            }
                        ?>

                    </td>
                </tr>
            </table>

        </div>
    </div>


</body>

<?php
    include $path.'footer.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function(){
        $('#calculation_sheet').sortable();

        // $('#addRow').click(function(){
        //     var html = '<tr><form method="post" action="subevent_input_act.php">a<td><input type="datetime-local" name="subevent_time_from" id="subevent_time_from" value=""></td><td><input type="datetime-local" name="subevent_time_to" id="subevent_time_to" value=""></td><td><input type="text" name="subevent_name" id="subevent_name" id="subevent_name"></td><td><input type="checkbox" name="subevent_count_flag" id="subevent_count_flag" checked="checked"></td><td><button class="subevent_register" id="subevent_register">登録</button></td></form></tr>';
        //     $('#calculation_sheet').append(html);
        // });

        // $(document).on('click', '.remove', function() {
        //     $(this).parents('tr').remove();
        // });

        // $('#getValues').click(function(){
        //     var values = [];
        //     $('input[name="name"]').each(function(i, elem){
        //         values.push($(elem).val());
        //     });
        //     alert(values.join(', '));
        // });
    });

    function beforeSubmit() {
        if(window.confirm('この内容で登録しますがよろしいでしょうか?')) {
            if($('#arrival_time').val()=="" || $('#nor_tender').val()=="" || $('#berthed_time').val()=="" ||$('#commencement_of_operation').val()=="" ||$('#completion_of_operation').val()=="" ||$('#commencement_of_laytime').val()==""){
                alert('入力されていない項目があります');
                return false;
            }
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

<!--Key_Event入力-->
<script>

    $('#arrival_time').blur(function(){
        var check_str = $(this).val();
        if(check_str ==""){
            alert('arrival_timeを入力してください。アラートが繰り返し出る場合は「戻る」若しくは「更新」を押して下さい');
        }else{
            if($('#nor_tender').val()==""){
                $('#nor_tender').val(check_str);
            }
        }
    });

    $('#nor_tender').blur(function(){
        var check_str = $(this).val();
        if(check_str ==""){
            alert('nor_tenderを入力してください。アラートが繰り返し出る場合は「戻る」若しくは「更新」を押して下さい');
        }else{
            if($('#berthed_time').val()==""){
                $('#berthed_time').val(check_str);
            }
            if($('#commencement_of_laytime').val()==""){
                $('#commencement_of_laytime').val(check_str);
            }
        }
    });

    $('#berthed_time').blur(function(){
        var check_str = $(this).val();
        if(check_str ==""){
            alert('berthed_timeを入力してください。アラートが繰り返し出る場合は「戻る」若しくは「更新」を押して下さい');
        }else{
            if($('#commencement_of_operation').val()==""){
                $('#commencement_of_operation').val(check_str);
            }
        }
    });

    $('#commencement_of_operation').blur(function(){
        var check_str = $(this).val();
        if(check_str ==""){
            alert('commencement_of_operationを入力してください。アラートが繰り返し出る場合は「戻る」若しくは「更新」を押して下さい');
        }else{
            if($('#completion_of_operation').val()==""){
                $('#completion_of_operation').val(check_str);
            }
        }
    });

    //ページ読み込み時にinputを無効か
    $(document).ready(function(){
        if($('#loading_volume').val()!=""){
            document.getElementById("loading_volume").setAttribute("readOnly", true);
        }
        if($('#arrival_time').val()!=""){
            document.getElementById("arrival_time").setAttribute("readOnly", true);
        }
        if($('#nor_tender').val()!=""){
            document.getElementById("nor_tender").setAttribute("readOnly", true);
        }
        if($('#berthed_time').val()!=""){
            document.getElementById("berthed_time").setAttribute("readOnly", true);
        }
        if($('#commencement_of_operation').val()!=""){
            document.getElementById("commencement_of_operation").setAttribute("readOnly", true);
        }
        if($('#completion_of_operation').val()!=""){
            document.getElementById("completion_of_operation").setAttribute("readOnly", true);
        }
        if($('#commencement_of_laytime').val()!=""){
            document.getElementById("commencement_of_laytime").setAttribute("readOnly", true);
        }
        if($('#commencement_of_laytime').val()!=""){
            document.getElementById("key_event_register_button").setAttribute("disabled", true);
            $('#key_event_register_button').css({background:'var(--sub--color04)'});
        }
        
    });




    // function before_subevent_register() {
    //     if(window.confirm('この内容で登録しますがよろしいでしょうか?')) {
    //         if($('#arrival_time').val()=="" || $('#nor_tender').val()=="" || $('#berthed_time').val()=="" ||$('#commencement_of_operation').val()=="" ||$('#completion_of_operation').val()=="" ||$('#commencement_of_laytime').val()==""){
    //             alert('入力されていない項目があります');
    //             return false;
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    $('#subevent_time_from').blur(function(){
        var check_str = $(this).val();
        if($('#subevent_time_to').val()==""){
            $('#subevent_time_to').val(check_str);
        }
    });

    $('#subevent_time_to').blur(function(){
        if($('#subevent_time_to').val() < $('#subevent_time_from').val()){
            alert('toがfromより前の時点となってます、再度入力してください。アラートが繰り返し出る場合は「戻る」若しくは「更新」を押して下さい。');
            $('#subevent_time_to').val("");
        }
    });


    // Ajax通信の登録
    $('#subevent_register').on('click',function(){
        var subevent_time_from = $('#subevent_time_from').val();
        var subevent_time_to = $('#subevent_time_to').val();
        var subevent_name = $('#subevent_name').val();
        var subevent_count_flag = 1;

        if($('#subevent_count_flag').prop("checked") == true){
            subevent_count_flag=1;
        }else{
            subevent_count_flag=0;
        };

        if($('#subevent_time_from').val()=="" || $('subevent_time_to').val()=="" || $('#subevent_name').val()==""){
            alert('入力されていない項目があります');
            return false;
        }else{
            // Ajax送信開始
            $.ajax({
            url: 'subevent_input_act.php',
            type:"POST",
            data:{
                subevent_time_from: subevent_time_from,
                subevent_time_to: subevent_time_to,
                subevent_name: subevent_name,
                subevent_count_flag: subevent_count_flag,
            },
            // dataType: 'json',
            success: function() {
                console.log("success");
            },
            error: function() {
                console.log("error"); //戻り値Allオブジェクト
            },

            }).done(function(){
                alert('登録しました');
                $('#subevent_time_from').replaceWith(subevent_time_from);
                $('#subevent_time_to').replaceWith(subevent_time_to);
                $('#subevent_name').replaceWith(subevent_name);
                location.reload();
            })
        }
    });

    $('#page_reload').on('click', function(){
        location.reload();
    })


</script>




</html>