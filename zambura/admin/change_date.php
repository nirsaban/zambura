<?php

include_once('../php/db.php');



$query = "SELECT * FROM `Daily_Tips1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);

while ( $row = mysqli_fetch_array($result) )
{
	$explode = explode('"',$row['date']);
	//print $explode[1];
	//print '<br>';
	
	$newdate = substr($explode[1], 0, 10);
	

	
	$explodedate = explode("-",$newdate);
	
	
	$formatteddate = ''.$explodedate[2].'/'.$explodedate[1].'/'.$explodedate[0].'';
	print $formatteddate;
	print '<br>';	
	
	//mysqli_query("UPDATE `Daily_Tips1` SET `new_date`  = '".$formatteddate."' WHERE `_id` = '".$row['_id']."' ");
}
											


?>