<?
header('Access-Control-Allow-Origin: *');

include_once('../php/db.php');
include_once('config.php');

mb_internal_encoding("UTF-8");



//	$post = file_get_contents("php://input");
//    $json = json_decode($post,true);
	
	$articlearray = array();

		

	
	
	$query = "SELECT * FROM `supplier_brances` WHERE  `supplier_id` = '".$_POST['id']."'  ORDER BY `name` ASC";
	$result=mysqli_query($query) or die('error connecting1'); 
	$num_rows = mysqli_num_rows($result);
//	$row = mysqli_fetch_array($result);


	while ( $row =  mysqli_fetch_assoc($result) )
	{

				$articlearray[] =  $row;			

	}

	
	echo json_encode($articlearray);  
?>