<?php

$path = '../'; 

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

    <div class="login_form_frame">
        LOGIN TO YOUR ACCOUNT
        <form method="POST" action="./login_act.php">
            <table class="login_form_input">
                <!-- <tr>
                    <td>USERNAME(mail-address)</td>
                </tr> -->
                <tr>
                    <td><span class="material-icons">person</span><input type="text" name="user_name" placeholder="username"></td>
                </tr>
                <!-- <tr>
                    <td>PASSWORD</td>
                </tr> -->
                <tr>
                    <td><span class="material-icons">vpn_key</span><input type="text" name="user_password" placeholder="password"></td>
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