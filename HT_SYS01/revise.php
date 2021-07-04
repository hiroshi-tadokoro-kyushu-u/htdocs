<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./toppage.css">
    <script src="./jquery-2.1.3.min.js"></script>
    <title>データ修正</title>
</head>
<body>

<?php
//1.  DB接続します
// try {
//     //Password:MAMP='root',XAMPP=''
//     $pdo = new PDO('mysql:dbname=package_matching;charset=utf8;host=localhost','root','root');
//     } catch (PDOException $e) {
//     exit('DBConnectError:'.$e->getMessage());
//     }

    require_once('tools.php');
    $pdo = db_connect();

    $order_number = $_GET["order_number"];

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM product WHERE order_number=:order_number;");
$stmt->bindValue(':order_number',$order_number,PDO::PARAM_INT);

//3. 実行
$status = $stmt->execute();

?>

    <div id="workspace_02" class="workspace">
        <div class="table_space">
            <form method="post" action="update.php">
                <table class="input_table">
                    
                    <tr>
                        <th style="width: 150px;">注文番号</th>
                        <th style="width: 150px;">製品名</th>
                        <th style="width: 150px;">出荷地点</th>
                        <th style="width: 150px;">発送先</th>
                        <th style="width: 150px;">発送時間(From)</th>
                        <th style="width: 150px;">発送時間(To)</th>
                        <th>登録</th>
                    </tr>

                    <?php
                        echo '<tr>';
                        //4．データ表示
                        if($status==false) {
                            //execute（SQL実行時にエラーがある場合）
                            $error = $stmt->errorInfo();
                            exit("ErrorQuery:".$error[2]);
                        }else{
                            //Selectデータの数だけ自動でループしてくれる
                            //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
                            while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                            // var_dump($result);
                            ?>
                                <td><input type="text" name="order_number" id="order_number" value="<?= $result['order_number'] ?>" style="width: 150px;"></td>
                                <td><input type="text" name="product_name" id="product_name" id="order_number" value="<?= $result['product_name'] ?>" style="width: 150px;"></td>
                                <td><input type="text" name="point_from" id="point_from" value="<?= $result['point_from'] ?>" style="width: 150px;"></td>
                                <td><input type="text" name="point_to" id="point_to" value="<?= $result['point_to'] ?>" style="width: 150px;"></td>
                                <td><input type="date" value="2021-06-20" name="time_from" id="time_from" value="<?= $result['time_from'] ?>" style="width: 150px;"></td>
                                <td><input type="date" value="2021-06-21" name="time_to" id="time_to" value="<?= $result['time_to'] ?>" style="width: 150px;"></td>
                                <td><input type="submit" value="登録" id="f_send"></input>
                                    <?php
                                        echo '<a href="delete.php?order_number='.$result['order_number'].'">[削除]</a>'
                                    ?>
                                </td>
                            <?php
                            }
                        }
                        echo '</tr>';
                    ?>
                </table>
            </form>
        </div>
    </div>
</body>