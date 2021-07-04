<?php
// SESSIONスタート
session_start();

// SESSIONのidを取得
$sid = session_id();

$_SESSION["name"] = "中野";
$_SESSION["age"] = 26;

echo $sid;

?>