<?php

//SESSIONスタート
session_start();

$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

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
    <title>HEADER</title>
</head>

<!--
以下、共通ヘッダー
-->

<div class="site_header01">
    <a href="<?php echo $path; ?>index.php">
        <img class="site_logo" src="<?php echo $path; ?>logo.png">
        </img>
    </a>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_login_user">
                <span class="material-icons">account_circle</span>
                <span class="">LOGIN USER : <?= $user_name; ?></span>
            </li>
            <li class="gnav_menu_item01">
                <a href="<?php echo $path; ?>Account_Control/login.php">
                    <span class="material-icons">login</span><br>
                    login
                </a>
            </li>
            <li class="gnav_menu_item01">
                <a href="<?php echo $path; ?>Account_Control/logout.php">
                <span class="material-icons">logout</span><br>
                    logout
                </a>
            </li>
            <li class="gnav_menu_item01">
                <a href="<?php echo $path; ?>Account_Control/user_register.php">
                <span class="material-icons">person_add</span><br>
                    user登録
                </a>
            </li>
            <li class="gnav_menu_item01"><a href="">XXX</a></li>
        </ul>
    </nav>
</div>

<div class="site_header02">
    <div></div>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item02"><a href="<?php echo $path; ?>Laytime_Count/LC_main.php">LAYTIME CALCULATION</a></li>
            <li class="gnav_menu_item02"><a href="">SHIPMENT LOCATION</a></li>
            <li class="gnav_menu_item02"><a href="">DELIVERY MANAGEMENT</a></li>
            <li class="gnav_menu_item02"><a href="">VESSEL NOMINATION</a></li>
        </ul>
    </nav>
</div>
