<?php

$path = './'; 

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
以下、共通ヘッダー
-->
<?php
    include $path.'header.php';
?>

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

</body>

<?php
    include $path.'footer.php';
?>


</html>