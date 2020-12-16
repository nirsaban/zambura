<?php
include_once('../php/db.php');

// 01/11/2016
$id = $_POST['id'];
$date = $_POST['date'];
$explodeDate = explode(" ",$date);
$explodeDate2 = explode("-",$explodeDate[0]);
$newdate = ''.$explodeDate2['0'].'-'.$explodeDate2['1'].'-'.$explodeDate2['2'].'';

$articlearray = array();

$questionOne = 0;
$questionTwo = 0;
$questionThree = 0;
$questionFour = 0;

$correntAnswers = 0;
$WrongAnswers = 0;

//if ($id !="undefined")
//{
	$query2 = "SELECT * FROM `users_points` WHERE `question_id` = '".$id."' AND `question_date` =   '".$newdate."'  ";

//}

$result2=mysqli_query($query2) or die('error connecting'); 
//$row2 =  mysqli_fetch_assoc($result2);	
$num2  = mysqli_num_rows($result2);
		
		
$query3 = "SELECT * FROM `month_questions` WHERE `index` =  '".$id."'  ";
$result3=mysqli_query($query3) or die('error connecting'); 
$row3 =  mysqli_fetch_assoc($result3);	
$num3  = mysqli_num_rows($result3);		
	



while ( $row =  mysqli_fetch_assoc($result2) )
{



	
	
	
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
	
	
}

$title = stripslashes($row3['question']);
$articlearray['title'] = $title;
    
    
$articlearray['num'] = $num2;


$articlearray['correnttoday'] = $correntAnswers; //$query2;
$articlearray['wrongtoday'] = $WrongAnswers;

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