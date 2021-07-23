<?php



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
    <title>USER_REGISTER</title>
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
            <li class="gnav_menu_item01"><a href="./login.php">LOG-IN</a></li>
            <li class="gnav_menu_item01"><a href="./user_register.php">User登録</a></li>
            <li class="gnav_menu_item01"><a href="">XXX</a></li>
        </ul>
    </nav>
</div>

<div class="site_header02">
    <div></div>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item02"><a href="../Laytime_Count/LC_main.php">LAYTIME CALCULATION</a></li>
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

    <div class="login_form_frame">
        REGISTER YOUR ACCOUNT
        <form method="POST" action="./user_register_act.php" onsubmit="return beforeSubmit()">
            <table class="login_form_input">
                <tr>
                    <td>USERNAME(mail-address)</td>
                </tr>
                <tr>
                    <td><input type="text" id="user_name" name="user_name" placeholder="user_name"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                </tr>
                <tr>
                    <td><input type="text" id="user_password" name="user_password" placeholder="user_password"></td>
                </tr>
            </table>
            <input class="login_form_button" type="submit" value="Register">
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
</script>

</html>