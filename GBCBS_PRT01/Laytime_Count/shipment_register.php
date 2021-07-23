<?php



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../general.css">
    <script src="../jquery-2.1.3.min.js"></script>
    <title>SHIPMENT_REGISTER</title>
</head>

<!--
以下、共通ヘッダー
-->

<div class="site_header01">
    <a href="../index.php">
        <img class="site_logo" src="../logo.png">
        </img>
    </a>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item01"><a href="../Account_Control/login.php">LOG-IN</a></li>
            <li class="gnav_menu_item01"><a href="../Account_Control/user_register.php">User登録</a></li>
            <li class="gnav_menu_item01"><a href="">XXX</a></li>
        </ul>
    </nav>
</div>

<div class="site_header02">
    <div></div>
    <nav class="gnav">
        <ul class="gnav_menu">
            <li class="gnav_menu_item02"><a href="./LC_main.php">LAYTIME CALCULATION</a></li>
            <li class="gnav_menu_item02"><a href="">SHIPMENT LOCATION</a></li>
            <li class="gnav_menu_item02"><a href="">DELIVERY MANAGEMENT</a></li>
            <li class="gnav_menu_item02"><a href="">VESSEL NOMINATION</a></li>
        </ul>
    </nav>
</div>

<!-- 
以下、メイン部分
 -->
<body class="index_background"> 

    <div class="shipment_table01">
        <form method="post" action="">
            <table class="shipment_table03">
                <tr>
                    <th>船名</th>
                    <td><input type="text" title="vessel_name" placeholder="vessel_name"></td>
                </tr>
                <tr>
                    <th>案件名</th>
                    <td><input type="text" title="project_name" placeholder="project_name"></td>
                </tr>
                <tr>
                    <th>契約年度</th>
                    <td><input type="number" title="contract_year" placeholder="contract_year、spotの場合は1"></td>
                </tr>
                <tr>
                    <th>配船番号</th>
                    <td><input type="number" title="shipment_number" placeholder="shipment_number、spotの場合は1"></td>
                </tr>
                <tr>
                    <th>積地/揚地</th>
                    <td><input type="text" title="operation_location" placeholder="operation_location"></td>
                </tr>
                <tr>
                    <th>荷役率</th>
                    <td><input type="number" title="operation_rate" placeholder="operation_rate(MT/day)"></td>
                </tr>
                <tr>
                    <th>滞船料率</th>
                    <td><input type="number" title="dem_rate" placeholder="dem_rate(USD/day)"></td>
                </tr>
                <tr>
                    <th>早出料率</th>
                    <td><input type="number" title="des_rate" placeholder="des_rate(USD/day)"></td>
            </tr>
            </table>
            <button type="submit" class="shipment_register_button" style="width:100%">新規配船登録</button>    
        </form>
    </div>

</body>


</html>