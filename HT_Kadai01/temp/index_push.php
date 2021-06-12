<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

</body>
</html>