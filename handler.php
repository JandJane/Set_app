<?php header("Content-type: text/html; charset=utf-8"); ?>
<?php
        $link = mysqli_connect("localhost", "db", "password");
        if (!$link) {
        die('Ошибка подключения (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
        }
        mysqli_set_charset($link, "utf8");
        mysqli_select_db($link, "db");

        $data = mysqli_query($link, "SELECT * FROM `results` WHERE `id` = '$_POST[id]'");
        $row = mysqli_fetch_array($data, MYSQLI_ASSOC);
        if ($row) {
             if ($row['score'] < $_POST[score]) {
                 mysqli_query($link, "UPDATE `results` SET `score` = '$_POST[score]', `time` = '$_POST[time]' WHERE `id` = '$_POST[id]'");
             } else if ($row['score'] == $_POST[score] and $row['time'] > $_POST[time]) {
                 mysqli_query($link, "UPDATE `results` SET `time` = '$_POST[time]' WHERE `id` = '$_POST[id]'");
             }
        } else {
            mysqli_query($link, "INSERT INTO `results` (`score`, `time`, `id`, `name`, `photo_url`) VALUES ('$_POST[score]', '$_POST[time]', '$_POST[id]', '$_POST[name]', '$_POST[photo_url]')") or die(mysqli_error($link));
        }
        mysqli_close($link);
?>
