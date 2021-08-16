<?php

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
        REGISTER YOUR ACCOUNT
        <form method="POST" action="./user_register_act.php" onsubmit="return beforeSubmit()">
            <table class="login_form_input">
                <!-- <tr>
                    <td>USERNAME(mail-address)</td>
                </tr> -->
                <tr>
                    <td><span class="material-icons">person</span><input type="text" id="user_name" name="user_name" placeholder="user_name"></td>
                </tr>
                <!-- <tr>
                    <td>PASSWORD</td>
                </tr> -->
                <tr>
                    <td><span class="material-icons">vpn_key</span><input type="text" id="user_password" name="user_password" placeholder="user_password"></td>
                </tr>
            </table>
            <input class="login_form_button" type="submit" value="Register">
        </form>
    </div>

</body>


<?php
    include $path.'footer.php';
?>

<script>
  function beforeSubmit() {
    if(window.confirm('この内容で登録しますがよろしいでしょうか?')) {
      return true;
    } else {
      return false;
    }
  }
</script>

<!--USER重複チェック-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#user_name').blur(function(){
        var check_str = $(this).val();
        //Ajax送信開始
        if(check_str){
            $.ajax({
                url: 'user_unique_check.php',
                type:"POST",
                data:{
                    check: check_str,
                },
                // dataType: 'json',
                success: function() {
                    console.log("success");
                },
                error: function() {
                    console.log("error"); //戻り値Allオブジェクト
                },

            }).done(function(flag){
                if(flag == 1){
                    alert('そのメールアドレスは既に登録されています');
                    $('#user_name').val('');
                }
            })
        }
    });
</script>

</html>