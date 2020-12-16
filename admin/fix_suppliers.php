<?php

include_once('../php/db.php');

exit;


function download_image1($image_url, $image_file){
    $fp = fopen ($image_file, 'w+');              // open file handle

    $ch = curl_init($image_url);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
    curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
    curl_exec($ch);

    curl_close($ch);                              // closing curl handle
    fclose($fp);                                  // closing file handle
}




$query = "SELECT * FROM `Supplier1`   ";
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


	$oldimage = 'http://files.parsetfss.com/5a4ee413-7280-4506-ab61-d9633e75d9dd/'.$row['logo'].'';

	
	//print $oldimage;
	//print '<br>';
	
	
	//download_image1($oldimage, "suppliers/".$row['logo']."");


	
	/*
	$sql= "INSERT INTO `suppliers` (`oldId`,`name`,`email`,`contact_name`,`phone`,`image`)  VALUES (
	'".addslashes($row['_id'])."',
	'".addslashes($row['name'])."',
	'".addslashes($row['email'])."',
	'".addslashes($row['contactName'])."',
	'".addslashes($row['phoneNumber'])."',
	'".addslashes($row['logo'])."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	*/
	
	
	//print $row['logo'];
	//print '<br>';


}



$query = "SELECT * FROM `Supplier_Branch1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;



while ( $row = mysqli_fetch_array($result) )
{

	$brance = str_replace("Supplier$","",$row['_p_supplier']);
	
	//print $brance;
	//print '<br>';


	$query2 = "SELECT * FROM `suppliers` WHERE `oldId` = '".$brance."'";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$num_rows2 = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_array($result2);

	$explodeLocation = explode('"',$row['location']);
	$loc_lat =  $explodeLocation[1];
	$loc_long =  $explodeLocation[3];
	print $loc_long;
	print '<br>';
	
	
	

	
	$sql= "INSERT INTO `supplier_brances` (`oldId`,`old_supplierid`,`supplier_id`,`address`,`location_lat`,`location_lng`,`name`)  VALUES (
	'".addslashes($row['_id'])."',
	'".addslashes($brance)."',
	'".addslashes($row2['index'])."',
	'".addslashes($row['address'])."',
	'".addslashes($loc_long)."',
	'".addslashes($loc_lat)."',
	'".addslashes($row['name'])."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	


	
	

}	
	
	
$query = "SELECT * FROM `Benefit_Branch1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;



while ( $row = mysqli_fetch_array($result) )
{
		$dealid = str_replace("Benefit$","",$row['_p_benefit']);
		$branceid = str_replace("Supplier_Branch$","",$row['_p_branch']);
		
		//print $branceid;
		//print '<br>';


		$query2 = "SELECT * FROM `deals` WHERE `oldId` = '".$dealid."'";
		$result2=mysqli_query($query2) or die('error connecting55'); 
		//$num_rows2 = mysqli_num_rows($result2);
		$row2 = mysqli_fetch_array($result2);

		$query3 = "SELECT * FROM `supplier_brances` WHERE `oldId` = '".$branceid."'";
		$result3=mysqli_query($query3) or die('error connecting55'); 
		//$num_rows3 = mysqli_num_rows($result3);
		$row3 = mysqli_fetch_array($result3);

		/*
		$sql= "INSERT INTO `deal_brances` (`oldId`,`deal_id`,`branch_id`)  VALUES (
		'".addslashes($row['_id'])."',
		'".addslashes($row2['index'])."',
		'".addslashes($row3['index'])."')";
		$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
		$insertId = mysqli_insert_id();
		*/

	

}	
											


?>