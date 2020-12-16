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
    $updateQuery = "DELETE FROM  `banners_new`  WHERE `id` ='".mysqli_real_escape_string($_GET['del'])."'";
    $update =  mysqli_query($updateQuery) or die(mysqli_error());
}


	$query = "SELECT * FROM `banners_new` WHERE `android_iphone` = '0' ORDER BY `id` DESC";
	$result=mysqli_query($query) or die('error connecting'); 
	$num_rows = mysqli_num_rows($result);




$banner_type = array(
    "0" => "מעברון",
    "1" => "קוביה 350X250",
    "2" => "באנר 350X50"
);

$internal_ad = array(
    "0" => "פרסומת עצמאית",
    "1" => "פרסומת חיצונית",
);


function getstats($view_click)
{
    $total = 0;
    $query4 = "SELECT * FROM `banners_new` WHERE `android_iphone` = '0' ";
    $result4=mysqli_query($query4) or die('error connecting');
    while ( $row4 = mysqli_fetch_array($result4)){
        $query5 = "SELECT * FROM `banners_new_click_view` WHERE `banner_id` = '".$row4['id']."' AND `view_click` = '".$view_click."' ";
        $result5=mysqli_query($query5) or die('error connecting');
        $num_rows5 = mysqli_num_rows($result5);
        $total += $num_rows5;
    }

    return $total;
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
				$menu = 'banners_new_android';
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


                        <!-- left side
                        <div class="tcol w-md bg-tr-white lt b-r">



                            <!-- left side header
                            <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="#" onClick="addCatagory(0,'','הוספת קטגוריה חדשה')" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-9" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת קטגוריה חדשה</a>

                            </div>
                            <!-- /left side header -->



                            <!-- left side body
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="banners_new.php"> ניהול באנרים חדש <span class="pull-right badge bg-lightred"><? print $num_rows;?></span></a></li>
                                </ul>

                            </div>
                            <!-- left side body



                        </div>
                        -->
                        <!-- /left side -->
            
            	<!-- right side -->
                <div class="tcol">


                    <!-- right side body -->
                    <div class="col-md-12" style="text-align:right; margin-top:15px; ">





                        <!-- tile -->
                        <section class="tile">



                            <div class="tile-body">

                                <!-- tile -->


                                <!-- tile -->
                                <section class="tile">

                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">

                                        <h1 class="custom-font"><strong>ניהול באנרים אנדוראיד </strong></h1>

                                    </div>

                                    <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                        <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                        <a href="add_banner_new.php?android_iphone=0"    class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת באנר</a>

                                    </div>
                                </section>
                                <div>
                                    <div>צפיות: <?= getstats(0);?></div>
                                    <div>לחיצות: <?= getstats(1);?></div>
                                </div>
                            </div>

                        </section>


								
                <!-- right side header
                <div class="p-15 bg-white b-b">

                    <div class="btn-group pull-right">
                        
                    </div>
                   
                    <div class="btn-toolbar">
                    	<form action="banners.php" method="post">
                            <div class="input-group mb-10">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">! חפש באנר</button>
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

				  

					$deals_query = "SELECT * FROM `banners_new_gallery` WHERE `banner_id`= '".$row['id']."' ";
					$deals_result=mysqli_query($deals_query) or die('error connecting');
					$num_deals = mysqli_num_rows($deals_result);


					
					
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
                                                    <a href="edit_banner_new.php?id=<? print $row['id'];?>&name=<? print stripslashes($row['title']);?>&android_iphone=0"   class="mr-1"><? print stripslashes($row['title']);?></a>
													<!--
													<span class="label bg-primary">family</span>
													-->
                                                    <span class="pull-left text-sm text-muted" >
                                                      <span class="hidden-xs"><? print date("d/m/y H:i:s", strtotime($row["created_at"]));?></span>
													 <div class="hidden-xs" style="margin-top:5px;">




                                                        <a href="banners_new_gallery.php?id=<? print $row['id'];?>&name=<? print stripslashes($row['title']);?>&android_iphone=0"   ><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color: #d6d680;">תמונות <?= $num_deals;?> <i class="glyphicon glyphicon-camera" style="padding-top:5px;  "></i></button>	</a>
                                                        <a href="edit_banner_new.php?id=<? print $row['id'];?>&name=<? print stripslashes($row['title']);?>&android_iphone=0"   ><button  class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl; background-color:#666">עריכה<i class="glyphicon glyphicon-edit" style="padding-top:5px;  "></i></button>	</a>
                                                        <button onClick="ConfirmDelete(<? print $row['id'];?>)" class="btn btn-primary btn-ef btn-ef-7 btn-ef-7b mb-10" style="font-weight:bold; direction:rtl">מחיקה<i class="glyphicon glyphicon-trash" style="padding-top:5px; "></i></button>


													</div>
													
                                                    </span>
                                                </div>
												<div>
												ספק:  <?= stripslashes($row['supplier_name']);?>
                                                </div>

                                                   <div>
                                                       <strong><?= $banner_type[$row['banner_type']];?></strong>
                                                   </div>
                                                <div>
                                                    <strong><?= $internal_ad[$row['internal_ad']];?></strong>
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

            });


			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "banners_new_android.php?del="+index;
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