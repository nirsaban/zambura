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




$query = "SELECT * FROM `Catalog_Category1`   ";
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

	$exlodeorder = explode('"',$row['order']);
	$order = $exlodeorder[1];
	
	
	//print $order;
	//print '<Br>';
	
	/*
	$sql= "INSERT INTO `deals_categories` (`old_id`,`title`,`order`)  VALUES (
	'".addslashes($row['_id'])."',
	'".addslashes($row['name'])."',
	'".addslashes($order)."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	*/
	
	
	//print $row['logo'];
	//print '<br>';


}


$query = "SELECT * FROM `Benefit1`   ";
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
	/*
	$exlodeexposurePrice = explode('"',$row['exposurePrice']);
	$exposurePrice = $exlodeexposurePrice[1];
	
	if ($exposurePrice)
		$exposurePrice = $exposurePrice;
	else
		$exposurePrice = $row['exposurePrice'];

	//
	$exlodeeregularPrice = explode('"',$row['regularPrice']);
	$regularPrice = $exlodeeregularPrice[1];
	
	if ($regularPrice)
		$regularPrice = $regularPrice;
	else
		$regularPrice = $row['regularPrice'];

	
	//
	$exlodememersPrice = explode('"',$row['memersPrice']);
	$memersPrice = $exlodememersPrice[1];
	
	if ($memersPrice)
		$memersPrice = $memersPrice;
	else
		$memersPrice = $row['memersPrice'];

	

	//
	$exlodeexposures = explode('"',$row['exposures']);
	$exposures = $exlodeexposures[1];
	
	if ($exposures)
		$exposures = $exposures;
	else
		$exposures = $row['exposures'];

	
	//
	$exlodeexposuresLimit = explode('"',$row['exposuresLimit']);
	$exposuresLimit = $exlodeexposuresLimit[1];
	
	if ($exposuresLimit)
		$exposuresLimit = $exposuresLimit;
	else
		$exposuresLimit = $row['exposuresLimit'];

	*/

		$find = array('NumberLong("', '")');
		$replace   = array('','');

		$exposurePrice = str_replace($find, $replace, $row['exposurePrice']);
		$regularPrice = str_replace($find, $replace, $row['regularPrice']);
		$memersPrice = str_replace($find, $replace, $row['memersPrice']);
		$exposures = str_replace($find, $replace, $row['exposures']);
		$exposuresLimit = str_replace($find, $replace, $row['exposuresLimit']);

		
	
	

	$explodeDate1 = explode('"',$row['startSellingAt']);
	$newdate1 = substr($explodeDate1[1], 0, 10);	
	$startSellingAt = ''.$newdate1.' 00:00:00';
	$explodedate1 = explode("-",$newdate1);
	$startSellingAt = ''.$explodedate1[2].'/'.$explodedate1[1].'/'.$explodedate1[0].'';
	
	//print $startSellingAt;
	//print '<Br>';

	$explodeDate2 = explode('"',$row['stopSellingAt']);
	$newdate2 = substr($explodeDate2[1], 0, 10);	
	$stopSellingAt = ''.$newdate2.' 00:00:00';
	$explodedate2 = explode("-",$newdate2);
	$stopSellingAt = ''.$explodedate2[2].'/'.$explodedate2[1].'/'.$explodedate2[0].'';


	//print $stopSellingAt;
	//print '<Br>';

	
	if ($row['type'] =="CATALOG")
		$type = 0;
	else
		$type = 1;
	

	
	if ($row['genderLimit'] =="BOTH")
		$gender = 2;
	if ($row['genderLimit'] =="WOMAN")
		$gender = 1;
	if ($row['genderLimit'] =="MAN")
		$gender = 0;

	$supplier = str_replace("Supplier$","",$row['_p_supplier']);
	
	$catalog = str_replace("Catalog_Category$","",$row['_p_category']);

	if ($row['codeType'] =="CODE")
		$dealtype = 0;
	else
		$dealtype = 1;


	$exlodeelikes = explode('"',$row['likes']);
	$likes = $exlodeelikes[1];

	$query2 = "SELECT * FROM `suppliers`  WHERE `oldId` = '".$supplier."' ";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$num_rows2 = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_array($result2);

	
	$query3 = "SELECT * FROM `deals_categories`  WHERE `old_id` = '".$catalog."' ";
	$result3=mysqli_query($query3) or die('error connecting55'); 
	$num_rows3 = mysqli_num_rows($result3);
	$row3 = mysqli_fetch_array($result3);


	
	//print $num_rows3;
	//print '<br>';

	
	//print $likes;
	//print '<br>';		
	//print $supplier;
	//print '<br>';
	//print ''.$row['genderLimit'].' - '.$gender.'';
	//print '<br>';

	
	
	
/*
	$sql= "INSERT INTO `deals` (
	`oldId`,
	`title`,
	`cat_id`,
	`supplier_id`,
	`regular_price`,
	`member_price`,
	`exposure_price`,
	`dealgivenby`,
	`codelink`,
	`youtube`,
	`desc`,
	`exposures`,
	`terms`,
	`benfit_type`,
	`likes`,
	`gender`,
	`start_sell`,
	`end_sell`,
	`limit_exposure`)  VALUES (
	'".addslashes($row['_id'])."',
	'".addslashes($row['title'])."',
	'".addslashes($row3['index'])."',
	'".addslashes($row2['index'])."',
	'".addslashes($regularPrice)."',
	'".addslashes($memersPrice)."',
	'".addslashes($exposurePrice)."',
	'".addslashes($dealtype)."',
	'".addslashes($row['codeContent'])."',
	'".addslashes($row['youtubeUrl'])."',
	'".addslashes($row['desc'])."',
	'".addslashes($exposures)."',	
	'".addslashes($row['conditions'])."',
	'".addslashes($type)."',
	'".addslashes($likes)."',
	'".addslashes($gender)."',
	'".addslashes($startSellingAt)."',
	'".addslashes($stopSellingAt)."',
	'".addslashes($exposuresLimit)."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();

	print $insertId;
	print '<br>';

*/

}	
											

											
$query = "SELECT * FROM `Benefit_Daily1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;


while ( $row = mysqli_fetch_array($result) )
{
	$explodeDate1 = explode('"',$row['date']);
	$newdate1 = substr($explodeDate1[1], 0, 10);	
	$startSellingAt = ''.$newdate1.' 00:00:00';
	$explodedate1 = explode("-",$newdate1);
	$newdate = ''.$explodedate1[2].'/'.$explodedate1[1].'/'.$explodedate1[0].'';
	
	
	//print $newdate;
	//print '<br>';	


	if ($row['gender'] =="MAN")
		$gender = 4;
	
	if ($row['gender'] =="WOMAN")
		$gender = 5;
	
	if ($row['gender'] =="BOTH")
		$gender = 6;	
	
	$benfit  = str_replace("Benefit$","",$row['_p_benefit']);	
	
	$query3 = "SELECT * FROM `deals`  WHERE `oldId` = '".$benfit."' ";
	$result3=mysqli_query($query3) or die('error connecting55'); 
	$num_rows3 = mysqli_num_rows($result3);
	$row3 = mysqli_fetch_array($result3);

	
	//print $row3['title'];
	//print '<br>';	
	
	
	/*
	$sql= "INSERT INTO `deal_dates` (`deal_id`,`date`,`type`)  VALUES (
	'".addslashes($row3['index'])."',
	'".addslashes($newdate)."',
	'".addslashes($gender)."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	

	print $insertId;
	print '<br>';		
	*/

}


$query = "SELECT * FROM `Benefit_Image1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;


while ( $row = mysqli_fetch_array($result) )
{


	$image1 = '';
	$image2 = '';
	$image3 = '';
	$image4 = '';
	
	$oldimage = 'http://files.parsetfss.com/5a4ee413-7280-4506-ab61-d9633e75d9dd/'.$row['image'].'';

	
	$dealid = str_replace("Benefit$","",$row['_p_benefit']);
	
	
	$explodenumber = explode('"',$row['index']);
	$imagenumber = $explodenumber[1];


	$query3 = "SELECT * FROM `deals`  WHERE `oldId` = '".$dealid."' ";
	$result3=mysqli_query($query3) or die('error connecting55'); 
	$num_rows3 = mysqli_num_rows($result3);
	$row3 = mysqli_fetch_array($result3);

	if ($imagenumber == 1)
	{
		$image1 = $row['image'];
		
	$updateQuery = "UPDATE `deals` 
	 SET   
	 `image` ='".addslashes($row['image'])."'
	 WHERE `index` ='".mysqli_real_escape_string($row3['index'])."'";
	 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 
	 
		
	}
		
	
	  if ($imagenumber == 2)
	 {
		 
		$updateQuery = "UPDATE `deals` 
		 SET   
		`image2` ='".addslashes($row['image'])."'
		 WHERE `index` ='".mysqli_real_escape_string($row3['index'])."'";
		 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

	 
		 $image2 = $row['image'];
	 }
		

	  if ($imagenumber == 3)
	 {
		 
		$updateQuery = "UPDATE `deals` 
		 SET   
		`image3` ='".addslashes($row['image'])."'
		 WHERE `index` ='".mysqli_real_escape_string($row3['index'])."'";
		 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

	 
		 $image3 = $row['image'];
	 }
		

	  if ($imagenumber == 4)
	 {
		 
		$updateQuery = "UPDATE `deals` 
		 SET   
		`image4` ='".addslashes($row['image'])."'
		 WHERE `index` ='".mysqli_real_escape_string($row3['index'])."'";
		 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

	 
		 $image4 = $row['image'];
	 }
			
	

	//1

	 
	 //2

	 
	//3

	 
	 
	//4


	 
	 
	 
	 
	 

	//update deals
	 
	print ''.$row3['index'].' (image1: '.$image1.') - (image2: '.$image2.') - (number: '.$imagenumber.')';
	print '<br>'; 
	
	//download_image1($oldimage, "deals/".$row['image']."");




	
}

// old fix prices (dont use)

/*
$query = "SELECT * FROM `deals`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;


while ( $row = mysqli_fetch_array($result) )
{
	
	$query2 = "SELECT * FROM `Benefit1`  WHERE `_id` = '".$row['oldId']."' ";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$num_rows2 = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_array($result2);

	if ($num_rows2 > 0)
	{
		
		$find = array('NumberLong("', '")');
		$replace   = array('','');

		$exposurePrice = str_replace($find, $replace, $row2['exposurePrice']);
		$regularPrice = str_replace($find, $replace, $row2['regularPrice']);
		$memersPrice = str_replace($find, $replace, $row2['memersPrice']);
		$exposures = str_replace($find, $replace, $row2['exposures']);
		$exposuresLimit = str_replace($find, $replace, $row2['exposuresLimit']);

		
		
		
		/*
		$exlodeexposurePrice = explode('"',$row2['exposurePrice']);
		$exposurePrice = $exlodeexposurePrice[1];
		
		if ($exposurePrice)
			$exposurePrice = $exposurePrice;
		else
			$exposurePrice = $row2['exposurePrice'];

		//
		$exlodeeregularPrice = explode('"',$row2['regularPrice']);
		$regularPrice = $exlodeeregularPrice[1];
		
		if ($regularPrice)
			$regularPrice = $regularPrice;
		else
			$regularPrice = $row2['regularPrice'];

		
		//
		$exlodememersPrice = explode('"',$row2['memersPrice']);
		$memersPrice = $exlodememersPrice[1];
		
		if ($memersPrice)
			$memersPrice = $memersPrice;
		else
			$memersPrice = $row2['memersPrice'];

		

		//
		$exlodeexposures = explode('"',$row2['exposures']);
		$exposures = $exlodeexposures[1];
		
		if ($exposures)
			$exposures = $exposures;
		else
			$exposures = $row2['exposures'];

		
		//
		$exlodeexposuresLimit = explode('"',$row2['exposuresLimit']);
		$exposuresLimit = $exlodeexposuresLimit[1];
		
		if ($exposuresLimit)
			$exposuresLimit = $exposuresLimit;
		else
			$exposuresLimit = $row2['exposuresLimit'];

		
		
		
		//print $exlodeeregularPrice[0];;
		
		
		
		
		
		
		print ''.$row['index'].' - '.$regularPrice.'';
		print '<br>';
		


		
		$updateQuery = "UPDATE `deals` 
		 SET   
		 `regular_price` ='".addslashes($regularPrice)."',
		 `member_price` ='".addslashes($memersPrice)."',
		 `exposure_price` ='".addslashes($exposurePrice)."',
		 `exposures` ='".addslashes($exposures)."',
		 `limit_exposure` ='".addslashes($exposuresLimit)."'
		 WHERE `index` ='".mysqli_real_escape_string($row['index'])."'";
		 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 
		 
			
	}
	

}	

*/	


	

?>