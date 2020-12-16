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



if ($_POST['insert'])
{
	$newfile = '';
	$newfile2 = '';
	$savedate = date("mdy-Hms");	
	$subcat = $_POST['subcat'];
	
if ($_FILES['file']['name'])
{

	$upload_file_name = $_FILES['file']['name'];
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


		$sql= "INSERT INTO `information_articles` (`catagory_id`,`is_soldier`,`title`,`desc`,
		`image`,`phone`,`email`,
		`landingpage`,`youtube`)  VALUES (
		'".addslashes($_GET['catindex'])."',
		'".addslashes($_POST['issoilder'])."',
		'".addslashes($_POST['dealtitle'])."',		
		'".addslashes($_POST['dealcontent'])."',
		'".addslashes($newfile)."',
		'".addslashes($_POST['phone'])."',
		'".addslashes($_POST['mail'])."',
		'".addslashes($_POST['landingpage'])."',
		'".addslashes($_POST['youtube'])."')";
		$InsertSql = mysqli_query($sql)  or die(mysqli_error());
		$insertId = mysqli_insert_id();	



		
		
}


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





    <body id="minovate" class="appWrapper">






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
				$menu = 'information';
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
                                    <li class="active" style="text-align:right;"><a href="information_articles.php?id=<?= $_GET['catindex'];?>&name=<?= $_GET['name'];?>">חזרה לכתבות </a></li>

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
						if ($_POST['insert'])
						{
						?>
						<div class="alert alert-success">
							<strong>הוסף בהצלחה</strong>
						</div>
						<?
						}
						?>
                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>הוספת כתבה - <?= $_GET['name'];?></strong> </h1>
                                </div>
                                <!-- /tile header -->

                                <div class="tile-body">


                                    <form name="form2" action="" method="post" role="form" id="form2" enctype="multipart/form-data" data-parsley-validate>

										

					
										<div class="row">

											
											<div class="form-group col-md-12">
                                                <label for="suppliername">כותרת ראשית: </label>
                                                <input type="text" name="dealtitle"  id="dealtitle" class="form-control" tab-index="1" required >
                                            </div>											
										
											
                                        </div>


										<div class="row">
										
											<div class="form-group col-md-12">

												<label for="showapp">בחירת סוג: </label>
                                                <select name="issoilder"  class="form-control" required>
												<option value="0" >אזרח</option>
												<option value="1" >חייל</option>
												<option value="2" >כולם</option>
												</select>
                                            </div>
										</div>


										
										<div class="row">
											<div class="form-group col-md-6">
                                                <label for="regprice">אימייל: </label>
                                                <input type="text" name="mail"  id="mail"  class="form-control" tab-index="1"  >
                                            </div>		
											<div class="form-group col-md-6">
                                                <label for="memprice">טלפון: </label>
                                                <input type="text" name="phone"  id="phone"   class="form-control" tab-index="1"  >
                                            </div>												
                                        </div>										
										
										<div class="row">
											<div class="form-group col-md-6">
                                                <label for="regprice">יוטיוב: </label>
                                                <input type="text" name="youtube"  id="youtube"   class="form-control" tab-index="1"  >
                                            </div>		
											<div class="form-group col-md-6">
                                                <label for="memprice">קישור עמוד נחיתה: </label>
                                                <input type="text" name="landingpage"  id="landingpage"   class="form-control" tab-index="1"  >
                                            </div>												
                                        </div>	





										
										<div class="row">

										
											
											<div class="form-group col-md-12">
                                            <label for="area" tab-index="3" >תמונת רקע: </label>
                                                <input type="file" tab-index="6" name="file" >
                                            </div>		
											
                                        </div>										

										
									

										
                                        <div class="form-group">
                                            <label for="message">טקסט חופשי: </label>
                                            <textarea class="form-control summernote" rows="8" name="dealcontent" id="summernote" placeholder="טקסט חופשי" ></textarea>
                                        </div>
										

										
										<input type="hidden" name="insert" value="1">
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
				$('.summernote').summernote({
                    height: 200   //set editable area's height
                });
            });
			
			function dealType(sel)
			{
				var value = sel.value;  
				if (value ==0)
						$("#showdiv").css("display", "block");
					else
						$("#showdiv").css("display", "none");
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