<?php
include_once('../../php/db.php');
include_once('../config.php');
$pointsArray = array();
$query = "SELECT * FROM `daily_points`  WHERE `user_id` = '".$_POST['user_id']."'  AND `point_date` = '".$_POST['date']."' ORDER BY `points` DESC";
$result=mysql_query($query) or die('error connecting55');
//$num_rows = mysql_num_rows($result);

while ( $row =  mysql_fetch_assoc($result) )
{
    $pointsArray[] = $row;
}

echo json_encode($pointsArray);
?>