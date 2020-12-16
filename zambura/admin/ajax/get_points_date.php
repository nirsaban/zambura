<?php
include_once('../../php/db.php');
include_once('../config.php');
$pointsArray = array();
$query = "SELECT * FROM `daily_points`  WHERE `user_id` = '".$_POST['user_id']."'  AND `point_date` = '".$_POST['date']."' ORDER BY `points` DESC";
$result=mysqli_query($query) or die('error connecting55');
//$num_rows = mysqli_num_rows($result);

while ( $row =  mysqli_fetch_assoc($result) )
{
    $pointsArray[] = $row;
}

echo json_encode($pointsArray);
?>