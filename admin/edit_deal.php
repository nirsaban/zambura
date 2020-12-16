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

if ($_POST['update'])
{
	$newfile = '';
	$newfile2 = '';
	$newfile3 = '';
	$newfile4 = '';
	$savedate = date("mdy-Hms");	

	
	
$query2 = "SELECT * FROM `deals` WHERE `index` = '".$_GET['id']."'";
$result2 = mysqli_query($query2) or die('error connecting'); 												
$row2 = mysqli_fetch_array($result2);

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
	
	$newfile = stripslashes($row2['image']);
}

//image 2
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
	$newfile2 = stripslashes($row2['image2']);
	
}

//image 3
if ($_FILES['file3']['name'])
{

	$upload_file_name2 = $_FILES['file3']['name'];
	$fileName2 = "../php/uploads/".$savedate."_".$upload_file_name2;
	$saveDir2 = "".$savedate."_".$upload_file_name2;
	$tmp_name2 = $_FILES["file3"]["tmp_name"];

	if(move_uploaded_file($tmp_name2,$fileName2)) 
	{
		$newfile3 = $saveDir2;
	}
	else
	{
		$newfile3 = '';
	}
	
}
else 
{
	$newfile3 = stripslashes($row2['image3']);
	
}



//image 4
if ($_FILES['file4']['name'])
{

	$upload_file_name2 = $_FILES['file4']['name'];
	$fileName2 = "../php/uploads/".$savedate."_".$upload_file_name2;
	$saveDir2 = "".$savedate."_".$upload_file_name2;
	$tmp_name2 = $_FILES["file4"]["tmp_name"];

	if(move_uploaded_file($tmp_name2,$fileName2)) 
	{
		$newfile4 = $saveDir2;
	}
	else
	{
		$newfile4 = '';
	}
	
}
else 
{
	$newfile4 = stripslashes($row2['image4']);
	
}

	$updateQuery = "UPDATE `deals` 
	 SET   
	 `title` ='".addslashes($_POST['dealtitle'])."',
	 `showiframe` ='".addslashes($_POST['showiframe'])."',
	 `cat_id` ='".addslashes($_POST['dealcat'])."',
	 `supplier_id` ='".addslashes($_POST['dealsupplier'])."',	 
	 `regular_price` ='".addslashes($_POST['regprice'])."',
	 `member_price` ='".addslashes($_POST['memprice'])."',
	 `exposure_price` ='".addslashes($_POST['expprice'])."',
	 `dealgivenby` ='".addslashes($_POST['dealtype'])."',
	 `linktitle` ='".addslashes($_POST['linktitle'])."',
	 `codelink` ='".addslashes($_POST['codelink'])."',
	 `image` ='".addslashes($newfile)."',
	 `image2` ='".addslashes($newfile2)."',
	 `image3` ='".addslashes($newfile3)."',
	 `image4` ='".addslashes($newfile4)."',
	 `youtube` ='".addslashes($_POST['youtube'])."',
	 `desc` ='".addslashes($_POST['dealcontent'])."',
	 `terms` ='".addslashes($_POST['termsdesc'])."',
	 `benfit_type` ='".addslashes($_POST['benfittype'])."',
	 `gender` ='".addslashes($_POST['gender'])."',
	 `start_sell` ='".addslashes($_POST['sellstart'])."',
	 `end_sell` ='".addslashes($_POST['sellend'])."',
	 `limit_exposure` ='".addslashes($_POST['limitexp'])."'
	 
	 WHERE `index` ='".mysqli_real_escape_string($_GET['id'])."'";
	 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 


		$subcat = $_POST['subcat'];
		//if (is_array($subcat))
		//{

			$sql = "DELETE FROM `deal_brances` WHERE `deal_id` = '".$_GET['id']."' ";
			$DelSql = mysqli_query($sql);
			
			foreach ($subcat as $catindex)
			{

					$sql= "INSERT INTO `deal_brances` (`deal_id`,`branch_id`)  VALUES ('".addslashes($_GET['id'])."','".addslashes($catindex)."')";
					$InsertSql = mysqli_query($sql);		
			}					
		//	}				

				
	
}


$query = "SELECT * FROM `deals` WHERE `index` = '".$_GET['id']."'";
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

	<style>
	.modal-backdrop, .modal-backdrop.in{
	  display: none !important;
	}	
	</style>


    </head>





    <body id="minovate" class="appWrapper" >






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
                        <a class="brand" href="index.php">
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
				if ($_GET['dealsbycat'])
					$menu = 'deals';
				else
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
								<?
								if ($_GET['dealsbycat'])
									$retrurnUrl = "dealsbycat.php?id=".$_GET['catid']."";
								else
									$retrurnUrl = "deals.php";
								?>
							
								
                                    <li class="active" style="text-align:right;"><a href="<?= $retrurnUrl;?>">חזרה לדילים </a></li>


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
                                    <h1 class="custom-font"><strong>עריכת דיל</strong> </h1>
                                </div>
                                <!-- /tile header -->

                                <div class="tile-body">


                                    <form name="form2" action="" method="post" role="form" id="form2" enctype="multipart/form-data" data-parsley-validate>


									<div class="row">
                                        <div class="col-md-6">
									
									<div class="row" >
									
											<div class="form-group col-md-12">

												<label for="showapp">סוג ההטבה: </label>
                                                <select name="benfittype" onchange="dealType(this)" class="form-control" required>
												    <option value="0" <? if ($row['benfit_type'] == 0) { print 'selected'; } ?>>קטלוג</option> 
												    <option value="1" <? if ($row['benfit_type'] == 1) { print 'selected'; } ?>>יומי</option> 
												</select>
                                            </div>
									</div>
								<?
								if ($row['benfit_type'] == 0)
									$displayDiv = "block";
								else
									$displayDiv = "none";
								?>
								
								<div id="showdiv" style="display:<?= $displayDiv;?>;">
										<div class="row" >
										
											<div class="form-group col-md-12">

												<label for="showapp">מין: </label>
                                                <select name="gender" class="form-control" required>
													<option value="0" <? if ($row['gender'] == 0) { print 'selected'; } ?>>זכר</option>
													<option value="1" <? if ($row['gender'] == 1) { print 'selected'; } ?>>נקבה</option>
													<option value="2" <? if ($row['gender'] == 2) { print 'selected'; } ?>>שניהם</option>
												</select>
                                            </div>
										</div>											
										
										<div class="row">

											<div class="form-group col-md-12">
                                                <label for="suppliername">תאריך התחלת מכירה: </label>
														 <div class='input-group datepicker w-360' data-format="DD/MM/YYYY" style="direction:ltr;">
															<input type='text' name="sellstart" pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?= stripslashes($row['start_sell']);?>" class="form-control" required />
															<span class="input-group-addon">
																<span class="fa fa-calendar"></span>
															</span>
														</div>
                                            </div>

										</div>
										
										<div class="row">
										
										
											<div class="form-group col-md-12">
                                                <label for="suppliername">תאריך סיום מכירה: </label>
														 <div class='input-group datepicker w-360' data-format="DD/MM/YYYY" style="direction:ltr;">
															<input type='text' name="sellend" pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?= stripslashes($row['end_sell']);?>" class="form-control" required />
															<span class="input-group-addon">
																<span class="fa fa-calendar"></span>
															</span>
														</div>
                                            </div>

										</div>	
                                        
										
										
										<!--
										<div class="row">
											<div class="form-group col-md-12">
                                                <label for="expprice">הגבלת חשיפה: </label>
                                                <input type="tel" name="limitexp"  id="limitexp" value="<?= stripslashes($row['limit_exposure']);?>" data-parsley-type="number" data-parsley-error-message="יש להזין מספר בלבד"   class="form-control" tab-index="1" required >
                                            </div>										
                                        </div>
										-->
								</div>	

										<div class="row">
											<div class="form-group col-md-12">
                                                <label for="expprice">כתובת: </label><br>
                                                <select multiple="" tabindex="3" name="subcat[]" id="subcatCatagory" class="chosen-select" style="width: 90%;" >
												
												<?
													$selectedColors = array();
													$query50 = "SELECT * FROM `deal_brances` WHERE  `deal_id` = '".$_GET['id']."'  ORDER BY `index` DESC ";
													$result50=mysqli_query($query50) or die('error connecting2'); 
													$num_rows2 = mysqli_num_rows($result50);
													//print $num_rows2;
													//$row20 = mysqli_fetch_array($result20);	
													while ( $row50 = mysqli_fetch_array($result50))
													{	
														$selectedColors[] = $row50;
													}
														
													//WHERE `supplier_id` = '".$row['supplier_id']."'
													$query3 = "SELECT * FROM `supplier_brances`  ORDER BY `name` ASC";
													$result3=mysqli_query($query3) or die('error connecting'); 
													$num_rows20 = mysqli_num_rows($result3);
													while ( $row3 = mysqli_fetch_array($result3))
													{
														$isSelected = 0;
														for ($i = 0; $i < count($selectedColors); $i++)
														{
															if ($selectedColors[$i]['branch_id'] == $row3['index'])
															{
																$isSelected = 1;
															}
															

														}
									
		
															if ($isSelected == 1)
															{
																print '<option value="'.stripslashes($row3['index']).'" selected>'.stripslashes($row3['name']).'</option>';
															
															}
															else
															{
																if($row3['supplier_id'] == $row['supplier_id'])
																{
																	print '<option value="'.stripslashes($row3['index']).'" >'.stripslashes($row3['name']).'</option>';
																	
																}
																
															}
	
														}
													
												
												?>	


												
												</select>	                                            
											</div>										
                                        </div>

										
										</div>
                                        <div class="col-md-6">
										  
										  
											<div class="form-group col-md-12">
                                                <label for="suppliername">שם/כותרת הדיל: </label>
                                                <input type="text" name="dealtitle"  id="dealtitle" value="<?= stripslashes($row['title']);?>" class="form-control" tab-index="1" required >
                                            </div>											  
										  
											<div class="form-group col-md-12">

												<label for="showapp">הצג כ IFRAME? </label>
                                                <select name="showiframe" onchange="isgroupon(this)" class="form-control" required>
												<option value="0" <? if ($row['showiframe'] == 0) { print 'selected'; } ?>>לא</option>
												<option value="1" <? if ($row['showiframe'] == 1) { print 'selected'; } ?>>כן</option>
												</select>
                                            </div>	


											<div class="form-group col-md-12">

												<label for="showapp">קטגוריה: </label>
                                                <select name="dealcat" class="form-control" required>
												<?
												$i = 0;
												$query5 = "SELECT * FROM `deals_categories`  WHERE `deleted` = '0' ORDER BY `title` ASC";
												$result5=mysqli_query($query5) or die('error connecting55'); 
												$num_rows5 = mysqli_num_rows($result5);
												
												while ( $row5 = mysqli_fetch_array($result5) )
												{
												$i++;
												


													if ($row['cat_id'] == $row5['index'])
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

											<div class="form-group col-md-12">

												<label for="showapp">ספק: </label>
                                                <select name="dealsupplier" id="dealsupplier" onchange="showSubCat()" class="form-control" required>
												<?
												$i = 0;
												$query50 = "SELECT * FROM `suppliers`  WHERE `deleted` = '0' ORDER BY `name` ASC";
												$result50=mysqli_query($query50) or die('error connecting55'); 
												//$num_rows50 = mysqli_num_rows($result5);
												
												while ( $row50 = mysqli_fetch_array($result50) )
												{
												$i++;
												


													if ($row['supplier_id'] == $row50['index'])
													{
														print '<option value="'.$row50['index'].'" selected>'.stripslashes($row50['name']).'</option>';
													}
													else
													{
														print '<option value="'.$row50['index'].'" >'.stripslashes($row50['name']).'</option>';
													}
												?>
													
												<?
												}
												?>
												</select>
                                            </div>											

											<!--
											<div class="form-group col-md-12">
                                            <label for="address">כתובת: </label>
												<input id="searchTextField" type="text" tab-index="3"  value="<? print stripslashes($row['address']);?>" name="address"   class="form-control" >
                                            </div>
											-->
											
											<div class="form-group col-md-12">
                                                <label for="regprice">מחיר רגיל: </label>
                                                <input type="tel" name="regprice"  id="regprice" value="<?= stripslashes($row['regular_price']);?>" data-parsley-type="number" data-parsley-error-message="יש להזין מספר בלבד"  class="form-control" tab-index="1" required >
                                            </div>	

											<div class="form-group col-md-12">
                                                <label for="memprice">מחיר חברים: </label>
                                                <input type="tel" name="memprice"  id="memprice" value="<?= stripslashes($row['member_price']);?>" data-parsley-type="number" data-parsley-error-message="יש להזין מספר בלבד"  class="form-control" tab-index="1" required >
                                            </div>	
											
											<!--
											<div class="form-group col-md-12">
                                                <label for="expprice">מחיר חשיפה: </label>
                                                <input type="tel" name="expprice"  id="expprice" value="<?= stripslashes($row['exposure_price']);?>" data-parsley-type="number" data-parsley-error-message="יש להזין מספר בלבד"   class="form-control" tab-index="1" required >
                                            </div>	
											-->

											<div class="form-group col-md-12">

												<label for="showapp">הטבה ניתנת ע"י: </label>
                                                <select name="dealtype" class="form-control" required>
													<option value="0" <? if ($row['dealgivenby'] == 0) { print 'selected'; } ?>>קוד</option>
												    <option value="1" <? if ($row['dealgivenby'] == 1) { print 'selected'; } ?> >לינק</option> 
												</select>
                                            </div>

											
											<div class="form-group col-md-12">
                                                <label for="suppliername">כותרת הלינק: </label>
                                                <input type="text" name="linktitle"  id="linktitle" value="<?= stripslashes($row['linktitle']);?>" class="form-control" tab-index="1"  >
                                            </div>

											
											<div class="form-group col-md-12">
                                                <label for="suppliername">קוד/לינק: </label>
                                                <input type="text" name="codelink"  id="codelink" value="<?= stripslashes($row['codelink']);?>" class="form-control" tab-index="1" required >
                                            </div>



											<div class="form-group col-md-12">
                                                <label for="suppliername">לינק יוטיוב: </label>
                                                <input type="text" name="youtube"  id="youtube" value="<?= stripslashes($row['youtube']);?>" class="form-control" tab-index="1"  >
                                            </div>	

											
										</div>
                                    </div>

										<div class="row">



											<div class="form-group col-md-3">
                                            <label for="area" tab-index="3" >תמונה 4: </label>
                                                <input type="file" tab-index="6" name="file4" >
												<?
												if ($row['image4'])
												{
													print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['image4']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['image4']).'" border="0" style="width:100px; height:100px;"></a>';
												}
												?>													
                                            </div>	
											
											


											<div class="form-group col-md-3">
                                            <label for="area" tab-index="3" >תמונה 3: </label>
                                                <input type="file" tab-index="6" name="file3" >
												<?
												if ($row['image3'])
												{
													print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['image3']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['image3']).'" border="0" style="width:100px; height:100px;"></a>';
												}
												?>													
                                            </div>											

											<div class="form-group col-md-3">
                                            <label for="area" tab-index="3" >תמונה 2: </label>
                                                <input type="file" tab-index="6" name="file2" >
												<?
												if ($row['image2'])
												{
													print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['image2']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['image2']).'" border="0" style="width:100px; height:100px;"></a>';
												}
												?>													
                                            </div>											
											
											<div class="form-group col-md-3">
                                            <label for="area" tab-index="3" >תמונה 1: </label>
                                                <input type="file" tab-index="6" name="file" >
												<?
												if ($row['image'])
												{
													print '<a href="'.$configUrl.'/uploads/'.stripslashes($row['image']).'" target="_blank"><img src="'.$configUrl.'/uploads/'.stripslashes($row['image']).'" border="0" style="width:100px; height:100px;"></a>';
												}
												?>													
                                            </div>		
											
                                        </div>								

										
                                        <div class="form-group">
                                            <label for="message">תוכן הדיל: </label>
                                            <textarea class="form-control summernote" rows="8" name="dealcontent" id="summernote" placeholder="תוכן הדיל" ><?= stripslashes($row['desc']);?></textarea>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label for="message">תנאים: </label>
                                            <textarea class="form-control summernote" rows="8" name="termsdesc" id="summernote" placeholder="תנאים" ><?= stripslashes($row['terms']);?></textarea>
                                        </div>
										
										
										
										
										<div class="row">
										

										</div>	
				
			
										
										<input type="hidden" name="update" value="1">
										<input type="hidden" name="lat" id="lat" value="">
										<input type="hidden" name="lan" id="lan" value="">										
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
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4uXPidpv7gDsUIXwS30CMQNs5M-t6DOs&libraries=places"></script>
		
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
                $('#form2Submit').on('click', function(){
                    $('#form2').submit();
                });
				

				$('.summernote').summernote({
                    height: 200,  //set editable area's height
					dialogsInBody: true,
                });
            });

		/*
		function initialize() {

			var input = document.getElementById('searchTextField');
			var autocomplete = new google.maps.places.Autocomplete(input);
			
         google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
             var place = autocomplete.getPlace();

             console.log(place.geometry.location.lat());
             console.log(place.geometry.location.lng());
			 
             $('#lat').val(place.geometry.location.lat());
             $('#lan').val(place.geometry.location.lng());
			 				 
         });

			}
		

			google.maps.event.addDomListener(window, 'load', initialize);
			*/
			
			function dealType(sel)
			{
				var value = sel.value;  
				if (value ==0)
						$("#showdiv").css("display", "block");
					else
						$("#showdiv").css("display", "none");
			}		

			function isgroupon(sel)
			{
				/*
				var value = sel.value;  
				if (value ==0)
				{
					$('#form2').parsley();
					$("#showGroupon").css("display", "block");
					$("#showgrouponid").css("display", "none");
				}
				else
				{
					$('#form2').parsley().destroy();
					$("#showGroupon").css("display", "none");
					$("#showgrouponid").css("display", "block");
				}
				*/

			}

			
			function showSubCat()
			{
				//var e = document.getElementById("catagory");
				//var value = e.options[e.selectedIndex].value;

				var select = $( "#dealsupplier" ).val();
				//alert (select)
				var $subcat = $('#subcatCatagory');
					$.ajax({
					type: 'POST',
					url: 'get_brances.php',
					data: {
						'id': select
					},
					dataType: 'json',
					success: function (data) {
						//console.log ($subcat)
						$subcat.empty();
						for (var i = 0; i < data.length; i++) 
						{							
							$subcat.append('<option value=' + data[i].index + '>' + data[i].name + '</option>');
							
						}
							$subcat.trigger("chosen:updated");	
					}
					
				});
			
			
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