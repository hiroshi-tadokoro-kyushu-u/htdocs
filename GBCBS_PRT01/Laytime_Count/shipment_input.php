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

//以下ログインユーザーのみ

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../general.css">
    <script src="../jquery-2.1.3.min.js"></script>
    <title>SHIPMENT_REGISTER</title>
</head>

<!--
以下、共通ヘッダー
-->

<div class="site_header01">
    <a href="../index.php">
        <img class="site_logo" src="../logo.png">
        </img>
    </a>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li>LOGIN USER : <?= $user_name; ?></li>
            <li class="gnav_menu_item01"><a href="../Account_Control/login.php">LOG-IN</a></li>
            <li class="gnav_menu_item01"><a href="../Account_Control/user_register.php">User登録</a></li>
            <li class="gnav_menu_item01"><a href="">XXX</a></li>
        </ul>
    </nav>
</div>

<div class="site_header02">
    <div></div>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item02"><a href="./LC_main.php">LAYTIME CALCULATION</a></li>
            <li class="gnav_menu_item02"><a href="">SHIPMENT LOCATION</a></li>
            <li class="gnav_menu_item02"><a href="">DELIVERY MANAGEMENT</a></li>
            <li class="gnav_menu_item02"><a href="">VESSEL NOMINATION</a></li>
        </ul>
    </nav>
</div>

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
                    <th>「入力済み情報」</th>
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
                    <td><?=$result['dem_rate'];?></td>
                </tr>
                <tr>
                    <th>早出料率</th>
                    <td><?=$result['des_rate'];?></td>
            </tr>
            <?php
            }}
            ?>
            </table>
        </div>

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
                        <td><input type="number" name="loading_volume" value="<?=$result['loading_volume'];?>"></td>
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

                    <?php
                    ?>
                    <tr>
                        <th>Arrival Time</th>
                        <td>
                            <input type="text" name="arrival_time" value="
                                <?php
                                    $pdo = db_connect();
                                    $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id AND event_name = 'arrival_time';");
                                    $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);
                                    $status = $stmt->execute();
                                    if($status==false){
                                        $error = $stmt->errorInfo();
                                        exit("ErrorQuery:".$error[2]);
                                    }else{                                
                                        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                            echo date('Y-m-d\TH:i', strtotime($result['time_from']));
                                        }
                                    }
                                ?>
                            ">
                        </td>
                    </tr>
                    <tr>
                        <th>Notice of Readiness Tender</th>
                        <td><input type="datetime-local" name="contract_year" value="2022-07-25T23:55"></td>
                    </tr>
                    <tr>
                        <th>Berthed Time</th>
                        <td><input type="datetime-local" name="shipment_number" value="<?=$result['shipment_number'];?>"></td>
                    </tr>
                    <tr>
                        <th>Commencement of Operation</th>
                        <td><input type="datetime-local" name="operation_location" value="<?=$result['operation_location'];?>"></td>
                    </tr>
                    <tr>
                        <th>Completion of Operation</th>
                        <td><input type="datetime-local" name="operation_rate" value="<?=$result['operation_rate'];?>"></td>
                    </tr>
                    <tr>
                        <th>Commencement of Laytime</th>
                        <td><input type="datetime-local" name="dem_rate" value="<?=$result['dem_rate'];?>"></td>
                    </tr>
                    <tr>
                        <th>Expiration of Laytime</th>
                        <td><?=$result['des_rate'];?></td>
                    </tr>
                </table>
                <button type="submit" class="key_event_register_button" style="width:100%">
                    Key Event登録 / 詳細入力
                </button>    
            </form>
        </div>
    </div>
    
    <hr class="hr01">

    <div class="event_table01">
        <form class="event_table02" method="post" action="">
            <table class="event_table03">
                <tr>
                    <th>FROM</th>
                    <th>TO</th>
                    <th>EVENT</th>
                    <th>COUNT</th>
                    <th>MANUAL</th>
                </tr>

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
                    <td><?= $result['count_flag'];?></td>
                    <td><?php echo '<a href="shipment_input.php?event_id='.$result['event_id'].'">[ (入力) / </a>'.'<a href="shipment_revise.php?event_id='.$result['event_id'].'">(修正/削除)]</a>'?></td>
                </tr>

                <?php
                }}
                ?>
            </table>
        </form>
    </div>




</body>

<script>
    function beforeSubmit() {
        if(window.confirm('この内容で登録しますがよろしいでしょうか?')) {
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>


    // $('#user_name').blur(function(){
    //     var check_str = $(this).val();
    //     //Ajax送信開始
    //     if(check_str){
    //         $.ajax({
    //             url: 'user_unique_check.php',
    //             type:"POST",
    //             data:{
    //                 check: check_str,
    //             },
    //             // dataType: 'json',
    //             success: function() {
    //                 console.log("success");
    //             },
    //             error: function() {
    //                 console.log("error"); //戻り値Allオブジェクト
    //             },

    //         }).done(function(flag){
    //             if(flag == 1){
    //                 alert('そのメールアドレスは既に登録されています');
    //                 $('#user_name').val('');
    //             }
    //         })
    //     }
    // });

</script>




</html>