<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 自動リロード -->
    <!-- <meta http-equiv="refresh" content="5; URL=/HT_kadai01/index.html"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./toppage.css">
    <script src="./jquery-2.1.3.min.js"></script>
  
    <!-- ガントチャート -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.js"></script>
  
    <!--マップ表示-->
    <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Aq53wekz4XEBw0Ld_FGVw8sWsKQCD-6xWNVNEIwPwuu81Ez_5tyLrtUbMpmq4EH6' async defer></script>
    <script src="./src/BmapQuery.js"></script>

    <title>INDEX</title>
</head>

<div class="top_image">
    <img class="top_image_pic" src="./top_image.png" alt="top_image">
</div>

<div class="site_header">
    <h1 class="site_logo"> Sample
    </h1>
    <nav class="gnav">
        <ul class="gnav__menu">
            <li class="gnav__menu__item"><a href="#driver_schedule">DRIVER SCHEDULE</a></li>
            <li class="gnav__menu__item"><a href="#product_order">PRODUCT ORDER</a></li>
            <li class="gnav__menu__item"><a href="#package_matching">PACKAGE MATCHING</a></li>
            <li class="gnav__menu__item"><a href="">News</a></li>
            <li class="gnav__menu__item"><a href="">Contact</a></li>
        </ul>
    </nav>
</div>


<div class="header_change">
    <h1 class="site_logo"> Sample </h1>
    <nav class="gnav">
        <ul class="gnav__menu">
            <li class="gnav__menu__item"><a href="#driver_schedule">DRIVER SCHEDULE</a></li>
            <li class="gnav__menu__item"><a href="#product_order">PRODUCT ORDER</a></li>
            <li class="gnav__menu__item"><a href="#package_matching">PACKAGE MATCHING</a></li>
            <li class="gnav__menu__item"><a href="">News</a></li>
            <li class="gnav__menu__item"><a href="">Contact</a></li>
        </ul>
    </nav>        
</div>

<body>
    <div class="dead_space">
    </div>
    
    <div id="driver_schedule", class="section_title">
        DRIVER SCHEDULE
    </div>

    <div id="workspace_01" class="workspace">
        <svg id="gantt">
        </svg>
        
        <div class="map_space">
            <div id="myMap_01" style='width:100%;height:100%;'>
            </div>
            <!--Directions[START]-->
            <div>
                <input type="button" id="search" value="ルート検索">
                <input type="button" id="clear" value="clear" style="height:26px;">
            </div>
            <div id="direction"></div>
            <!-- Directions[END] -->
        </div>
    </div>

    <div class="page_jump">
        <a id="next_page_01" href="">
            機能詳細
        </a>
    </div>



    <div id="product_order", class="section_title">
        PRODUCT ORDER
    </div>

    <div id="workspace_02" class="workspace">
        
        <!-- <div class="product_info">
            <img class="product_img" src="/HT_kadai01/HT_PHP_kadai01/product_img.png" alt="">
            <div>
                PRODUCT_NAME:「製品名」
            </div>
            <div>
                STOCK_POINT:「出荷店名/出荷倉庫」
            </div>
        </div> -->
        
        <div class="table_space">
            <form method="post" action="database.php" style="height: 500px">
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
                    <tr>
                        <td><input type="text" name="order_number" id="order_number" style="width: 150px;"></td>
                        <td><input type="text" name="product_name" id="product_name" style="width: 150px;"></td>
                        <td><input type="text" name="point_from" id="point_from" style="width: 150px;"></td>
                        <td><input type="text" name="point_to" id="point_to" style="width: 150px;"></td>
                        <td><input type="date" value="2021-06-20" name="time_from" id="time_from" style="width: 150px;"></td>
                        <td><input type="date" value="2021-06-21" name="time_to" id="time_to" style="width: 150px;"></td>
                        <td><input type="submit" value="登録" id="f_send"></input></td>
                    </tr>
                    <tr>
                        <?php
                            include("table_data.php");
                        ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div class="page_jump">
        <a id="next_page_01" href="">
            機能詳細
        </a>
    </div>


    <div id="package_matching", class="section_title">
        PACKAGE MATCHING
    </div>

    <div id="workspace_03" class="workspace">
        <div class="video_frame" style="width: 1000px; object-fit: cover;">
            <iframe style="object-fit: cover;" width="1000" height="500" src="./INDEX - Google Chrome 2021-06-20 23-57-07_Trim.mp4" frameborder="0"></iframe>
        </div>
    </div>

    <div class="page_jump">
        <a id="next_page_01" href="">
            機能詳細
        </a>
    </div>

    
<footer class="site_footer">
    <p class="copyright">Sample</p>
</footer>

<script>

// メニューバースクロール
    var _window = $(window),
    _header = $('.site_header'),
    headerChange = $('.header_change'),
    heroBottom;
 
    _window.on('scroll',function(){     
    heroBottom = $('.hero').height();
    if(_window.scrollTop() > heroBottom){
        headerChange.addClass('show');  
    }
    else{
        headerChange.removeClass('show');
    }
    });
 
_window.trigger('scroll');
// メニューバースクロール


// ガントチャート
window.onload = function() {
  // タスクを用意
  var tasks = [
    {
    	id: 'id1',
    	name: '配車番号01',
    	description: 'XXガス',
    	start: '2021-06-01',
    	end: '2021-06-08',
    	progress: 100,
    },
    {
    	id: 'id2',
    	name: '配車番号02',
    	description: 'XXガス',
    	start: '2021-06-02',
    	end: '2021-06-05',
    	progress: 25,
    },
    {
    	id: 'id3',
    	name: '配車番号03',
    	description: 'YYガス',
    	start: '2021-06-06',
    	end: '2021-06-10',
    	progress: 60,
    },
    {
    	id: 'id4',
    	name: '配車番号04',
    	description: 'YYガス',
    	start: '2021-06-11',
    	end: '2021-06-12',
    	progress: 50,
    },
    {
    	id: 'id5',
    	name: '配車番号05',
    	description: 'TBD',
    	start: '2021-06-13',
    	end: '2021-06-17',
    	progress: 60,
    },
    {
    	id: 'id6',
    	name: '配車番号06',
    	description: 'TBD',
    	start: '2021-06-13',
    	end: '2021-06-17',
    	progress: 60,
    },
    {
    	id: 'id7',
    	name: '配車番号07',
    	description: 'TBD',
    	start: '2021-06-13',
    	end: '2021-06-17',
    	progress: 60,
    },
  ];
  
  // gantt をセットアップ
  var gantt = new Gantt("#gantt", tasks, {
    // ダブルクリック時
    on_click: (task) => {
      console.log(task.description);
      const map = new Bmap("#myMap_01");
      const submap = new Bmap("#subMap");
      map.direction("#direction", mode, from, to,[]);
      submap.direction("#direction", mode, from, to,[]);

    },
    // 日付変更時
    on_date_change: (task, start, end) => {
      console.log(`${task.name}: change date`);
    },
    // 進捗変更時
    on_progress_change: (task, progress) => {
      console.log(`${task.name}: change progress to ${progress}%`);
    },
  });
};
// ガントチャート


// マップ表示
//****************************************************************************************
// BingMaps&BmapQuery
//****************************************************************************************
//Init
function GetMap(){
    //------------------------------------------------------------------------
    //1. Instance
    //------------------------------------------------------------------------
    const map = new Bmap("#myMap_01");
    // const submap = new Bmap("#subMap");

    //------------------------------------------------------------------------
    //2. Display Map
    //   startMap(lat, lon, "MapType", Zoom[1~20]);
    //   MapType:[load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
    //--------------------------------------------------
    map.startMap(37.4923599, 139.9306068, "load", 14);
    // submap.startMap(37.4923599, 139.9306068, "load", 14);

    //------------------------------------------------------------------------
    //3. Directions
    // map.direction("#rootView", "from" , "to", waypoint[array]);
    // !! 日本地図で表示してる場合のみルート検索可能（各国毎）以下パラメータ指定で制御も可能 !!
    // +  [ English => https://www.bing.com/...&setLang=en&setMkt=en-US ]
    // +  [ Japan   => https://www.bing.com/...&setLang=ja&setMkt=ja-JP ]
    //------------------------------------------------------------------------
    document.getElementById("search").onclick = function () {
        //Get From,To
        const from  = '西若松';  //StartPoint
        const to    = '会津高校';    //EndPoint
        const mode  = 'driving';  //RouteMode[walking,driving]
        //経由地あり
        // const array = ["新宿", "恵比寿"];                       //Waypoints...
        // map.direction("#direction", mode, from, to, array);  //Direction Methed
        //経由地なし
        map.direction("#direction", mode, from, to,[]);
    };
    document.getElementById("clear").onclick = function () {
        console.log("1");
        $('.directionsPanel').remove();
        console.log("2");
    };
}


//****************************************************************************************
// BingMaps&BmapQuery
//****************************************************************************************
//Init
// function GetMap(){
    //------------------------------------------------------------------------
    //1. Instance
    //------------------------------------------------------------------------
    // const map = new Bmap("#myMap_02");

    //------------------------------------------------------------------------
    //2. Display Map
    //   startMap(lat, lon, "MapType", Zoom[1~20]);
    //   MapType:[load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
    //--------------------------------------------------
    // map.startMap(37.4923599, 139.9306068, "load", 14);

    //------------------------------------------------------------------------
    //3.Circle Add
    //  circleSet( Meter, style={pinColor,fillColor,strokeWidth} );
    //------------------------------------------------------------------------
    //Blue
    // const style1 = {
    //     pinColor:"#0000ff",
    //     fillColor:"rgba(0,0,100,0.6)",
    //     strokeWidth:1
    // };
    // map.circle(100, style1); //1000m=1km
    // map.circle(300, style1); //2000m=2Km
    // map.circle(500, style1); //3000m=3km
// }




</script>


<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyASZgOVOx3a__us92XCvnWQt6-fc736Dpg",
    authDomain: "drivermatchingtest.firebaseapp.com",
    projectId: "drivermatchingtest",
    storageBucket: "drivermatchingtest.appspot.com",
    messagingSenderId: "905046854501",
    appId: "1:905046854501:web:7e5c673b41c3a246c46f8c"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>




</body>
</html>