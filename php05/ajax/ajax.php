<?php
  //POSTパラメータを取得
  $id = $_POST["id"];
  $name = $_POST["name"];
  $age = $_POST["age"];
  $sleep = $_POST["sleep"];


sleep($sleep);


  // sleep($sleep);  //Timeoutテスト用
  // echo "<div>$id</div><div>$name</div><div>$age</div>";
  
 $json = '[
   {
     "id":"'.$id.'",
     "mode":"'.$name.'",
     "type":"'.$age.'"
   },
   {
    "id":"'.$id.'",
    "mode":"'.$name.'",
    "type":"'.$age.'"
   }
 ]';
 echo $json;
exit;
?>
