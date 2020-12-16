<?php

include_once('../php/db.php');

exit;


$query = "SELECT * FROM `users1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;
$g = 0;
while ( $row = mysqli_fetch_array($result) )
{
	$g++;


	$exlodewrong = explode('"',$row['wrongAnswers']);
	$exloderight = explode('"',$row['correctAnswers']);
	$exlodepoints = explode('"',$row['points']);
	
	$wrongcount = $exlodewrong[1];
	$rightcount = $exloderight[1];
	$points = $exlodepoints[1];
	
	
	if ($row['gender'] == "MAN")
		$gender = 0;
	else
	   $gender = 1;
	
	
	/*
	$query1 = "SELECT * FROM `users1`  WHERE `_p_partnerBy` = '_User$".$row['_id']."' ";
	$result1=mysqli_query($query1) or die('error connecting55'); 
	$row1 = mysqli_fetch_array($result1);
	$num1 = mysqli_num_rows($result1);
	*/
	
	$partnerBy = str_replace("_User$","",$row['_p_partnerBy']);


	
	$explodeDate1 = explode('"',$row['_created_at']);
	$newdate1 = substr($explodeDate1[1], 0, 10);	
	$createdat = ''.$newdate1.' 00:00:00';
	
	$explodeDate2 = explode('"',$row['birthDate']);
	$newdate2 = substr($explodeDate2[1], 0, 10);	
	$birthday = ''.$newdate2.' 00:00:00';

	
	$explodeDate3 = explode('"',$row['paidAt']);
	$newdate3 = substr($explodeDate3[1], 0, 10);	
	$paidat = ''.$newdate3.' 00:00:00';

	$explodeDate4 = explode('"',$row['benefitUsed']);
	$newdate3 = substr($explodeDate4[1], 0, 10);	
	if ($newdate3)
		$benfit = ''.$newdate3.' 00:00:00';	
	else
		$benfit = '';
	
	//$explodedate1 = explode("-",$newdate1);
	//$formatteddate1 = ''.$explodedate1[2].'/'.$explodedate1[1].'/'.$explodedate1[0].'';
	
	
	print $birthday;
	print '<br>';
	


		$sql= "INSERT INTO `users` (
		`oldId`,
		`firstname`,
		`lastname`,
		`email`,
		`password`,
		`gender`,
		`birthday`,
		`address`,
		`partnerBy`,
		`paidAt`,
		`username`,
		`cityName`,
		`licenseId`,
		`correctAnswers`,
		`partnerCode`,
		`points`,
		`wrongAnswers`,
		`benefitUsed`,
		`date`)  VALUES (
		'".addslashes($row['_id'])."',
		'".addslashes($row['firstName'])."',
		'".addslashes($row['lastName'])."',
		'".addslashes($row['email'])."',
		'".addslashes($row['_hashed_password'])."',
		'".addslashes($gender)."',
		'".addslashes($birthday)."',
		'".addslashes($row['cityName'])."',
		'".addslashes($partnerBy)."',
		'".addslashes($paidat)."',
		'".addslashes($row['username'])."',
		'".addslashes($row['cityName'])."',
		'".addslashes($row['licenseId'])."',
		'".addslashes($rightcount)."',
		'".addslashes($row['partnerCode'])."',
		'".addslashes($points)."',
		'".addslashes($wrongcount)."',
		'".addslashes($benfit)."',
		'".addslashes($createdat)."'				
		)";
		$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
		$insertId = mysqli_insert_id();


		//if ($g > 1)
			//exit;

}
											

$query = "SELECT * FROM `users`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;
$g = 0;
while ( $row = mysqli_fetch_array($result) )
{
	$g++;



	
	//UPDATE users  SET partnerBy=0

	
	
	
	

	
	if ($row['partnerBy'])
	{
		//print 'ok';
		
		//$user = str_replace("_User$","",$row['_p_partnerBy']);
		
		
		$query1 = "SELECT * FROM `users`  WHERE `oldId` = '".$row['partnerBy']."'";
		$result1=mysqli_query($query1) or die('error connecting55'); 
		$row1 = mysqli_fetch_array($result1);
		$num1 = mysqli_num_rows($result1);		
		
		if ($num1 > 0)
		{
			print 'ok';
			print '<br>';
			
			$updateQuery = "UPDATE `users` 
			 SET   
			 `partnerBy` ='".addslashes($row1['index'])."'
			 WHERE `index` ='".mysqli_real_escape_string($row['index'])."'";
			 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 			
			 
		}
		
		
		
		
		
		
	}
	else
	{
		//print 'bad';
	}
	
	


}
												
											
											
											

?>