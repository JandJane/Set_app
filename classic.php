<html>
    <head>
        <script src="//vk.com/js/api/xd_connection.js?2"  type="text/javascript"></script>
        <style type=”text/css”>
        body {
          background-color: transparent;
          margin: 0; /* Убираем отступы */
          padding: 0; /* Убираем поля */
          -webkit-user-select: none;
            /* user-select -- это нестандартное свойство */
        
          -moz-user-select: none;
            /* поэтому нужны префиксы */
        
          -ms-user-select: none;
         
        }
        
        p, div {
        	font: normal normal normal 8px Comic Sans MS;
            color: #000000;
        }
        
        a {
            font: normal normal normal 18px Comic Sans MS;
            color: #5d5d5d;
        }

        </style>
        
    </head>
    
    <body>
        <?php
            $link = mysqli_connect("localhost", "db", "password");
            if (!$link) {
                die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
            }
            mysqli_set_charset($link, "utf8");
            mysqli_select_db($link, "db");
             
            $y = 1;
            $data = mysqli_query($link, "SELECT * FROM `results` ORDER BY score DESC, time");
            echo '<table  style = "font: normal normal normal 14px Comic Sans MS; color: #000000;" width="100%" cellspacing="0" cellpadding="0"> <tr> <td valign="top">';
        
            while ($y < 7 and $row = mysqli_fetch_array($data, MYSQLI_ASSOC)){
                echo '<img src = ' . $row['photo_url'] . ' height="32" width="32" style="float:left; margin: 0px 6px 0px 0; border: 3px #dec9ad groove">';
                echo '<a> <strong>' . $y . '. ' .$row['name'] . '</strong><br /> ' . $row['score'] . ' очк. за ' . $row['time'] . ' &#1089;&#1077;&#1082;&#1091;&#1085;&#1076; </a> <br />';
                echo '<br / >';  
                $y++;  
            }
            echo '</td> <td valign="top"> ';
            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC) and $y < 13){
                echo '<img src = ' . $row['photo_url'] . ' height="32" width="32" style="float:left; margin: 0px 6px 0px 0; border: 3px #dec9ad groove">';
                echo '<a> <strong>' . $y . '. ' .$row['name'] . '</strong><br /> ' . $row['score'] . ' очк. за ' . $row['time'] . ' &#1089;&#1077;&#1082;&#1091;&#1085;&#1076; </a> <br />';
                echo '<br / >';  
                $y++;  
            }
            echo '</td> </tr> </table> ';
        
            mysqli_close($link); 
    ?>
    </body>
</html>

