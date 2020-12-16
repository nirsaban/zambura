<?php

include_once('../php/db.php');

exit;


$query = "SELECT * FROM `Question1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
$i = 0;
/*
$answer1 = '';
$answer2 = '';
$answer3 = '';
$answer4 = '';
*/
$currentAnswer = '';
while ( $row = mysqli_fetch_array($result) )
{
	
	
	$exlodewrong = explode('"',$row['wrongAnsweringCount']);
	$exloderight = explode('"',$row['correctAnsweringCount']);
	
	$wrongcount = $exlodewrong[1];
	$rightcount = $exloderight[1];
	
	
	//print $exlodewrong[1];
	//print '<Br>';
	
	

	
	$query2 = "SELECT * FROM `Answer1`  WHERE `_p_question` = 'Question$".$row['_id']."' ";
	$result2=mysqli_query($query2) or die('error connecting55'); 
	$num_rows2 = mysqli_num_rows($result2);
	//$row2 = mysqli_fetch_array($result2);
	
	while ( $row2 = mysqli_fetch_array($result2) )
	{
		$i++;
		//print $i;
		//print '<br>';
		//print $row2['content'];
		
		//print $num_rows2;
		if ($num_rows2 > 0)
		{
			if ($i == 1)
			{
				$answer1 = $row2['content'];
				//print $answer1;
				if ($row2['isCorrect'] =="true")
					$currentAnswer = 1;
			}
			if ($i == 2)
			{
				$answer2 = $row2['content'];
				//print $answer1;
				if ($row2['isCorrect'] =="true")
					$currentAnswer = 2;				
			}
			if ($i == 3)
			{
				$answer3 = $row2['content'];
				//print $answer1;
				if ($row2['isCorrect'] =="true")
					$currentAnswer = 3;				
			}
			if ($i == 4)
			{
				$answer4 = $row2['content'];
				//print $answer1;
				if ($row2['isCorrect'] =="true")
					$currentAnswer = 4;				
			}			
		}

	
	}
	$i = 0;
	
	
	//print $currentAnswer;
	//print '<br>';

	
	

	
	
	//,`question_youtube`
	$sql= "INSERT INTO `questions` (`question`,`question_image`,`answer1`,`answer2`,`answer3`,`answer4`,`correct_answer`,`explaination`,`explain_image`,`wrongAnsweringCount`,`correctAnsweringCount`)  VALUES ('".addslashes($row['content'])."','".addslashes($row['image'])."','".addslashes($answer1)."','".addslashes($answer2)."','".addslashes($answer3)."','".addslashes($answer4)."','".addslashes($currentAnswer)."','".addslashes($row['answerDescription'])."','".addslashes($row['answerImage'])."','".addslashes($wrongcount)."','".addslashes($rightcount)."')";
	$InsertSql = mysqli_query($sql) or die(mysqli_error()); 
	$insertId = mysqli_insert_id();
	
	
	$query3 = "SELECT * FROM `Daily_Q1`  WHERE `_p_question` = 'Question$".$row['_id']."' ";
	$result3=mysqli_query($query3) or die('error connecting55'); 
	$num_rows3 = mysqli_num_rows($result3);
	$row3 = mysqli_fetch_array($result3);	


	$explode = explode('"',$row3['date']);
	$newdate = substr($explode[1], 0, 10);	
	$explodedate = explode("-",$newdate);
	$formatteddate = ''.$explodedate[2].'/'.$explodedate[1].'/'.$explodedate[0].'';
	//print $formatteddate;
	//print '<br>';	

	
	
	if ($num_rows3 > 0)
	{
		$sql= "INSERT INTO `questions_dates` (`question_id`,`date`,`type`)  VALUES ('".addslashes($insertId)."','".addslashes($formatteddate)."','1')";
		$InsertSql = mysqli_query($sql) or die(mysqli_error()); 		
	}


	
	
	//print $row['content'];
	print '<br>';

}
											


?>