<?
	if (!isset($_SESSION)) 
	{
		session_start();
	}
	include_once('../php/db.php');
	include_once('config.php');
	$savedate = date("mdy-Hms");	

	mb_internal_encoding("UTF-8");

	if (!$_SESSION['admin'])
	{
		header('Location: index.php');
		exit;
	}
	
	if ($_POST['updatenew'])
	{
		if ($_POST['catindex'] =="0")
		{
		 
			if ($_FILES['file']['name'])
			{
				$upload_file_name = $_FILES['file']['name'];
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
				
			$sql= "INSERT INTO `gas_station_categories` (`title`,`image`)  VALUES ('".addslashes($_POST['cattitle'])."','".addslashes($newfile)."')";
			$InsertSql = mysqli_query($sql);				
				
			}
			else 
			{
			$sql= "INSERT INTO `gas_station_categories` (`title`)  VALUES ('".addslashes($_POST['cattitle'])."')";
			$InsertSql = mysqli_query($sql);				
			}
		}

		
		if ($_POST['catindex'] !="0")
		{
			
			if ($_FILES['file']['name'])
			{
				$upload_file_name = $_FILES['file']['name'];
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
				
				$updateQuery = "UPDATE `gas_station_categories`
				SET  
				`title` ='".addslashes($_POST['cattitle'])."',
				`image` ='".addslashes($newfile)."'
				WHERE `index` ='".mysqli_real_escape_string($_POST['catindex'])."'";
				$update =  mysqli_query($updateQuery) or die(mysqli_error()); 			
				
			}
			else 
			{
				$updateQuery = "UPDATE `gas_station_categories` 
				SET 
				`title` ='".addslashes($_POST['cattitle'])."'
				WHERE `index` ='".mysqli_real_escape_string($_POST['catindex'])."'";
				$update =  mysqli_query($updateQuery) or die(mysqli_error());  				
			}
			
			
		
		}		
	}

	
	if ($_GET['del'])
	{
		$updateQuery = "DELETE FROM  `gas_station_categories`  WHERE `index` ='".mysqli_real_escape_string($_GET['del'])."'";
		$update =  mysqli_query($updateQuery) or die(mysqli_error());  
	}




	
	
	if ($_POST['search'])
	{
		$query = "SELECT * FROM `gas_station_categories` WHERE   `title` LIKE '%".$_POST['search']."%' ORDER BY `title` ASC";
	}
	else
	{
		$query = "SELECT * FROM `gas_station_categories`  ORDER BY `title` ASC ";
	}
	
	$result=mysqli_query($query) or die('error connecting'); 
	$num_rows = mysqli_num_rows($result);
	
	

	
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



                            <!-- left side header-->
                            <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="#" onClick="addCatagory(0,'','הוספת מאפיין תחנת דלק חדשה')" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת מאפיין תחנת דלק חדש</a>

                            </div>
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active2" style="text-align:right;"><a href="gas_station_catagories.php"> מאפיינים תחנות דלק <span class="pull-right badge bg-lightred"><? print $num_rows;?></span></a></li>

                                </ul>
								
								<div style="margin-top:4px;"></div>

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="gas_companies.php"> חברות דלק </a></li>

                                </ul>

								<div style="margin-top:4px;"></div>

								
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="gas_stations.php"> תחנות דלק </a></li>

                                </ul>


                            </div>
                            <!-- /left side body -->







                        </div>
                        <!-- /left side -->
            
            	<!-- right side -->
                <div class="tcol">
				<?php if ($num_rows == 0) {?>
                    <div class="alert alert-warning alert-dismissable" style="direction:rtl; text-align:right;">
                            <strong>לא נמצאו מאפיינים תחנות דלק , <a href="#" onClick="addCatagory(0,'','הוספת מאפיין תחנת דלק חדשה')" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9"> לחצ/י כאן</a> כדי להוסיף מאפיין תחנת דלק.</strong>
                    </div>								
				<?php } ?>	
								
                <!-- right side header -->
                <div class="p-15 bg-white b-b">

                    <div class="btn-group pull-right">
                        
                    </div>
                   
                    <div class="btn-toolbar">
                    	<form action="" method="post">
                            <div class="input-group mb-10">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">! חפש מאפיין תחנת דלק</button>
                                </span>
                                <input type="text" name="search" class="form-control" style="direction:rtl;">
                            </div>
                        </form>
                    </div>
					
                </div>
						
                          
              <!-- mails -->
              <ul class="list-group no-radius no-border" id="mails-list">
                  <? while ( $row = mysqli_fetch_array($result)){ ?>
                  
                  
                  <li class="list-group-item b-primary" style="direction:rtl; text-align:right;">


                      <div class="media">
                                            <div class="pull-right">

											
												<div class="thumb thumb-sm" style="width:65px;" onClick='editCatagory("<? print $row['index'];?>","עריכת מאפיין תחנת דלק","<? print stripslashes($row['employee']);?>","<? print stripslashes($row['Derug']);?>");'  data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9">
                                                    <img class="img-circle" style="height:65px !important; width:65px !important" border="0" src="<? print $configUrl;?>/<? print stripslashes($row['image']);?>">
                                                </div>
                                            </div>
											
											
             
                                            <div class="media-body">
                                                <div class="media-heading m-0">
                                                    <a href="#" onClick='editCatagory("<? print $row['index'];?>","עריכת מאפיין תחנת דלק","<? print stripslashes($row['employee']);?>","<? print stripslashes($row['Derug']);?>");'   data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9" class="mr-1"><? print stripslashes($row['title']);?></a>
													<!--
													<span class="label bg-primary">family</span>
													-->
                                                    <span class="pull-left text-sm text-muted" >
                                                    <!--  <span class="hidden-xs"><? print date("d/m/y H:i:s", strtotime($row["date"]));?></span> -->
													 <div class="hidden-xs" style="margin-top:5px;">

													 
                                                        <a href="#" onClick='editCatagory("<? print $row['index'];?>","עריכת מאפיין תחנת דלק","<? print stripslashes($row['employee']);?>","<? print stripslashes($row['Derug']);?>");'  data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9"><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color:#666">ערוך מאפיין תחנת דלק<i class="glyphicon glyphicon-edit" style="padding-top:5px;  "></i></button>	</a>
                                                        <button onClick="ConfirmDelete(<? print $row['index'];?>)" class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl">מחיקת מאפיין תחנת דלק<i class="glyphicon glyphicon-trash" style="padding-top:5px; "></i></button>
													</div>
													
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
									
											<input type="hidden" id="<?= $row['index'];?>_dbtitle" value='<?= stripslashes($row['title']);?>'>
																				
									<?
									}
									?>

                                  


                                </ul>
                                <!-- / mails -->

                            <!-- /right side body -->

                        </div>
                        <!-- /right side -->

                    </div>



                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->



        <!-- Splash Modal -->
        <form method="post" action="" enctype="multipart/form-data">
        <div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font" id="modaltitle"></h3>
                    </div>
                    <div class="modal-body">
                    
                    <!-- tile -->
                            <section class="tile">

                                <!-- tile body -->
                                <div class="tile-body">

									<div class="form-group" style="direction:rtl;">
										<label for="exampleInputEmail1">מאפיין תחנת דלק:</label>
										<input type="text" class="form-control" value='' name="cattitle" id="cattitle" placeholder="שם מאפיין תחנת דלק" required>
									</div>    

									
									<div class="form-group" style="direction:rtl;">
										<label for="exampleInputEmail1">תמונה:</label>
										<input type="file" name="file" class="form-control" >
									</div>  
								    
                                </div>
                                <!-- /tile body -->

                            </section>                          
                                                    
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default btn-border" data-dismiss="modal">ביטול</button>
                        <button class="btn btn-default btn-border" type="submit">עדכן</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="0" name="catindex" id="catindex">
        <input type="hidden" value="1" name="updatenew" id="updatenew">
		
        </form>




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
        <!--/ vendor javascripts -->




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

                $('#select-all').change(function() {
                    if ($(this).is(":checked")) {
                        $('#mails-list .mail-select input').prop('checked', true);
                    } else {
                        $('#mails-list .mail-select input').prop('checked', false);
                    }
                });
            });
			
			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "gas_station_catagories.php?del="+index;
				}
			}	
			function editCatagory(index,title,employee,derug)
			{
				var dbtitle = $('#'+index+'_dbtitle').val();
				//dbtitle = dbtitle.replace(/'/g,"&apos;")
				//var test = dbtitle.replace(/\'/g,'&apos;');
				//alert (dbtitle);
				//alert (dbtitle)
				$( "#modaltitle" ).html(title);
				$("#catindex").val(index);
				$("#cattitle").val(dbtitle);	
				$("#catemployee").val(employee);
				$("#catderug").val(derug);	
			}
			function addCatagory(index,catagory,title,employee,derug)
			{
				$( "#modaltitle" ).html(title);
				$("#catindex").val(0);
				$("#cattitle").val('');	
				$("#catemployee").val(0);
				$("#catderug").val(0);
			}
			
        </script>
        <!--/ Page Specific Scripts -->





    </body>
</html>
<?
//print_r($_POST);
?>