<?php

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
		
	$con = mysqlii_connect($dbhost, $dbuser, $dbpass,'ofer');
	if(! $con )
	{
	  die('Could not connect: ' . mysqlii_error($con));
	}


	
	
	//////Settings
	

?>
