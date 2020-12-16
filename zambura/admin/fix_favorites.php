<?php

include_once('../php/db.php');

exit;



$query = "SELECT * FROM `Favorites1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;
/*
$answer1 = '';
$answer2 = '';
$answer3 = '';
$answer4 = '';
*/



while ( $row = mysqli_fetch_array($result) )
{


	$explodeDate2 = explode('"',$row['_created_at']);
	$newdate2 = substr($explodeDate2[1], 0, 10);	
	$createddate = ''.$newdate2.' 00:00:00';
	


	$benfit = str_replace("Benefit$","",$row['_p_benefit']);
	$user = str_replace("_User$","",$row['_p_user']);
	

	$query3 = "SELECT * FROM `users` WHERE `oldId` = '".$user."'  ";
	$result3=mysqli_query($query3) or die('error connecting55'); 
	$row3 = mysqli_fetch_array($result3);	
	
	
	$query2 = "SELECT * FROM `deals` WHERE `oldId` = '".$benfit."'  ";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$row2 = mysqli_fetch_array($result2);

	if ($row2['index'])
	{
		print $row2['index'];
		print '<br>';
		
		
		$sql= "INSERT INTO `favorites` (`user_id`,`deal_id`)  VALUES (
		'".addslashes($row3['index'])."',
		'".addslashes($row2['index'])."')";
		$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
		$insertId = mysqli_insert_id();
		
		
		
		//print $row['logo'];
		//print '<br>';		
	}



}


	
	


	

?>