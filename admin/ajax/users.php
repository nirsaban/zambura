<?php
include_once('../../php/db.php');
include_once('../config.php');
$query = "SELECT * FROM `users`  WHERE `deleted` = '0' ORDER BY `index` DESC ";
$result=mysql_query($query) or die('error connecting55');
$num_rows = mysql_num_rows($result);

$points = 0;
$correctAnswerCount = 0;
$wrongAnswerCount  = 0;
while ( $row = mysql_fetch_array($result) )
    {

        if ($row['image']) {
            if (strpos($row['image'], 'tapper') !== false) {
                $imageUrl = $row['image'];
            } else {
                $imageUrl = ''.$configUrl.'/'.$row['image'].'';
            }
                $image = '<a href="'.$imageUrl.'" target="_blank"><img src="'.$imageUrl.'" style="width:40px; height:40px;"></a>';
        } else {
            $image = '';
        }

        if ($row['gender'] == 0)
            $gender = "זכר";

        if ($row['gender'] == 1)
            $gender = "נקבה";


        $query2 = "SELECT * FROM `daily_points`  WHERE `user_id` = '".$row['index']."'  ";
        $result2=mysql_query($query2) or die('error connecting55');
        $num_rows2 = mysql_num_rows($result2);
        $points = 0;
        $correctAnswerCount = 0;
        $wrongAnswerCount  = 0;
        while ( $row2 = mysql_fetch_array($result2) )
        {
            $points += $row2['points'];
            $correctAnswerCount += $row2['correctAnswerCount'];
            $wrongAnswerCount += $row2['wrongAnswerCount'];
        }

        $data[] = array(
            $row['index'],
            date("d/m/y H:i:s", strtotime($row["date"])),
            stripslashes($num_rows2),
            //stripslashes($num_rows20),
            stripslashes($points),
            stripslashes($wrongAnswerCount),
            stripslashes($correctAnswerCount),
            stripslashes($row['birthday']),
            stripslashes($gender),
            stripslashes($row['address']),
            stripslashes($row['email'] ),
            ''.stripslashes($row['firstname']).' '.stripslashes($row['lastname']).'',
            ''.$image.'',
            $row['index']);

    }
        echo json_encode(array("data"=>$data));

?>