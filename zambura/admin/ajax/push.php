<?php
include_once('../../php/db.php');
include_once('../config.php');
$query = "SELECT * FROM `users`  WHERE `push_id` != '' AND `deleted` = '0' ORDER BY `index` DESC";
$result=mysqli_query($query) or die('error connecting55');
$num_rows = mysqli_num_rows($result);

$points = 0;
$correctAnswerCount = 0;
$wrongAnswerCount  = 0;
while ( $row = mysqli_fetch_array($result) )
    {



        $data[] = array(
            '',
            stripslashes($row['email'] ),
            date("d/m/y H:i:s", strtotime($row["date"])),
            stripslashes($row['email'] ),
            ''.stripslashes($row['firstname']).' '.stripslashes($row['lastname']).'',
            $row['index']);

    }
        echo json_encode(array("data"=>$data));

?>