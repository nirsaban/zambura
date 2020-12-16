<?php
include_once('../php/db.php');


$date = $_POST['date'];
$articlearray = array();

$query = "SELECT * FROM `tips_dates` WHERE `date` = '".$date."'  ";
$result=mysqli_query($query) or die('error connecting'); 				
//$row =  mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);

while ( $row =  mysqli_fetch_assoc($result) )
{

	$articlearray[] =  $row;
}
		
		
echo json_encode($articlearray); 

/*
if ($num > 0)
{
	echo json_encode($row);
}
else
{
	$jsonarray[] = array('status' => '0');  
	 echo json_encode($jsonarray);  
}
  
*/
		
	
		


?>