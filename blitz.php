<?php header("Content-type: text/html; charset=utf-8"); ?>
<?php session_start(); error_reporting(0); ?>
<html>
<head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- &#1087;&#1086;&#1076;&#1082;&#1083;&#1102;&#1095;&#1072;&#1077;&#1084; xd_connection.js -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '398899940526365',
          xfbml      : true,
          version    : 'v2.11'
        });
    
        function onLogin(response) {
          if (response.status == 'connected') {
            FB.api('/me/?fields=picture,name', function(data) {
              document.getElementById('users_id').value = data.id;
              document.getElementById('users_name').value = data.name;
              document.getElementById('photo_url').value = data.picture.data.url;
            });
          }
        }
        
        FB.getLoginStatus(function(response) {
          // Check login status on load, and if the user is
          // already logged in, go directly to the welcome message.
          if (response.status == 'connected') {
            onLogin(response);
          } else {
            // Otherwise, show Login dialog first.
            FB.login(function(response) {
              onLogin(response);
            }, {scope: 'public_profile, user_photos'});
          }
        });
      };
    
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>


    <title>Set</title>
    <link href="css/style_blitz.css" rel="stylesheet">
    <script type="text/javascript" charset="UTF-8" src = "js/tech_blitz.js" defer ></script>
</head>
<body>

<div id = 'header'>
    <table> <tr>
        <td width="175"> <span onClick = 'chose_alert()' style = 'cursor: pointer'>  <p class = 'text2'> Режим <img src = "img/point.png" style = "valign: bottom; margin-left: 10px"> </p> </span>
            <div align = 'left' id = 'chose'>
                <?php
                    $viewer_id = $_GET['#users_id'];
                    echo "<a class = 'text3' href = 'index.php?viewer_id=".$viewer_id."'> Классика </a> <br/>";
                    echo "<a class = 'text3' href = 'blitz.php?viewer_id=".$viewer_id."'> Блиц </a> <br/>";
                ?>
            </div> </td>
        <td width="51"></td>
        <td width="156" valign="top"> <span onClick = 'rating_alert()' style = 'cursor: pointer'> <p class = 'text1'> Рейтинг </p> </span> </td>
        <td width="235">  </td>
        <td width="179" valign="top"> <span onClick = 'rules_alert()' style = 'cursor: pointer'> <p class = 'text1'> Правила  </p> </span> </td>
        <td width="179" valign="top"> <span onClick = 'study_alert()' style = 'cursor: pointer'> <p class = 'text1'> Обучение  </p> </span> </td>
    </tr> </table>
</div>

<br/> <br/>
<table id = 'table' style = 'margin-left: 30px'>
    <tr>
        <td colspan='2' width = '230px' align = 'center' valign = 'buttom'>

            <div id = 'counter' style = 'float: left'> 0 </div>
            <div id = 'score' style = 'float: right'> 0 </div>
            <div id = 'cards_left'> 69 </div>
        </td>
        <td style = 'padding-left: 6px'  width = '125px'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 0> </td>
        <td width = '120px'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 1> </td>
        <td width = '120px'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 2> </td>
        <td width = '120px'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 3> </td>
        <td width = '120px'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" hidden = hidden id = 12> </td>

    </tr>
    <tr>
        <td colspan = '2' align = center>
            <div id = 'butt_help' onClick = 'find_set()' onMouseOver= "newColor('butt_help')" onMouseOut = "backColor('butt_help')"> Подсказка </div>
            <div onClick = 'show_results()' id = 'butt_result' onMouseOver= "newColor('butt_result')" onMouseOut = "backColor('butt_result')"> Завершить игру </div>
        </td>
        <td style = 'padding-left: 6px' rowspan = '2'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 4> </td>
        <td rowspan = '2'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 5> </td>
        <td rowspan = '2'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 6> </td>
        <td rowspan = '2'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 7> </td>
        <td rowspan = '2'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" hidden = hidden id = 13> </td>
    </tr>
    <tr>
        <td width = '30'></td>
        <td align = center>
            <div id = 'butt_add' onClick = 'show_cards()' onMouseOver= "newColor('butt_add')" onMouseOut = "backColor('butt_add')" style = 'float: left' style = 'margin-left: 500px'> +3 </div>
            <div onClick = 'restart()' id = 'replay' onMouseOver= "newColor('replay')" onMouseOut = "backColor('replay')" style = 'margin-left: 30px; margin-top: 4px'> <img style = "margin:4px" src = "img/restart.gif" width = "43" height = "42" align = "center"> </div>
        </td>

    </tr>
    <tr>
        <td colspan = '2' align = center>
            <div id = 'timer' style  = 'float: left'><div id = 'stripe'></div></div>
            <p id = 'time'> </p>
        </td>
        <td style = 'padding-left: 6px'> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 8> </td>
        <td> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 9> </td>
        <td> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 10> </td>
        <td> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" id = 11> </td>
        <td> <img src = "img/0122.gif" height="160" width="115" onClick = "save_clicked(id)" hidden = hidden id = 14> </td>
    </tr>
    <tr>
        <td></td> <td> </td>
        <td style = 'padding-left: 11px' colspan = '4'>
            <div id = 'alert_win'>
                Выберите <strong>3 карты,</strong> кликнув по ним.
            </div>
        </td>
    </tr>

</table>


<input type = hidden id = 'score_post' value = 0>
<input type = hidden id = 'users_id' value = 0>
<input type = hidden id = 'users_name' value = 0>
<input type = hidden id = 'photo_url' value = 0>




<div id = 'bg'></div>

<div id="result">
    <img src = "img/cross.gif" height = '16' width = '16' align="right" style="margin: 8px; opacity: 0.8" onclick="location.reload()">
</div>


<div id="rating">
    <img src = "img/cross.gif" height = '16' width = '16' align="right" style="margin: 8px; opacity: 0.8" onclick="rating_hide()"> <br /> <br /> <br/>
    <span id = 'option'></span>
    <div id = 'menu'>  <span style = 'float: left' onClick = 'classic()'> Классика </span> <span style = 'float: right' onClick = 'blitz()'> Блиц </span> </div>
    <?php 
        $link = mysqli_connect("localhost", "db", "password");
            if (!$link) {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
            }
            mysqli_set_charset($link, "utf8");
            mysqli_select_db($link, "db");
            
            $viewer_id = $_GET['#users_id'];
        
            $data1 = mysqli_query($link, "SELECT * FROM `results_facebook` WHERE `id` = '$viewer_id'");
            $row1 = mysqli_fetch_array($data1, MYSQLI_ASSOC);
            $data2 = mysqli_query($link, "SELECT * FROM `blitz_facebook` WHERE `id` = '$viewer_id'");
            $row2 = mysqli_fetch_array($data2, MYSQLI_ASSOC);
            echo '<b>Ваш рекорд: ' . $row1[score] . ' очк. </b> в классической игре и <b>' . $row2[score] . ' очк.</b> в блиц-режиме.';
    ?>
    <iframe id = "rating_iframe" src = 'blitz_.php' scrolling="no" width="480" height="480" frameborder = '0'></iframe>
   
</div>

<div id="rules">
    <img src = "img/cross.gif" height = '16' width = '16' align="right" style="margin: 8px; opacity: 0.8" onclick="rules_hide()">
    <iframe src = 'a.html' scrolling="yes" width="700" height="460" frameborder = '0' marginheight="10">
    </iframe>
</div>


<div id = "study">
    <img src = "img/cross.gif" height = '16' width = '16' align="right" style="margin: 8px; opacity: 0.8" onclick="study_hide()">
    <iframe src = 'study.html' scrolling="no" width="850" height="560" frameborder = '0' marginheight="10">
    </iframe>
</div>


<script src = "js/dealing.js" defer ></script>

</body>
</html>