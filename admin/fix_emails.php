<?php

include_once('../php/db.php');


$unixTime = date("U");

function utf2heb($val)
{
return iconv("UTF-8","WINDOWS-1255",html_entity_decode($val,ENT_COMPAT,'utf-8'));
}
	
$tableName = "users";	
	
$result = mysqli_query('SELECT * FROM `'.$tableName.'` ORDER BY `index` DESC'); 
if (!$result) die('Couldn\'t fetch records'); 


$filename = 'users_'.$unixTime.'.csv';

	  
	 $leadsArray = array(
   	 "0"  => "חדש",
   	 "1"  => "בטיפול",
   	 "2"  => "לא מעוניין",
   	 "3"  => "נמכר",
   	 "4"  => "לא תקין"

	);

$fp = fopen($filename, 'w+b');

$csvname="".strtoupper($tableName)."\r\n"; 
//$csvtitles = "#,שם מלא,טלפון,אימייל,הודעה,הערה,סטטוס,נמכר במחיר,מקור הטופס,תאריך\r\n";

$csvtitles = "אימייל\r\n";

//fwrite($fp,'RETALEX'); 
//fwrite($fp,$csvtitles); 

$i = 0;
while ($row= mysqli_fetch_array($result)) { 
$i++; 


$ReplaceEmail = str_replace(",", " ", $row['email']);		  

/*	  
$ReplaceName = str_replace(",", " ", $row['Name']);		
//$ReplaceMsgCommas = str_replace(",", " ", $row['Msg']);
//$ReplaceMsgSymbolA = str_replace("!", "", $ReplaceMsgCommas);
//$ReplaceMsg = str_replace("?", "", $ReplaceMsgSymbolA);
$ReplaceMsgCommas = str_replace(",", " ", $row['Msg']);
$ReplaceMsg = mb_substr(stripslashes($ReplaceMsgCommas),0,30,'UTF-8');

$ReplaceRemark = str_replace(",", " ", $row['Remark']);
$formattedDate = date("d/m/y H:i:s", strtotime($row['Date']));
$leadStatus  = $leadsArray[''.$row['Lead_Status'].''];
*/


//$string ="".$i.",".$ReplaceName.",".stripslashes($row['Telephone']).",".stripslashes($ReplaceEmail).",".stripslashes($ReplaceMsg)."\t,".$ReplaceRemark.",".$leadStatus.",".$row['SellPrice'].",".$row['Identify'].",".$formattedDate."\r\n";

$string ="".$ReplaceEmail."\r\n";
fwrite($fp,$string); 

}

$out=file_get_contents("{$filename}"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv; charset=windows-1255");
header("Content-Disposition: attachment; filename={$filename}");
header('Pragma: no-cache');    
header('Expires: 0');
echo utf2heb($out); 

fclose($fp);
unlink($filename);




//exit;





?>