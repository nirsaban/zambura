<?php
include_once('../php/db.php');

// 01/11/2016
$id = $_POST['id'];
$date = $_POST['date'];
$explodeDate = explode("/",$date);
$newdate = ''.$explodeDate['2'].'-'.$explodeDate['1'].'-'.$explodeDate['0'].'';

$articlearray = array();

$questionOne = 0;
$questionTwo = 0;
$questionThree = 0;
$questionFour = 0;

$correntAnswers = 0;
$WrongAnswers = 0;

if ($id !="undefined")
    $query2 = "SELECT * FROM `questions_dates` WHERE `question_id` = '".$id."' AND `date` =  '".$date."'  ORDER BY `index` DESC ";
else
     $query2 = "SELECT * FROM `questions_dates` WHERE `date` =  '".$date."'  ORDER BY `index` DESC ";
        
$result2=mysqli_query($query2) or die('error connecting'); 
$row2 =  mysqli_fetch_assoc($result2);	
$num2  = mysqli_num_rows($result2);
		
		
$query3 = "SELECT * FROM `questions` WHERE `index` =  '".$row2['question_id']."'  ORDER BY `index` DESC ";
$result3=mysqli_query($query3) or die('error connecting'); 
$row3 =  mysqli_fetch_assoc($result3);	
$num3  = mysqli_num_rows($result3);		
	
//	
		
$query = "SELECT * FROM `answered_questions` WHERE `question_id` = '".$row2['question_id']."' AND `date` LIKE '".$newdate."%'  GROUP BY `user_id` ORDER BY `index` DESC";
$result=mysqli_query($query) or die('error connecting'); 				
//$row =  mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);


while ( $row =  mysqli_fetch_assoc($result) )
{



			
			
/*
	if ($row['question_id'] > 0)
	{

		

		if ($num2 > 0)
		{
			$title = stripslashes($row2['question']);
			$articlearray['title'] = $title;				
		}

		else
		{
			$title = "";
			$articlearray['title'] = $title;	
		}
	}

*/



	
	
	
	if ($row['correct'] == "1")
		$correntAnswers++;


	if ($row['correct'] == "0")
		$WrongAnswers++;

	if ($row['answer_index'] == 1)
		$questionOne++;

	if ($row['answer_index'] == 2)
		$questionTwo++;
	
	if ($row['answer_index'] == 3)
		$questionThree++;
	
	if ($row['answer_index'] == 4)
		$questionFour++;
	
	
	
}

$title = stripslashes($row3['question']);
$articlearray['title'] = $title;
    
    
$articlearray['num'] = $num3;


$articlearray['correnttoday'] = $correntAnswers; //$query2;
$articlearray['wrongtoday'] = $WrongAnswers;

$articlearray['one'] = $questionOne;
$articlearray['two'] = $questionTwo;
$articlearray['three'] = $questionThree;
$articlearray['four'] = $questionFour;





		
		
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