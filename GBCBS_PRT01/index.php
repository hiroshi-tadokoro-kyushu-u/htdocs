<?php



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./general.css">
    <script src="./jquery-2.1.3.min.js"></script>
    <title>INDEX</title>
</head>

<!--
以下、共通ヘッダー
-->

<div class="site_header01">
    <a href="./index.php">
        <img class="site_logo" src="./logo.png">
        </img>
    </a>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item01"><a href="./Account_Control/login.php">LOG-IN</a></li>
            <li class="gnav_menu_item01"><a href="./Account_Control/user_register.php">User登録</a></li>
            <li class="gnav_menu_item01"><a href="">XXX</a></li>
        </ul>
    </nav>
</div>

<div class="site_header02">
    <div></div>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item02"><a href="./Laytime_Count/LC_main.php">LAYTIME CALCULATION</a></li>
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
    <div class="function_list">
        <div>
            <div class="catch_copy">
                <div class="catch_copy_title">General Bulker Control Basic System</div>
                <div class="catch_copy_subtitle">(仮称:GBCBS/物流プラットフォーム)</div>
            </div>

            <div class="user_register">
                <a href="./Account_Control/user_register.php">
                    <div class="user_register_text">User登録</div>              
                </a> 
            </div>
        </div>
            
        <div class="main_function">
            <a class="function_picture" href="./Laytime_Count/LC_main.php">
                <div>LAYTIME CALCULATION</div>
                <img src="./LAYTIME CALCULATION.JPG" alt="">
            </a>
            <a class="function_picture" href="">
                <div>SHIPMENT LOCATION</div>
                <img src="./SHIPMENT LOCATION.JPG" alt="">
            </a>
            <a class="function_picture" href="">
                <div>DELIVERY MANAGEMENT</div>
                <img src="./DELIVERY MANAGEMENT.JPG" alt="">
            </a>
            <a class="function_picture" href="">
                <div>VESSEL NOMINATION</div>
                <img src="./VESSEL NOMINATION.JPG" alt="">
            </a>
        </div>
    </div>

</body>


</html>