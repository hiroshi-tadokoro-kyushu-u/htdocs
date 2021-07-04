<?php
// SESSIONスタート
session_start();

// SESSION変数を取得
$name = $_SESSION["name"];
$age = $_SESSION["age"];

echo $name;
echo $age;
?>