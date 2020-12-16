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


if ($_GET['del'])
{

$updateQuery = "UPDATE `information_articles` 
 SET   
 `deleted` ='1'
 WHERE `index` ='".mysqli_real_escape_string($_GET['del'])."'";
 $update =  mysqli_query($updateQuery) or die(mysqli_error());  
}

$query = "SELECT * FROM `information_articles` WHERE  `catagory_id` = '".$_GET['id']."' AND `deleted` = '0' ORDER BY `index` DESC";
$result=mysqli_query($query) or die('error connecting'); 
$num_rows = mysqli_num_rows($result);
									

$TypeArray = array(
    "0" => "אזרח",
    "1" => "חייל",
	"2" => "כולם"
);
									
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
                            <span><strong>סורוקה</strong></span>
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



                            <!-- left side header-->
                            <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="new_information.php?catindex=<?= $_GET['id'];?>&name=<?= $_GET['name'];?>" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת כתבה חדש</a>

                            </div>
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders" >
                                    <li class="active2" ><a href="information.php" class="pull-right" style="width:100%; text-align:right">חזרה לקטגוריות </a></li>								
                                    <li class="active" ><a href="information_articles.php?id=<?= $_GET['id'];?>&name=<?= $_GET['name'];?>" class="pull-right" style="width:100%; text-align:right">כתבות <span class="pull-left badge bg-lightred"><? print $num_rows;?></span></a></li>

									</ul>
								
                                <h5 class="b-b p-10 text-strong" style="text-align:right; direction:rtl;">קטגוריות: </h5>
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >
									<?
									$query5 = "SELECT * FROM `information_categories`  ORDER BY `title` ASC";

									$result5=mysqli_query($query5) or die('error connecting'); 
									$num_rows5 = mysqli_num_rows($result5);
									
									while ( $row5 = mysqli_fetch_array($result5))
									{
										if ($_GET['id'] == $row5['index'])
										{
										?>
										
											<li><a href="information_articles.php?id=<?= $row5['index'];?>&name=<?= stripslashes($row5['title']);?>" style="text-align:right"><i class="fa fa-fw fa-circle text-red pull-right" style="padding-top:3px;"></i><?= stripslashes($row5['title']);?></a></li>
										<?
										}
										else
										{
										?>	
												<li><a href="information_articles.php?id=<?= $row5['index'];?>&name=<?= stripslashes($row5['title']);?>" style="text-align:right"><i class="fa fa-fw fa-circle text-primary pull-right" style="padding-top:3px;"></i><?= stripslashes($row5['title']);?></a></li>
										
										<?
										}
									
									
									
									}
									?>
									

                                </ul>
								

                            </div>
                            <!-- /left side body -->







                        </div>
                        <!-- /left side -->




										
										



                        <!-- right side -->
                        <div class="tcol">

							<?php
							if ($num_rows == 0)
							{
							?>
							<div class="alert alert-warning alert-dismissable" style="direction:rtl; text-align:right;">
									<strong>לא נמצאו כתבות , <a href="new_information.php?catindex=<?= $_GET['id'];?>&name=<?= $_GET['name'];?>"> לחצ/י כאן</a> כדי להוסיף כתבה.</strong>
							</div>								
							<?php
							}
							?>	
							
						<!--
							<div class="col-md-6" style="text-align:right; margin-top:15px; direction:rtl;">
								<div class="search" id="main-search">
									<input type="text" class="form-control underline-input" placeholder="חיפוש...">
									<button class="btn btn-rounded btn-success btn-sm" type="submit">חיפוש</button>
								</div>
							</div>					
						-->
                            <!-- right side header -->
                            <div class="p-15 bg-white b-b">

                                <div class="btn-group pull-right">
                                    <h3>קטגוריה: <?= stripslashes($_GET['name']);?></h3>
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


                                <!-- mails -->
                                <ul class="list-group no-radius no-border" id="mails-list">

			
									<?
									while ( $row = mysqli_fetch_array($result))
									{
									?>
                                    <li class="list-group-item b-primary" style="direction:rtl; text-align:right;">


                                        <div class="media">
                                            <div class="pull-right">
												<!--
                                                <div class="controls">
                                                    <a href="javascript:;" class="favourite text-orange toggle-class" data-toggle="active"><i class="fa fa-star-o"></i></a>
													
                                                    <label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0 mail-select"><input type="checkbox"><i></i></label>
													
                                                </div>
												-->
												<div class="thumb thumb-sm" style="width:65px;">
													<?
													if ($row['image'])
													{
													?>
                                                    <a href="edit_information.php?id=<? print $row['index'];?>&catindex=<?= $row['catagory_id'];?>&name=<?= $_GET['name'];?>">
														<img class="img-circle" style="height:65px !important; width:65px !important" border="0" src="<? print $configUrl;?>/uploads/<? print stripslashes($row['image']);?>">
													</a>													
													<?
													}
													?>

                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading m-0">
                                                    <a href="edit_information.php?id=<? print $row['index'];?>&catindex=<?= $row['catagory_id'];?>&name=<?= $_GET['name'];?>" class="mr-1"><? print stripslashes($row['title']);?></a>
													<!--
													<span class="label bg-primary">family</span>
													-->
                                                    <span class="pull-left text-sm text-muted" >
                                                      <span class="hidden-xs"><? print date("d/m/y H:i:s", strtotime($row["date"]));?></span> 
													 <div class="hidden-xs" style="margin-top:5px;">
                                                     	 <a href="edit_information.php?id=<? print $row['index'];?>&catindex=<?= $row['catagory_id'];?>&name=<?= $_GET['name'];?>"><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color:#666">ערוך כתבה<i class="glyphicon glyphicon-edit" style="padding-top:5px;  "></i></button>	</a>
														 <!--
														<a href="deals.php?id=<? print $row['index'];?>" ><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color:#0C3;">ניהול דילים<i class="glyphicon glyphicon-gift" style="padding-top:5px; "></i></button>	</a>
														-->
                                                        <button onClick="ConfirmDelete(<? print $row['index'];?>)" class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl">מחיקת כתבה<i class="glyphicon glyphicon-trash" style="padding-top:5px; "></i></button>
                                                        
                                                        
														<!--<a class="myIcon icon-primary icon-ef-2 icon-ef-2a" href="deals.php?id=<? print $row['index'];?>" title="ניהול דילים"><i class="fa fa-list"></i></a>
														<a class="myIcon icon-hotpink icon-ef-9 icon-color" href="#" title="מחיקה" onClick="ConfirmDelete(<? print $row['index'];?>)"><i class="fa fa-trash"></i></a>														<!--
														<a href="suppliers.php?del=<? print $row['index'];?>" class="btn btn-danger btn-rounded btn-ef btn-ef-5 btn-ef-5b mb-10"><i class="fa fa-trash"></i> <span>מחיקה</span></a>
														-->
												
													</div>
                                                    </span>
                                                </div>
												<div>
												סוג: <?=  $TypeArray[$row['is_soldier']]; ?>
												</div>												
                                            </div>
                                        </div>
                                    </li>
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
					window.location = "information_articles.php?id=<?= $_GET['id'];?>&name=<?= $_GET['name'];?>&del="+index;
				}
			}			
        </script>
        <!--/ Page Specific Scripts -->





    </body>
</html>
