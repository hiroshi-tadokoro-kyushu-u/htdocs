<?php

session_start();
$temp_message = $_SESSION['temp_message'];

$path = '../'; 
include $path.'header.php';

if(isset($_SESSION['temp_message'])){echo "<script type='text/javascript'>alert('".$_SESSION['temp_message']."');</script>";}
$_SESSION['temp_message'] = null;


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

<!-- 
以下、メイン部分
 -->
<body class="index_background"> 

    <div class="login_form_frame">
        LOGIN TO YOUR ACCOUNT
        <form method="POST" action="./login_act.php">
            <table class="login_form_input">
                <tr>
                    <td><span class="material-icons">person</span><input type="text" required id="user_name" name="user_name" placeholder="user_name"></td>
                </tr>
                <tr>
                    <td><span class="material-icons">email</span><input type="email" required id="user_email" name="user_email" placeholder="user_email"></td>
                </tr>
                <tr>
                    <td><span class="material-icons">vpn_key</span><input type="text" required id="user_password" name="user_password" placeholder="user_password"></td>
                </tr>
                </tr>
            </table>
            <input class="login_form_button" type="submit" value="Log in">
        </form>
    </div>

</body>

<?php
    include $path.'footer.php';
?>

</html>
