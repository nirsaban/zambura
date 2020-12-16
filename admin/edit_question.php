<?
if (!isset($_SESSION)) {
session_start();
}

include_once('../php/db.php');
include_once('config.php');

mb_internal_encoding("UTF-8");


if (!$_SESSION['admin'])
{
	header('Location: index.php');
	exit;
}


if ($_GET['delimage'] == 1)
{
	
	$updateQuery = "UPDATE `questions` 
	 SET   
	 `question_image` =''
	 WHERE `index` ='".mysqli_real_escape_string($_GET['id'])."'";
	 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

	 
	header('Location: edit_question.php?id='.$_GET['id'].'');
}

if ($_GET['delimage'] == 2)
{
	
	$updateQuery = "UPDATE `questions` 
	 SET   
	 `explain_image` =''
	 WHERE `index` ='".mysqli_real_escape_string($_GET['id'])."'";
	 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

	 
	header('Location: edit_question.php?id='.$_GET['id'].'');
}


if ($_POST['update'])
{
	$newfile = '';
	$newfile2 = '';
	$savedate = date("mdy-Hms");

    $imagequestion1 = '';
    $imagequestion2 = '';
    $imagequestion3 = '';
    $imagequestion4 = '';

	
	
$query2 = "SELECT * FROM `questions` WHERE `index` = '".$_GET['id']."'";
$result2 = mysqli_query($query2) or die('error connecting'); 												
$row2 = mysqli_fetch_array($result2);

    /* question image*/
if ($_FILES['file']['name'])
{

	$upload_file_name = $_FILES['file']['name'];
	$savedate = date("mdy-Hms");	
	$fileName = "../php/uploads/".$savedate."_".$upload_file_name;
	$saveDir = "".$savedate."_".$upload_file_name;
	$tmp_name = $_FILES["file"]["tmp_name"];

	if(move_uploaded_file($tmp_name,$fileName)) 
	{
		$newfile = $saveDir;
	}
	else
	{
		$newfile = '';
	}
	
}
else {
	$newfile = stripslashes($row2['question_image']);
}

    /* explain image*/
if ($_FILES['file2']['name'])
{

	$upload_file_name2 = $_FILES['file2']['name'];
	$fileName2 = "../php/uploads/".$savedate."_".$upload_file_name2;
	$saveDir2 = "".$savedate."_".$upload_file_name2;
	$tmp_name2 = $_FILES["file2"]["tmp_name"];

	if(move_uploaded_file($tmp_name2,$fileName2)) 
	{
		$newfile2 = $saveDir2;
	}
	else
	{
		$newfile2 = '';
	}
	
}
else 
{
	$newfile2 = stripslashes($row2['explain_image']);
}

    /* question image 1 type 4*/
    if ($_FILES['four_images_image1']['name'])
    {

        $upload_file_name3 = $_FILES['four_images_image1']['name'];
        $fileName3 = "../php/uploads/".$savedate."_".$upload_file_name3;
        $saveDir3 = "".$savedate."_".$upload_file_name3;
        $tmp_name3 = $_FILES["four_images_image1"]["tmp_name"];

        if(move_uploaded_file($tmp_name3,$fileName3))
        {
            $imagequestion1 = $saveDir3;
        }
        else
        {
            $imagequestion1 = '';
        }
    }
    else {
        $imagequestion1 = stripslashes($row2['question_image']);
    }
    /* question image 1 type 4*/


    /* question image 2 type 4*/
    if ($_FILES['four_images_image2']['name'])
    {

        $upload_file_name4 = $_FILES['four_images_image2']['name'];
        $fileName4 = "../php/uploads/".$savedate."_".$upload_file_name4;
        $saveDir4 = "".$savedate."_".$upload_file_name4;
        $tmp_name4 = $_FILES["four_images_image2"]["tmp_name"];

        if(move_uploaded_file($tmp_name4,$fileName4))
        {
            $imagequestion2 = $saveDir4;
        }
        else
        {
            $imagequestion2 = '';
        }
    }
    else {
        $imagequestion2 = stripslashes($row2['question_image2']);
    }
    /* question image 2 type 4*/



    /* question image 3 type 4*/
    if ($_FILES['four_images_image3']['name'])
    {

        $upload_file_name5 = $_FILES['four_images_image3']['name'];
        $fileName5 = "../php/uploads/".$savedate."_".$upload_file_name5;
        $saveDir5 = "".$savedate."_".$upload_file_name5;
        $tmp_name5 = $_FILES["four_images_image3"]["tmp_name"];

        if(move_uploaded_file($tmp_name5,$fileName5))
        {
            $imagequestion3 = $saveDir5;
        }
        else
        {
            $imagequestion3 = '';
        }
    }
    else {
        $imagequestion3 = stripslashes($row2['question_image3']);
    }
    /* question image 3 type 4*/


    /* question image 4 type 4*/
    if ($_FILES['four_images_image4']['name'])
    {

        $upload_file_name6 = $_FILES['four_images_image4']['name'];
        $fileName6 = "../php/uploads/".$savedate."_".$upload_file_name6;
        $saveDir6 = "".$savedate."_".$upload_file_name6;
        $tmp_name6 = $_FILES["four_images_image4"]["tmp_name"];

        if(move_uploaded_file($tmp_name6,$fileName6))
        {
            $imagequestion4 = $saveDir6;
        }
        else
        {
            $imagequestion4 = '';
        }
    }
    else {
        $imagequestion4 = stripslashes($row2['question_image4']);
    }
    /* question image 4 type 4*/


    if ($_POST['question_type'] == 1){
        $question1 = $_POST['two_answers_answer1'];
        $question2 = $_POST['two_answers_answer2'];
    } else {
        $question1 = $_POST['answer1'];
        $question2 = $_POST['answer2'];
    }

    if ($_POST['question_type'] == 0){
        $question_image1 = $newfile;
    } else {
        $question_image1 = $imagequestion1;
    }



	$updateQuery = "UPDATE `questions` 
	 SET   
	 `category_id` ='".addslashes($_POST['category'])."',
	 `question` ='".addslashes($_POST['questiondesc'])."',
	 `question_image` ='".addslashes($question_image1)."',
	 `question_image2` ='".addslashes($imagequestion2)."',
	 `question_image3` ='".addslashes($imagequestion3)."',
	 `question_image4` ='".addslashes($imagequestion4)."',
	 `question_youtube` ='".addslashes($_POST['youtube'])."',
	 `answer1` ='".addslashes($question1)."',
	 `answer2` ='".addslashes($question2)."',
	 `answer3` ='".addslashes($_POST['answer3'])."',
	 `answer4` ='".addslashes($_POST['answer4'])."',
	 `correct_answer` ='".addslashes($_POST['correctanswer'])."',
	 `explaination` ='".addslashes($_POST['explaination'])."',
	 `explain_image` ='".addslashes($newfile2)."',
	 `explain_youtube` ='".addslashes($_POST['youtube2'])."',
	 `from_transportation` ='".addslashes($_POST['transporationquestion'])."',
	 `question_type` ='".addslashes($_POST['question_type'])."'
	 WHERE `index` ='".mysqli_real_escape_string($_GET['id'])."'";
	 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

}



$query = "SELECT * FROM `questions` WHERE `index` = '".$_GET['id']."'";
$result = mysqli_query($query) or die('error connecting'); 												
$row = mysqli_fetch_array($result);


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
		<!--
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
		-->
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
		<link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="assets/js/vendor/colorpicker/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="assets/js/vendor/touchspin/jquery.bootstrap-touchspin.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="assets/js/vendor/chosen/chosen.css">
        <link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">



        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->


        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>





    <body id="minovate" class="appWrapper" onload="onloadCheck()">






        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->





        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">






            <!-- ===============================================
            ================= HEADER Content ===================
            ================================================ -->
            <section id="header">
                <header class="clearfix">

                    <!-- Branding -->
                    <div class="branding">
                        <a class="brand" href="index.html">
                            <span><strong>ZAMBURA </strong></span>
                        </a>
                        <a href="#" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Branding end -->








                    <!-- Search 
                    <div class="search" id="main-search">
                        <input type="text" class="form-control underline-input" placeholder="Search...">
                    </div>
                    <!-- Search end -->




                    <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">
					

						
						

                        <li class="dropdown nav-profile">
							
                            <a href class="dropdown-toggle" data-toggle="dropdown">
							<!--
                                <img src="assets/images/profile-photo.jpg" alt="" class="img-circle size-30x30">
							-->
                                <span>מנהל <i class="fa fa-angle-down"></i></span>
                            </a>
							
                            <ul class="dropdown-menu animated littleFadeInRight" role="menu">

    
                                <li>
                                    <a href="index.php?logout=1">
                                        <i class="fa fa-sign-out"></i>התנתקות
                                    </a>
                                </li>

                            </ul>

                        </li>
						
						<!--
                        <li class="toggle-right-sidebar">
                            <a href="#">
                                <i class="fa fa-comments"></i>
                            </a>
                        </li>
						-->
                    </ul>
                    <!-- Right-side navigation end -->



                </header>

            </section>
            <!--/ HEADER Content  -->





            <!-- =================================================
            ================= CONTROLS Content ===================
            ================================================== -->
            <div id="controls">





                <!-- ================================================
                ================= SIDEBAR Content ===================
                ================================================= -->
				
				<?
				$menu = 'questions';
				include_once('menu.php');
				?>

                <!--/ SIDEBAR Content -->


            </div>
            <!--/ CONTROLS Content -->




            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-full page-mail">


                    <div class="tbox tbox-sm">


                        <!-- left side -->
                        <div class="tcol w-md bg-tr-white lt b-r">



                            <!-- left side header
                            <div class="p-15 bg-white" style="min-height: 61px">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="new_club.php" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת מועדון חדש</a>

                            </div>
							-->
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="questions.php">חזרה לשאלות </a></li>


                                </ul>
								<!--
                                <h5 class="b-b p-10 text-strong">מיון</h5>
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >
                                    <li><a href="javascript:;"><i class="fa fa-fw fa-circle text-primary"></i>צפון</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw fa-circle text-default"></i>מרכז</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw fa-circle text-orange"></i>דרום</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw fa-circle text-greensea"></i>מועדפים</a></li>
                                </ul>
							-->

                            </div>
                            <!-- /left side body -->








                        </div>
                        <!-- /left side -->







                        <!-- right side -->
                        <div class="tcol">
						
                            <!-- right side header -->
                            <div class="p-15 bg-white b-b">

                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-default btn-sm br-2-l"><i class="fa fa-angle-left"></i></button>
                                    <button type="button" class="btn btn-default btn-sm br-2-r"><i class="fa fa-angle-right"></i></button>
                                </div>
                                <div class="btn-toolbar">
                                    <div class="btn-group mr-10">
                                        <label class="checkbox checkbox-custom-alt m-0 mt-5"><input type="checkbox" id="select-all"><i></i> Select All</label>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm br-2"><i class="fa fa-refresh"></i></button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm br-2">More <span class="caret"></span></button>
                                    </div>
                                </div>

                            </div>
							
                            <!-- /right side header -->


                            <!-- right side body -->
						<div class="col-md-12" style="text-align:right; margin-top:15px; direction:rtl;">

						<?
						if ($_POST['update'])
						{
						?>
						<div class="alert alert-success">
							<strong>עודכן בהצלחה</strong>
						</div>
						<?
						}
						?>
                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>עריכת שאלה: <?= $_GET['id'];?></strong> </h1>
                                </div>
                                <!-- /tile header -->

                                <div class="tile-body">


                                    <form name="form2" action="" method="post" role="form" id="form2" enctype="multipart/form-data" data-parsley-validate>



									
                                        <div class="form-group">
                                            <label for="message">תוכן שאלה: </label>
                                            <textarea class="form-control"  rows="8" name="questiondesc"  placeholder="תוכן שאלה" required><?= stripslashes($row['question']);?></textarea>
                                        </div>

										
										<div class="row">

                                            <div class="form-group col-md-6">
                                                <label for="area" tab-index="3" >סוג שאלה: </label>
                                                <select name="question_type" id="question_type" class="form-control" onchange="questionType(this)" required>
                                                    <option value="0" <? if ($row['question_type'] == "0") { print 'selected'; } ;?>>4 תשובות</option>
                                                    <option value="1" <? if ($row['question_type'] == "1") { print 'selected'; } ;?>>2 תשובות</option>
                                                    <option value="2" <? if ($row['question_type'] == "2") { print 'selected'; } ;?>>4 תמונות</option>
                                                </select>
                                            </div>

											<div class="form-group col-md-6">
												<label for="showapp">קטגוריה: </label>
												<select name="category" class="form-control" >
												<?
												$i = 0;
												$query5 = "SELECT * FROM `question_categories`  WHERE `deleted` = '0' ORDER BY `title` ASC";
												$result5=mysqli_query($query5) or die('error connecting55'); 
												$num_rows5 = mysqli_num_rows($result5);
												
												while ( $row5 = mysqli_fetch_array($result5) )
												{
												$i++;
												


													if ($row['category_id'] == $row5['index'])
													{
														print '<option value="'.$row5['index'].'" selected>'.stripslashes($row5['title']).'</option>';
													}
													else
													{
														print '<option value="'.$row5['index'].'" >'.stripslashes($row5['title']).'</option>';
													}
												?>
													
												<?
												}
												?>
												</select>											
                                            </div>	

											
										</div>
										
					
										<div class="row" id="one_question_image">
											<div class="form-group col-md-12">
                                            <label for="area" tab-index="3" >תמונה: </label>
                                                <input type="file" tab-index="6" name="file" >
												<?
												if ($row['question_image'])
												{
													print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['question_image']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['question_image']).'" border="0" style="width:100px; height:100px;"></a>';
													print '<div><a href="edit_question.php?id='.$_GET['id'].'&delimage=1">מחיקת תמונה</a></div>';
												}
												?>												
                                            </div>
                                        </div>


                                        <div class="row four_images" id="four_images" style="display:none; ">

                                            <div class="form-group col-md-12">
                                                <label for="area" tab-index="3" >תמונה 1: </label>
                                                <input type="file"  name="four_images_image1" id="image1" data-parsley-trigger="input"	>
                                                <?
                                                if ($row['question_image'])
                                                {
                                                    print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['question_image']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['question_image']).'" border="0" style="width:100px; height:100px;"></a>';
                                                    print '<div><a href="edit_question.php?id='.$_GET['id'].'&delimage=1">מחיקת תמונה</a></div>';
                                                }
                                                ?>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label for="area" tab-index="3" >תמונה 2: </label>
                                                <input type="file"  name="four_images_image2" id="image2" data-parsley-trigger="input"	>
                                                <?
                                                if ($row['question_image2'])
                                                {
                                                    print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['question_image2']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['question_image2']).'" border="0" style="width:100px; height:100px;"></a>';
                                                }
                                                ?>
                                            </div>


                                        </div>

                                        <div class="row four_images" id="four_images" style="display:none; ">

                                            <div class="form-group col-md-12">
                                                <label for="area" tab-index="3" >תמונה 3: </label>
                                                <input type="file"  name="four_images_image3" id="image3" data-parsley-trigger="input"	>
                                                <?
                                                if ($row['question_image3'])
                                                {
                                                    print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['question_image3']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['question_image3']).'" border="0" style="width:100px; height:100px;"></a>';
                                                }
                                                ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="area" tab-index="3" >תמונה 4: </label>
                                                <input type="file"  name="four_images_image4" id="image4" data-parsley-trigger="input"	>
                                                <?
                                                if ($row['question_image4'])
                                                {
                                                    print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['question_image4']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['question_image4']).'" border="0" style="width:100px; height:100px;"></a>';
                                                }
                                                ?>
                                            </div>

                                        </div>




                                        <div class="row">

											<div class="form-group col-md-12">
                                                <label for="suppliername">YouTube Link: </label>
                                                <input type="text" name="youtube"  value="<?= stripslashes($row['question_youtube']);?>" id="youtube" class="form-control" tab-index="1"  >
                                            </div>
                                        </div>

                                        <div id="four_answers">
                                            <div class="row" >
                                                <div class="form-group col-md-12">
                                                    <label for="suppliername">תשובה 1: </label>
                                                    <input type="text" name="answer1" value='<?= stripslashes($row['answer1']);?>'  id="answer1" class="form-control answer1" tab-index="1"  required >
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="suppliername">תשובה 2: </label>
                                                    <input type="text" name="answer2"  value='<?= stripslashes($row['answer2']);?>' id="answer2" class="form-control answer2" tab-index="1"  required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="suppliername">תשובה 3: </label>
                                                    <input type="text" name="answer3" value='<?= stripslashes($row['answer3']);?>'  id="answer3" class="form-control answer3" tab-index="1"  required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="suppliername">תשובה 4: </label>
                                                    <input type="text" name="answer4" value='<?= stripslashes($row['answer4']);?>'  id="answer4" class="form-control answer4" tab-index="1"  required>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="two_answers" style="display:none;">
                                            <div class="row" >
                                                <div class="form-group col-md-12">
                                                    <label for="suppliername">תשובה 1: </label>
                                                    <input type="text" name="two_answers_answer1" value='<?= stripslashes($row['answer1']);?>'  id="two_answers_answer1" class="form-control" tab-index="1"  >
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="suppliername">תשובה 2: </label>
                                                    <input type="text" name="two_answers_answer2" value='<?= stripslashes($row['answer2']);?>'  id="two_answers_answer2" class="form-control" tab-index="1"  >
                                                </div>
                                            </div>
                                        </div>



										
										<div class="row">
										
											<div class="form-group col-md-12">

												<label for="showapp">תשובה נכונה: </label>
                                                <select name="correctanswer" class="form-control" required>
													<option value="1" <? if ($row['correct_answer'] == "1") { print 'selected'; } ;?>>1</option>
												    <option value="2" <? if ($row['correct_answer'] == "2") { print 'selected'; } ;?>>2</option> 
												    <option value="3" <? if ($row['correct_answer'] == "3") { print 'selected'; } ;?>>3</option> 
												    <option value="4" <? if ($row['correct_answer'] == "4") { print 'selected'; } ;?>>4</option> 
												</select>
                                            </div>
										</div>	
									
                                        <div class="form-group">
                                            <label for="message">הסבר תשובה: </label>
                                            <textarea class="form-control" rows="8" name="explaination"  placeholder="הסבר תשובה" ><?= stripslashes($row['explaination']);?></textarea>
                                        </div>	


										<div class="row">
										
											<div class="form-group col-md-12">

												<label for="showapp">האם שאלה ממשרד התחבורה? </label>
                                                <select name="transporationquestion" class="form-control" required>
													<option value="0" <? if ($row['from_transportation'] == "0") { print 'selected'; } ;?>>לא</option>
												    <option value="1" <? if ($row['from_transportation'] == "1") { print 'selected'; } ;?>>כן</option> 
												</select>
                                            </div>
										</div>



										
					
										<div class="row">

											
											<div class="form-group col-md-6">
                                                <label for="area" tab-index="3" >תמונת הסבר: </label>
                                                <input type="file" tab-index="6" name="file2" >
												<?
												if ($row['explain_image'])
												{
													print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['explain_image']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['explain_image']).'" border="0" style="width:100px; height:100px;"></a>';
													print '<div><a href="edit_question.php?id='.$_GET['id'].'&delimage=2">מחיקת תמונה</a></div>';

												}
												?>												
                                            </div>											

											<div class="form-group col-md-6">
                                                <label for="suppliername">YouTube Link: </label>
                                                <input type="text" name="youtube2" value="<?= stripslashes($row['explain_youtube']);?>"  id="youtube2" class="form-control" tab-index="1"  >
                                            </div>											
											
                                        </div>
										
										
										<input type="hidden" name="update" value="1">
                                    </form>

                                </div>
                                <!-- /tile body -->

                                <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top" style="background:#fff !important;">
                                    <!-- SUBMIT BUTTON -->
                                    <button id="form2Submit" class="btn btn-lightred" type="submit">עדכן</button>
                                </div>
                                <!-- /tile footer -->

                            </section>
                            <!-- /tile -->





                        </div>

                            <!-- /right side body -->

                        </div>
                        <!-- /right side -->

                    </div>



                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->




        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="assets/js/vendor/slider/bootstrap-slider.min.js"></script>

        <script src="assets/js/vendor/colorpicker/js/bootstrap-colorpicker.min.js"></script>

        <script src="assets/js/vendor/touchspin/jquery.bootstrap-touchspin.min.js"></script>

        <script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

        <script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

        <script src="assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>

        <script src="assets/js/vendor/summernote/summernote.min.js"></script>
		 <script src="assets/js/vendor/parsley/parsley.min.js"></script>

        <!--/ vendor javascripts -->


        <script src="assets/js/vendor/summernote/summernote.min.js"></script>


        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
                $('#form2Submit').on('click', function(){
                    $('#form2').submit();
                });
				$('#summernote').summernote({
                    height: 200   //set editable area's height
                });
            });


            function onloadCheck() {
                var value = document.getElementById("question_type");
                questionType(value);
            }



            function questionType(sel) {
                var value = sel.value;
                switch (parseInt(value))
                {
                    case 0:
                        $("#four_answers").css("display", "block");
                        $("#one_question_image").css("display", "block");
                        $("#two_answers").css("display", "none");

                        $(".four_images").css("display", "none");
                        $('#answer1').prop('required',true);
                        $('#answer2').prop('required',true);
                        $('#answer3').prop('required',true);
                        $('#answer4').prop('required',true);

//                        $('#image1').prop('required',false);
//                        $('#image2').prop('required',false);
//                        $('#image3').prop('required',false);
//                        $('#image4').prop('required',false);

                        $('#two_answers_answer1').prop('required',false);
                        $('#two_answers_answer2').prop('required',false);


                        break;
                    case 1:
                        //$(".answer1").css("background-color", "red");

                        $("#four_answers").css("display", "none");
                        $("#two_answers").css("display", "block");
                        $("#one_question_image").css("display", "none");
                        $(".four_images").css("display", "none");


                        $('#two_answers_answer1').prop('required',true);
                        $('#two_answers_answer2').prop('required',true);

                        $('#answer1').prop('required',false);
                        $('#answer2').prop('required',false);
                        $('#answer3').prop('required',false);
                        $('#answer4').prop('required',false);

//                        $('#image1').prop('required',false);
//                        $('#image2').prop('required',false);
//                        $('#image3').prop('required',false);
//                        $('#image4').prop('required',false);
                        break;

                    case 2:
                        $("#one_question_image").css("display", "none");
                        $("#four_answers").css("display", "none");
                        $("#two_answers").css("display", "none");
                        $(".four_images").css("display", "block");
                        $('#answer1').prop('required',false);
                        $('#answer2').prop('required',false);
                        $('#answer3').prop('required',false);
                        $('#answer4').prop('required',false);

//                        $('#image1').prop('required',true);
//                        $('#image2').prop('required',true);
//                        $('#image3').prop('required',true);
//                        $('#image4').prop('required',true);

                        $('#two_answers_answer1').prop('required',false);
                        $('#two_answers_answer2').prop('required',false);
                        break;
                }

            }


        </script>
        <!--/ Page Specific Scripts -->






    </body>
</html>

<?
//print '<pre>';
////);
//print '</pre>';
?>