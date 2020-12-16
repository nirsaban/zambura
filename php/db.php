<?php

	$dbhost = "127.0.0.1";
	$dbuser = "onclickj_zambura";
	$dbpass = "parnasa2020";
		
	$con = mysqli_connect($dbhost, $dbuser, $dbpass,'zambura');
	 if(! $con )
    	{
	  die('Could not connect: ' . mysqli_error($con));
	  }

		  
	// mysqlii_query("SET NAMES utf8");

	
	
	//////Settings
	

?>
