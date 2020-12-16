<?php

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
		
	$con = mysqli_connect($dbhost, $dbuser, $dbpass,'ofer');
	 if(! $con )
    	{
	  die('Could not connect: ' . mysqli_error($con));
	  }

		  
	// mysqlii_query("SET NAMES utf8");

	
	
	//////Settings
	

?>
