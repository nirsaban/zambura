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
	$savedate = date("mdy-Hms");	

	

$query2 = "SELECT * FROM `gas_stations` WHERE `index` = '".$_GET['id']."'";
$result2 = mysqli_query($query2) or die('error connecting'); 												
$row2 = mysqli_fetch_array($result2);

if ($_FILES['file']['name'])
{

	$upload_file_name = $_FILES['file']['name'];
	$savedate = date("mdy-Hms");	
	$fileName = "../php/uploads/".$savedate."_".$upload_file_name;
	$saveDir = "uploads/".$savedate."_".$upload_file_name;
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

	if ($_POST['lat'])
	{
		$lat = $_POST['lat'];
		$lan = $_POST['lan'];
	}
	else
	{
		$lat = stripslashes($row2['location_lat']);
		$lan = stripslashes($row2['location_lng']);
	}



	$updateQuery = "UPDATE `gas_stations` 
	 SET   
	 `company_id` ='".addslashes($_POST['gascompany'])."',	 
	 `title` ='".addslashes($_POST['formtitle'])."',
	 `address` ='".addslashes($_POST['address'])."',
	 `location_lat` ='".addslashes($lat)."',
	 `location_lng` ='".addslashes($lan)."',
	 `image` ='".addslashes($newfile)."'
	 WHERE `index` ='".mysqli_real_escape_string($_GET['id'])."'";
	 $update =  mysqli_query($updateQuery) or die(mysqli_error()); 

			$subcat = $_POST['subcat'];


			$sql = "DELETE FROM `gas_station_properties` WHERE `station_id` = '".$_GET['id']."' ";
			$DelSql = mysqli_query($sql);
			
			foreach ($subcat as $catindex)
			{

				$sql= "INSERT INTO `gas_station_properties` (`station_id`,`cat_id`)  VALUES ('".addslashes($_GET['id'])."','".addslashes($catindex)."')";
				$InsertSql = mysqli_query($sql);		
			}
			
			
	header('Location: gas_stations.php');				

				
	
}


$query = "SELECT * FROM `gas_stations` WHERE `index` = '".$_GET['id']."'";
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
				$menu = 'gascompanies';
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
                                    <li class="active" style="text-align:right;"><a href="gas_stations.php">חזרה לתחנות דלק </a></li>
                                </ul>


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
                                    <h1 class="custom-font"><strong>עריכת תחנת דלק</strong> </h1>
                                </div>
                                <!-- /tile header -->

                                <div class="tile-body">


                                    <form name="form2" action="" method="post" role="form" id="form2" enctype="multipart/form-data" data-parsley-validate>



				
										<div class="row">

											<div class="form-group col-md-6">
                                            <label for="address">חברת דלק: </label>
											<select name="gascompany"   class="form-control" required>
											<?
											$query20 = "SELECT * FROM `gas_companies`  ORDER BY `title` ASC";
											$result20=mysqli_query($query20) or die('error connecting55'); 
											
											while ( $row20 = mysqli_fetch_array($result20) )
											{
												if ($row['company_id'] == $row20['index'])
													print '<option value="'.$row20['index'].'" selected>'.stripslashes($row20['title']).'</option>';
												else
													print '<option value="'.$row20['index'].'" >'.stripslashes($row20['title']).'</option>';
													
											}
											?>	
											</select>
                                            </div>

											
											<div class="form-group col-md-6">
                                            <label for="address">שם הסניף: </label>
													<input  type="text" tab-index="3"  name="formtitle"  value="<?= stripslashes($row['title']);?>" class="form-control" required>
                                            </div>
											
											
										</div>											
										
										
										<div class="row">
										
											<div class="form-group col-md-12">
                                            <label for="address">כתובת מלאה: </label>
													<input id="searchTextField" type="text" tab-index="3"  name="address"  value="<?= stripslashes($row['address']);?>"   class="form-control" required >
                                            </div>
											
											
										</div>	

										<div class="row">
											<div class="form-group col-md-12">
                                                <label for="expprice">מאפייני הסניף: </label><br>
                                                <select multiple="" tabindex="3" name="subcat[]" id="subcatCatagory" class="chosen-select" style="width: 97%;" >
												<?
													$selectedColors = array();
													$query50 = "SELECT * FROM `gas_station_properties` WHERE  `station_id` = '".$_GET['id']."'  ORDER BY `index` DESC ";
													$result50=mysqli_query($query50) or die('error connecting2'); 
													$num_rows2 = mysqli_num_rows($result50);

													while ( $row50 = mysqli_fetch_array($result50))
													{	
														$selectedColors[] = $row50;
													}
														
													$query3 = "SELECT * FROM `gas_station_categories`  ORDER BY `title` ASC";
													$result3=mysqli_query($query3) or die('error connecting'); 
													$num_rows20 = mysqli_num_rows($result3);
													while ( $row3 = mysqli_fetch_array($result3))
													{
														$isSelected = 0;
														for ($i = 0; $i < count($selectedColors); $i++)
														{
															if ($selectedColors[$i]['cat_id'] == $row3['index'])
															{
																$isSelected = 1;
															}
															

														}
									
		
															if ($isSelected == 1)
															{
																print '<option value="'.stripslashes($row3['index']).'" selected>'.stripslashes($row3['title']).'</option>';
															
															}
															else
															{
																print '<option value="'.stripslashes($row3['index']).'" >'.stripslashes($row3['title']).'</option>';

															}
	
														}
													
												
												?>	
											
												</select>	                                            
											</div>										
                                        </div>


										<div class="row">

											<div class="form-group col-md-12">
                                            <label for="area" tab-index="3" >תמונה : </label>
                                                <input type="file" tab-index="6" name="file" >
												<?
												if ($row['image'])
												{
													print '<a href="'.$configUrl.'/'.stripslashes($row['image']).'" target="_blank"><img src="'.$configUrl.'/'.stripslashes($row['image']).'" border="0" style="width:100px; height:100px;"></a>';
												}
												?>													
                                            </div>	
	
											
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
				$('#summernote').summernote({
                    height: 200   //set editable area's height
                });
            });

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



        </script>
        <!--/ Page Specific Scripts -->






    </body>
</html>

<?
//print '<pre>';
////);
//print '</pre>';
?>