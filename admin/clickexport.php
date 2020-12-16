<?php
session_start();

include_once('../php/db.php');
include_once('config.php');

mb_internal_encoding("UTF-8");

if (!$_SESSION['admin'])
{
	header('Location: index.php');
	exit;
}

if ($_GET['startdate'])
{
	$startExplode = explode("/",$_GET['startdate']);
	$newstart = ''.$startExplode[2].'-'.$startExplode[0].'-'.$startExplode[1].'';
	//print  ($newstart);
	$endExplode = explode("/",$_GET['enddate']);
	$enddate = ''.$endExplode[2].'-'.$endExplode[0].'-'.$endExplode[1].'';

	$query = "SELECT `index`,`supplier_id`,`deal_id`,`date`, count(*) AS counter FROM `deal_clicks`   WHERE `supplier_id` = '".$_GET['id']."' AND  (date(date) BETWEEN '".$newstart."' AND '".$enddate."') GROUP BY `deal_id`  ORDER BY `index` DESC";


}
else
{
	$query = "SELECT `index`,`supplier_id`,`deal_id`,`date`, count(*) AS counter FROM `deal_clicks`   WHERE `supplier_id` = '".$_GET['id']."'  GROUP BY `deal_id`  ORDER BY `index` DESC";

}

//die($result);

$result = mysqli_query($query); 


if (!$result) die('Couldn\'t fetch records'); 



$unixTime = date("U");
$filename = 'clicks_'.$unixTime.'.xls';



function utf2heb($val)
{
return iconv("UTF-8","WINDOWS-1255",html_entity_decode($val,ENT_COMPAT,'utf-8'));
}
	
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");


header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=".$filename." ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();



xlsWriteLabel(0,0,iconv("UTF-8", "windows-1255",'#'));
xlsWriteLabel(0,1,iconv("UTF-8", "windows-1255",'שם הדיל'));
xlsWriteLabel(0,2,iconv("UTF-8", "windows-1255",'קליקים'));
xlsWriteLabel(0,3,iconv("UTF-8", "windows-1255",'תאריך'));



$xlsRow = 1;
$g = 0;

while($row=mysqli_fetch_array($result)){
$g++;
$formattedDate = date("d/m/y H:i:s", strtotime($row['date']));


$query20 = "SELECT *  FROM `deals`   WHERE `index` = '".$row['deal_id']."' ";
$result20 =mysqli_query($query20) or die('error connecting55'); 
//$num_rows = mysqli_num_rows($result20);
$row20 = mysqli_fetch_array($result20);	
	
	
xlsWriteNumber($xlsRow,0,$g);
xlsWriteLabel($xlsRow,1,stripslashes(utf2heb($row20['title'])));
xlsWriteNumber($xlsRow,2,stripslashes($row['counter']));
xlsWriteLabel($xlsRow,3,$formattedDate);



$xlsRow++;

//}

}
xlsEOF();
exit();



?>