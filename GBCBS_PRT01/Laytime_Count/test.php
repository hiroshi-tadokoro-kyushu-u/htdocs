<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('../tools.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$shipment_id = $_GET['shipment_id'];
$_SESSION['shipment_id'] = $shipment_id;

//以下ログインユーザーのみ

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="../general.css">
    <script src="../jquery-2.1.3.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <title>SHIPMENT_REGISTER</title>

</head>
<body>
<div class="event_table01">
    <div class="event_table02" method="post" action="">
        <table class="event_table03">
            <tbody>
            <tr>
                <th>FROM</th>
                <th>TO</th>
                <th>EVENT</th>
                <th>COUNT</th>
                <th>MANUAL</th>
            </tr>

            <tr>
                <td><input type="text" name="name"></td>
                <td><input type="text" name="name"></td>
                <td><button class="remove">-</button></td>
            </tr>
            <tr>
                <td><input type="text" name="name"></td>
                <td><input type="text" name="name"></td>
                <td><button class="remove">-</button></td>
            </tr>
            <?php
                $pdo = db_connect();
                $stmt = $pdo->prepare("SELECT * FROM events WHERE shipment_id = :shipment_id ORDER BY time_from ASC");
                $stmt->bindValue(':shipment_id', $shipment_id, PDO::PARAM_INT);

                //3. 実行
                $status = $stmt->execute();
                //4．データ表示
                if($status==false) {
                //execute（SQL実行時にエラーがある場合）
                $error = $stmt->errorInfo();
                exit("ErrorQuery:".$error[2]);
                }else{
                //Selectデータの数だけ自動でループしてくれる
                //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
                while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?= $result['time_from'];?></td>
                <td><?= $result['time_to'];?></td>
                <td><?= $result['event_name'];?></td>
                <td><?= $result['count_flag'];?></td>
                <td><?php echo '<a href="shipment_input.php?event_id='.$result['event_id'].'">[ (入力) / </a>'.'<a href="shipment_revise.php?event_id='.$result['event_id'].'">(修正/削除)]</a>'?></td>
            </tr>
            <?php
                }}
            ?>

            </tbody>
        </table>
        <button id="addRow">+ 追加</button>
        <button id="getValues">値を取得</button>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
$(function(){
    $('tbody').sortable();

    $('#addRow').click(function(){
        var html = '<tr><td><input type="text" name="name"></td><td><button class="remove">-</button></td></tr>';
        $('tbody').append(html);
    });

    // $(document).on('click', '.remove', function() {
    //     $(this).parents('tr').remove();
    // });

    // $('#getValues').click(function(){
    //     var values = [];
    //     $('input[name="name"]').each(function(i, elem){
    //         values.push($(elem).val());
    //     });
    //     alert(values.join(', '));
    // });
});
</script>
</body>
</html>