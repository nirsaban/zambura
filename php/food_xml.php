<?php
set_time_limit(0);
ini_set('display_errors', 0);
include_once('db.php');

$catagory = "cafes-and-treats";
$catagory_id = "24";
$supplier_id = "174";
$groupon_cat_id = "188";
$g = 0;

$threemonths =  date('d/m/Y', strtotime('+3 months'));
$today = date('d/m/Y');






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




$url = 'https://affiliate.grouponisrael.co.il/affiliate/server/1.0/loginUser/';
$fields = array('userName' => 'tipli','password' => '12345678');
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
$result = curl_exec($ch);
$json_a = json_decode($result, true);
$tokenPass = $json_a['data']['token'];
//close connection
curl_close($ch);



if ($tokenPass)
{
	$url = 'https://affiliate.grouponisrael.co.il/affiliate/server/1.0/getProducts/';
	$fields = array('token' => $tokenPass,'categoryId' => $groupon_cat_id);
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
	$result = curl_exec($ch);
	$json_a = json_decode($result, true);
	curl_close($ch);
	
	//print_r($json_a);
	$countArray = count($json_a['data']);
	
	if ($countArray > 0)
	{
		foreach ($json_a['data'] as $key=>$value)
		{
				

		
				
				$uuid = $value['id'];

				
				
				
				$query = "SELECT * FROM `deals` WHERE `groupon_id` = '".$uuid."'  ";
				$result=mysql_query($query);
				$num_rows = mysql_num_rows($result);

				if ($num_rows == 0)
				{

					$imageurl = 'https://www.grouponisrael.co.il/'.$value['image'].'';
					$short_title = $value['short_title'];
					$title = $value['title'];
					$old_price = $value['old_price'];
					$price = $value['price'];
					$deal_url = $value['product_url'];
					$short_desc = strip_tags($value['short_description']);
					$start_date = date('d/m/Y', $value['date_live']);
					$end_date = date('d/m/Y', $value['to_ts']);
					
					
					$gps_lat =  $value['gps']['lat'];
					$gps_lon =  $value['gps']['lon'];
					
					

					//print $title;
					//print $start_date;
					//print '<br>';
					

					$file2 = "groupon/".$uuid."_2.jpg";
					$newimage2 = "uploads/groupon/".$uuid."_2.jpg";
					download_image1($imageurl,$newimage2);
				
				
					$g++;	
					
					$sql= "INSERT INTO `deals` (
					`groupon_id`,
					`title`,
					`showiframe`,
					`cat_id`,
					`supplier_id`,
					`regular_price`,
					`member_price`,
					`dealgivenby`,
					`codelink`,
					`image`,
					`desc`,
					`terms`,
					`gender`,
					`start_sell`,
					`end_sell`,
					`location_lat`,
					`location_lng`)  
					VALUES (
					'".addslashes($uuid)."',
					'".addslashes(strip_tags($short_title))."',
					'0',
					'".addslashes($catagory_id)."',
					'".addslashes($supplier_id)."',
					'".addslashes($old_price)."',
					'".addslashes($price)."',
					'1',
					'".addslashes($deal_url)."',
					'".addslashes($file2)."',
					'".addslashes($short_desc)."',
					'".addslashes($title)."',
					'2',
					'".addslashes($start_date)."',
					'".addslashes($end_date)."',
					'".addslashes($gps_lat)."',
					'".addslashes($gps_lon)."')";
					$InsertSql = mysql_query($sql);


			

				   //if ($g > 0)
					   //exit;
				}
		}				
	}


		
}

  print ''.$g.' new deals';

?>