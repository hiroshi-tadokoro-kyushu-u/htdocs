<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/reset.css">
    <link rel="stylesheet" href="/toppage.css">    	
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:700 rel="stylesheet>
    <script src="/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <title>TOP_PAGE</title>
</head>
<body>

<div class="title_main_frame">
        <div id="title_top">
            Comment Dash!!
        </div>
        
        <!--ロゴ用スペース-->
        <div class="title_sub_frame">
            <img src="/Top_image.png" id="top_image" alt="top_image">

        </div>
        <!--/ロゴ用スペース-->

        <fieldset class="player_info">
            <legend>プレイヤー登録</legend>
            <label>プレイヤーid:
                <div id="player_id">

                </div>
            </label>
            <label>プレイヤー名:
                <input type="text" id="player_name">
            </label>
            <br>
            <label>コメント:
                <input type="text" id="player_comment">
            </label>
            <br>
            <label>
                <input type="checkbox" id="practice_mode" value="red" checked>
                音声認識モード
            </label>
        </fieldset>
        
        <button id="game_start">
            Game Start!!
        </button>

        <!-- <div id="logined_player" style="overflow: auto;height: 200px;"> -->

        </div>

    </div>  
</body>
</html>