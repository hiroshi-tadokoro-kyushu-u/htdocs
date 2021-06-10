<?php

// フォームから送られてきたデータを取得し変数に代入
$name = $_POST["name"];
$mail = $_POST["mail"];

function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>POST（受信）</title>
</head>

<body>

    <?php
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    
    function h ($value) {
        return htmlspecialchars($value,ENT_QUOTES);
        }
    ?>

    <ul>
        <li> お名前：<?= h($name) ?> </li>
        <li> Mail：<?= h($mail) ?> </li>
    </ul>

<ul>
    <li><a href="index.php">戻る</a></li>
</ul>
</body>
</html>