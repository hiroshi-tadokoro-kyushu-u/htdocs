<?php

    $check = $_POST['check']; //チェックする文字列
    $table = 'users'; //ＤＢのテーブル名
    $field = 'user_name'; //フィールド名

    require_once('../tools.php');
    $pdo = db_connect();
    
    $stmt = $pdo->prepare("SELECT `user_name` FROM `{$table}` WHERE `{$field}` = '{$check}' LIMIT 1");
    $status = $stmt->execute();

    if($status==false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    }else{
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            // echo $result['user_name'];
            $flag = ($result['user_name'])?1:0;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($flag);
        }
    }   
?>