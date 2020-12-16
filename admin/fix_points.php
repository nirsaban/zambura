<?php

include_once('../php/db.php');

exit;


$query = "SELECT * FROM `PointsPerMonth1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;
$g = 0;
while ( $row = mysqli_fetch_array($result) )
{
	$g++;
	$user = str_replace("_User$","",$row['_p_user']);
	//print $user;
	//print '<br>';

	$exlodewrong = explode('"',$row['incorrectAnswers']);
	$exloderight = explode('"',$row['correctAnswers']);
	
	$exlodemonth = explode('"',$row['month']);
	$exlodepoints = explode('"',$row['points']);
	$exlodeyear = explode('"',$row['year']);
	
	$wrongcount = $exlodewrong[1];
	$rightcount = $exloderight[1];
	
	$month = $exlodemonth[1];
	$points = $exlodepoints[1];
	$year = $exlodeyear[1];


	
	

}
											


?>