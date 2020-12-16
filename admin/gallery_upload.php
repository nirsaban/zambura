<?php
include_once('../php/db.php');

if ($_POST['filename'] && $_POST['id'])
{
	
	
	
	
$sql= "INSERT INTO `gallery` (`gallery_id`,`type`,`image`)  VALUES ('".addslashes($_POST['id'])."','".addslashes($_POST['type'])."','".addslashes($_POST['filename'])."')";
$InsertSql = mysqli_query($sql);	
		
	
	

	
	
	
}




?>

