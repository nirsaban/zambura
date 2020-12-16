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



	$query = "SELECT * FROM `banner_types` ORDER BY `index` ASC";
	$result=mysqli_query($query) or die('error connecting'); 
	$num_rows = mysqli_num_rows($result);	
	
	
$BannerType = array(
    "0" => "מערכת ניהול",
    "1" => "POSITIVE MOBILE"
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
                            <span><strong>ZAMBURA</strong></span>
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
				$menu = 'banners';
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
                            <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="#" onClick="addCatagory(0,'','הוספת קטגוריה חדשה')" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת קטגוריה חדשה</a>

                            </div>
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">
								
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="banners.php"> ניהול באנרים <span class="pull-right badge bg-lightred"><? print $num_rows;?></span></a></li>
                                </ul>
								
								
								<!--
                                <h5 class="b-b p-10 text-strong">מיון</h5>
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >
                                    <li><a href="suppliers.php?area=1"><i class="fa fa-fw fa-circle text-primary"></i>אזור חיפה והצפון</a></li>
                                    <li><a href="suppliers.php?area=2"><i class="fa fa-fw fa-circle text-default"></i>באר שבע והדרום</a></li>
                                    <li><a href="suppliers.php?area=3"><i class="fa fa-fw fa-circle text-orange"></i>שפלה</a></li>
                                    <li><a href="suppliers.php?area=4"><i class="fa fa-fw fa-circle text-blue"></i>שרון</a></li>
									<li><a href="suppliers.php?area=5"><i class="fa fa-fw fa-circle text-red"></i>תל אביב וגוש דן</a></li>
									<li><a href="suppliers.php?area=6"><i class="fa fa-fw fa-circle text-white"></i>ירושלים והסביבה</a></li>
									<li><a href="suppliers.php"><i class="fa fa-fw fa-circle text-greensea"></i>הכל</a></li>
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
                        
                    </div>
                   
                    <div class="btn-toolbar">
                    	<form action="banners.php" method="post">
                            <div class="input-group mb-10">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">! חפש קטגוריה</button>
                                </span>
                                <input type="text" name="search" class="form-control" style="direction:rtl;">
                            </div>
                        </form>
                    </div>
					
                </div>
						
                          
              <!-- mails -->
              <ul class="list-group no-radius no-border" id="mails-list">
                  <? 

				  while ( $row = mysqli_fetch_array($result)){

				  $totalCivil = 0;
				  $totalSoilder = 0;

				  
					  
					$deals_query = "SELECT * FROM `gallery` WHERE `gallery_id`= '".$row['index']."' ";
					$deals_result=mysqli_query($deals_query) or die('error connecting'); 
					//$num_deals = mysqli_num_rows($deals_result);					  
					//$row_deals = mysqli_fetch_array($deals_result);
					
					 while ( $row_deals = mysqli_fetch_array($deals_result))
					 {
						 
						if ($row_deals['type'] == 0)
							$totalCivil++;

						if ($row_deals['type'] == 1)
							$totalSoilder++;						 
					}
					
					
				   ?>
                  
                  
                  <li class="list-group-item b-primary" style="direction:rtl; text-align:right;">


                      <div class="media">
					  
					  
											<!--
                                            <div class="pull-right">					
												<div class="thumb thumb-sm" style="width:65px;" onClick='editCatagory("<? print $row['index'];?>","עריכת קטגוריה","<? print stripslashes($row['employee']);?>","<? print stripslashes($row['Derug']);?>");'  data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9">
                                                    <img class="img-circle" style="height:65px !important; width:65px !important" border="0" src="<? print $configUrl;?>/<? print stripslashes($row['CatImage']);?>">
                                                </div>
                                            </div>
											-->
											
             
                                            <div class="media-body">
                                                <div class="media-heading m-0">
                                                    <a href="banner_manage.php?id=<? print $row['index'];?>&name=<? print stripslashes($row['title']);?>"   class="mr-1"><? print stripslashes($row['title']);?></a>
													<!--
													<span class="label bg-primary">family</span>
													-->
                                                    <span class="pull-left text-sm text-muted" >
                                                    <!--  <span class="hidden-xs"><? print date("d/m/y H:i:s", strtotime($row["date"]));?></span> -->
													 <div class="hidden-xs" style="margin-top:5px;">

														
														<a href="banner_manage.php?id=<? print $row['index'];?>&name=<? print stripslashes($row['title']);?>&type=0" ><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color:#0C3; padding-left:6px"><span class="badge bg-lightred" style="margin-right:4px;"><? print $totalCivil;?></span> באנרים לאזרחים</button>	</a>
														<a href="banner_manage.php?id=<? print $row['index'];?>&name=<? print stripslashes($row['title']);?>&type=1" ><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color:#008000; padding-left:6px"><span class="badge bg-lightred" style="margin-right:4px;"><? print $totalSoilder;?></span> באנרים לחיילים</button>	</a>
														
														<button  onClick="bannerSettings('<?= $row['index'];?>','<?= stripslashes($row['title']);?>')"  class="btn btn-info btn-rounded btn-icon-only btn-ef btn-ef-7 btn-ef-7g mb-10"><i style="" class="fa fa-cog"></i> Add <i class="after fa fa-plus"></i></button>

													</div>
													
                                                    </span>
                                                </div>
												<div>
												באנרים להצגה: <?= $BannerType[$row['TipliBannerType']];?>
												</div>
												<!--
												<a href="#" onClick='editCatagory("3","פמ"א","asdasd","0","3")' data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9">test</a>
												-->
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
			
			function bannerSettings(id,name)
			{
				window.location = "banner_settings.php?name="+name+"&id="+id;
			}
			
			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "catagories.php?del="+index;
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