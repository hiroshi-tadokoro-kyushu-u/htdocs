<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/HT_kadai01/HT_PHP_kadai01/reset.css">
    <link rel="stylesheet" href="/HT_kadai01/HT_PHP_kadai01/toppage.css">
    <script src="/HT_kadai01/HT_PHP_kadai01/jquery-2.1.3.min.js"></script>

    <title>subMap</title>
    
    <!--マップ表示-->
    <!-- <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Aq53wekz4XEBw0Ld_FGVw8sWsKQCD-6xWNVNEIwPwuu81Ez_5tyLrtUbMpmq4EH6' async defer></script>
    <script src="/HT_kadai01/HT_PHP_kadai01/src/BmapQuery.js"></script> -->

</head>
<body>


<!-- MAP[START] -->
<h1>Map:Init</h1>
<div id="myMap" style='width:60%;height:70%;float:left;'></div>
<!-- MAP[END] -->


<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Aq53wekz4XEBw0Ld_FGVw8sWsKQCD-6xWNVNEIwPwuu81Ez_5tyLrtUbMpmq4EH6' async defer></script>
<script src="/HT_kadai01/HT_PHP_kadai01/src/BmapQuery.js"></script>
<script>
//****************************************************************************************
// BingMaps&BmapQuery
//****************************************************************************************
//Init
function GetMap(){
    //------------------------------------------------------------------------
    //1. Instance
    //------------------------------------------------------------------------
    const map = new Bmap("#myMap");

    //------------------------------------------------------------------------
    //2. Display Map
    //   startMap(lat, lon, "MapType", Zoom[1~20]);
    //   MapType:[load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
    //--------------------------------------------------
    map.startMap(47.6149, -122.1941, "load", 10);

}

</script>

</body>
</html>