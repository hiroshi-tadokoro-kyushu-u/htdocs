<?php

session_start();
$temp_message = $_SESSION['temp_message'];
if(isset($_SESSION['temp_message'])){echo "<script type='text/javascript'>alert('".$_SESSION['temp_message']."');</script>";}
$_SESSION['temp_message'] = null;

$path = './'; 
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
    <title>INDEX</title>
</head>


<!-- 
以下、メイン部分
 -->


<body class="index_background"> 
    <div class="function_list">
        <!-- <div>
            <div class="catch_copy">
                <div class="catch_copy_title">General Bulker Control Basic System</div>
                <div class="catch_copy_subtitle">(仮称:GBCBS/物流プラットフォーム)</div>
            </div>

            <div class="user_register">
                <a href="./Account_Control/user_register.php">
                    <div class="user_register_text">User登録</div>              
                </a> 
            </div>
        </div> -->
            
        <div class="main_function">
            <a class="function_picture" href="<?php echo $path; ?>Laytime_Count/LC_main.php">
                <div>LAYTIME CALCULATION</div>
                <img src="<?php echo $path; ?>LAYTIME CALCULATION.JPG" alt="">
            </a>
            <a class="function_picture" href="">
                <div>(TBU)SHIPMENT LOCATION</div>
                <img src="<?php echo $path; ?>SHIPMENT LOCATION.JPG" alt="">
            </a>
            <a class="function_picture" href="">
                <div>(TBU)DELIVERY MANAGEMENT</div>
                <img src="<?php echo $path; ?>DELIVERY MANAGEMENT.JPG" alt="">
            </a>
            <a class="function_picture" href="">
                <div>(TBU)VESSEL NOMINATION</div>
                <img src="<?php echo $path; ?>VESSEL NOMINATION.JPG" alt="">
            </a>
        </div>
    </div>


    <!--開発ログ-->
    <div class="application_log">
        <div class="application_log_title">
            開発ログ(ver.α.1.1.1)
        </div>
        <div class="application_log_text">
            2021/08/30 <br>
            ・LAYTIME登録→確認先へのメール送信を追加<br>
            ・LAYTIME CALCULATIONから確認依頼配船の登録→修正を追加<br>
            2021/08/28 <br>
            ・User登録及びLogin周りの機能追加、登録情報を削除<br>
            ・メールアドレス登録→User情報のアドレス送信を追加<br>

        </div>
    </div>

</body>

<?php
    include $path.'footer.php';
?>


</html>