<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../../../vendor/autoload.php';

$mail = new PHPMailer(true);


try {
     //ホスト（さくらのレンタルサーバの初期ドメイン）
    $host = 'mil16.sakura.ne.jp';
    //メールアカウントの情報（さくらのレンタルサーバで作成したメールアカウント）
    $user = 'gbcbs_prt01@mil16.sakura.ne.jp';
    $password = 'GONgon6015';
    //差出人
    $from = 'gbcbs_prt01@mil16.sakura.ne.jp';
    $from_name = 'gbcbs_prt01';
    //宛先
    $to = 'hiroshi_tadokoro.kyushu.u@gmail.co.jp';
    $to_name = 'test_user';
    //件名
    $subject = 'test';
    //本文
    $body = 'test';
    //諸々設定
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //デバッグ用
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $host;
    $mail->Username = $user;
    $mail->Password = $password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";
    $mail->setFrom($from, $from_name);
    $mail->addAddress($to, $to_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    //メール送信
    $mail->send();

} catch (Exception $e) {
  //エラー（例外：Exception）が発生した場合
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>