<?php

include_once('../php/db.php');

exit;


$query = "SELECT * FROM `Tip1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);

while ( $row = mysqli_fetch_array($result) )
{


	$query2 = "SELECT * FROM `Daily_Tips1`  WHERE `_p_tip` = 'Tip$".$row['_id']."' ";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$num_rows2 = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_array($result2);
	
	$explode = explode('"',$row2['date']);
	//print $explode[1];
	//print '<br>';
	
	$newdate = substr($explode[1], 0, 10);
	

	
	$explodedate = explode("-",$newdate);
	
	
	$formatteddate = ''.$explodedate[2].'/'.$explodedate[1].'/'.$explodedate[0].'';
	//print $formatteddate;
	//print '<br>';	
	
	

	$sql= "INSERT INTO `tips` (`title`)  VALUES ('".addslashes($row['content'])."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	
	if ($num_rows2 > 0)
	{
		$sql= "INSERT INTO `tips_dates` (`tip_id`,`date`)  VALUES ('".addslashes($insertId)."','".addslashes($formatteddate)."')";
		$InsertSql = mysqli_query($sql) or die(mysqli_error()); 		
	}


	
	
	//print $row['content'];
	print '<br>';

}
											


?>