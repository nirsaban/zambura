<?php

include_once('../php/db.php');

exit;



$query = "SELECT * FROM `Message1`   ";
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
	
	if ($row['isRead']  == "false")
		$isread = 0;
	else
		$isread = 1;

	if ($row['type']  == "ADMIN")
		$usertype = "answer";
	else
		$usertype = "question";

	$user = str_replace("_User$","",$row['_p_user']);

	$query2 = "SELECT * FROM `users` WHERE `oldId` = '".$user."'  ";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$row2 = mysqli_fetch_array($result2);

	

	
	
	$sql= "INSERT INTO `message_specialist` (`user_id`,`message`,`type`,`read`,`date`)  VALUES (
	'".addslashes($row2['index'])."',
	'".addslashes($row['content'])."',
	'".addslashes($usertype)."',
	'".addslashes($isread)."',
	'".addslashes($createddate)."'
	)";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	
	
	
	//print $row['logo'];
	//print '<br>';


}


	
	


	

?>