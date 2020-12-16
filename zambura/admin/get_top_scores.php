<?php
include_once('../php/db.php');

// 01/11/2016

$year = $_POST['year'];
$month = $_POST['month'];
$user = $_POST['user'];


//$explodeDate = explode("/",$date);


//$newdate = ''.$explodeDate['2'].'-'.$explodeDate['1'].'-'.$explodeDate['0'].'';

$newdate = ''.$year.'-'.$month.'-';


$articlearray = array();

$questionOne = 0;
$questionTwo = 0;
$questionThree = 0;
$questionFour = 0;

$totalAnswers = 0;



$correntAnswers = 0;
$WrongAnswers = 0;

//  `date` LIKE '".$newdate."%'

$query = "SELECT * FROM `answered_questions` WHERE `user_id` = '".$user."' AND `date` LIKE '".$newdate."%' ORDER BY `index` DESC";
$result=mysqli_query($query) or die('error connecting'); 				
//$row =  mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);


while ( $row =  mysqli_fetch_assoc($result) )
{


	$totalAnswers = 0;
	
	if ($row['correct'] == "1")
		$correntAnswers++;

	if ($row['correct'] == "0")
		$WrongAnswers++;
	
	/*

	if ($row['answer_index'] == 1)
		$questionOne++;

	if ($row['answer_index'] == 2)
		$questionTwo++;
	
	if ($row['answer_index'] == 3)
		$questionThree++;
	
	if ($row['answer_index'] == 4)
		$questionFour++;
	
	*/
	
	$totalAnswers = $totalAnswers+($correntAnswers+$WrongAnswers);
	
	
	
}


//$articlearray['num'] = $num2;


$articlearray['correntmonth'] = $correntAnswers;
$articlearray['wrongmonth'] = $WrongAnswers;

$articlearray['totalmonth'] = $totalAnswers;

/*
$articlearray['one'] = $questionOne;
$articlearray['two'] = $questionTwo;
$articlearray['three'] = $questionThree;
$articlearray['four'] = $questionFour;
*/




		
		
echo json_encode($articlearray); 

/*
if ($num > 0)
{
	echo json_encode($row);
}
else
{
	$jsonarray[] = array('status' => '0');  
	 echo json_encode($jsonarray);  
}
  
*/
		
	
		


?>