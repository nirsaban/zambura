<?php
include_once('../php/db.php');

if ($_POST['filename'] && $_POST['id'])
{
	
	
	
	
$sql= "INSERT INTO `banners_new_gallery` (`banner_id`,`image`)  VALUES ('".addslashes($_POST['id'])."','".addslashes($_POST['filename'])."')";
$InsertSql = mysqli_query($sql);	
		
	
	

	
	
	
}




?>

