<html>
<head>
    <meta charset="utf-8">
    <title>配列</title>
</head>
<body>

<!-- 以下にPHPを記述 -->
<?php

$city_names = array("新宿","品川","東京");
var_dump($city_names);

array_push($city_names,"原宿");

echo $city_names[2];
    

?>

<ul>
    <li><a href="index.php">戻る</a></li>
</ul>
</body>
</html>