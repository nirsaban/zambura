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
//	$updateQuery = "UPDATE `users`
//	SET
//	`deleted` ='1'
//	WHERE `index` ='".mysqli_real_escape_string($_GET['del'])."'";
//	$update =  mysqli_query($updateQuery) or die(mysqli_error());

	
	//$sql = "DELETE FROM `contacts` WHERE `index` = '".$_GET['del']."'";
	//$del = mysqli_query($sql);	

}

$i = 0;
$startDate = date("Y").'-'.date("m").'-01';
$endMonthDate = date("Y-m-t");

if (!$_POST['startdate'])
	$_POST['startdate'] = date("Y-m-01");

if (!$_POST['enddate'])
	$_POST['enddate'] = date("Y-m-t");


if (!$_POST['banner_type'])
    $_POST['banner_type'] = 0;

if (!$_POST['internal_ad'])
    $_POST['internal_ad'] = 0;

if (!$_POST['external_url'])
    $_POST['external_url'] = 0;


if ($_POST['searchdate'])
{
	if ($_POST['startdate'])
	{
		$explodestart = explode("/",$_POST['startdate']);
		$startDate = ''.$explodestart[2].'-'.$explodestart[1].'-'.$explodestart[0].'';		
	}

	if ($_POST['enddate'])
	{
		$explodeend = explode("/",$_POST['enddate']);
		$endDate = ''.$explodeend[2].'-'.$explodeend[1].'-'.$explodeend[0].'';		
	}
}
else
{
	$startDate = $_POST['startdate']; 
	$endDate = $_POST['enddate'];	
}



//print $endDate;


//$query = "SELECT * FROM `users`  WHERE DATE(`date`) BETWEEN '".$startDate."' AND '".$endDate."' AND `deleted` = '0' ORDER BY `index` DESC ";
$query = "SELECT 
   banners_new_click_view.banner_id as banner_id,
   banners_new_click_view.created_at as click_date,
   banners_new_click_view.view_click as view_click,
   banners_new.title as title,
   banners_new.supplier_name as supplier_name
FROM banners_new_click_view
LEFT JOIN banners_new ON 
    banners_new_click_view.banner_id = banners_new.id
     WHERE DATE(banners_new_click_view.created_at) BETWEEN '".$startDate."' AND '".$endDate."'  
     AND banners_new.banner_type = '".$_POST['banner_type']."'
     AND banners_new.internal_ad = '".$_POST['internal_ad']."'
     AND banners_new.android_iphone = '".$_POST['android_iphone']."'
     ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);
//print $query;

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
        <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->

	<style>
	
	</style>


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
				$menu = 'banners_new_stats';
				include_once('menu.php');
				?>

                <!--/ SIDEBAR Content -->


            </div>
            <!--/ CONTROLS Content -->




            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-full page-calendar">


                    <div class="tbox tbox-sm">


                        <!-- left side -->
                        <div class="tcol w-md bg-tr-white lt b-r">



                            <!-- left side header
                            <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="new_deal.php"  class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת דיל</a>

                            </div>
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">
							
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders" >
                                    <li class="active" ><a href="banners_new_stats.php" class="pull-right" style="width:100%; text-align:right">סטיסטיקות באנרים  </a></li>
									
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


								<!--
								<div align="center">
									<button type="button" class="btn btn-sm btn-lightred b-0 br-2 text-strong" data-toggle="modal" data-target=".bs-example-modal-sm">הוספת תור חדש</button>								 
								</div>
                               -->

                           

                            <!-- /left side body -->




                        </div>
                        <!-- /left side -->







                        <!-- right side -->
                        <div class="tcol">
						
                            <!-- right side header -->
							
                            <!-- right side header -->
							<form method="post" action="">
                            <div class="p-15 bg-white b-b">

									<div class="row">
									
                                    <div class="form-group col-md-12" align="center">
                                        <div class='input-group newdatepicker w-360 mt-10' >
                                            <input type='text' name="startdate"  id="startdate" value="<?= $_POST['startdate'];?>"  class="form-control " required />
                                            
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                            
                                        </div>                                      
                                        </div> 
										
                                    <div class="form-group col-md-12" align="center">
                                        <div class='input-group newdatepicker w-360 mt-10' >
                                            <input type='text' name="enddate"  id="enddate" value="<?= $_POST['enddate'];?>"  class="form-control " required />
                                            
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                            
                                        </div>                                      
                                    </div>



                                        <div class="form-group col-md-12" align="center">
                                            <div class='input-group  w-360 mt-10' >
                                                <label for="area" tab-index="3" >סוג הפרסומת: </label>
                                                <select name="banner_type" class="form-control"  required>
                                                    <option value="0" <?php if ($_POST['banner_type'] == "0") { print 'selected'; } ?>>מעברון</option>
                                                    <option value="1" <?php if ($_POST['banner_type'] == "1") { print 'selected'; } ?>>קוביה 350X250</option>
                                                    <option value="2" <?php if ($_POST['banner_type'] == "2") { print 'selected'; } ?>>באנר 350X50</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12" align="center">
                                            <div class='input-group  w-360 mt-10' >
                                                <select name="internal_ad" class="form-control"  required>
                                                    <option value="0" <?php if ($_POST['internal_ad'] == "0") { print 'selected'; } ?>>פרסומת עצמאית</option>
                                                    <option value="1" <?php if ($_POST['internal_ad'] == "1") { print 'selected'; } ?>>פרסומת חיצונית</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12" align="center">
                                            <div class='input-group  w-360 mt-10' >
                                                <label for="area" tab-index="3" >סוג הפרס: </label>
                                                <select name="android_iphone" class="form-control"  required>
                                                    <option value="0" <?php if ($_POST['android_iphone'] == "0") { print 'selected'; } ?>>אנדרואיד</option>
                                                    <option value="1" <?php if ($_POST['android_iphone'] == "1") { print 'selected'; } ?>>אייפון</option>
                                                </select>
                                            </div>
                                        </div>
									
								<input type="hidden" name="searchdate" value="1">								
								</form>
								

								</div>
								
								<div class="row" align="center">
									<div class="btn-group">
									   <input type="submit" class="btn btn-primary mb-10" value="חיפוש">
									</div>									
								</div>

                            </div>
							
                            <!-- /right side header -->

							

							
						
							
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
	
                                    <h1 class="custom-font" style="direction:rtl;"><strong>סטיסטיקות באנרים   (<?= $num_rows;?>)</strong></h1>
									<div>
									<strong>התחלה: <?= $_POST['startdate'];?></strong></div>
									<strong>סיום: <?= $_POST['enddate'];?></strong></div>

                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">
								
                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table hover" id="basic-usage">
                                            <thead>
                                            <tr>
												<th width="20%" align="center" width="text-align:center; width:20%">תאריך פעולה</th>
												<th width="20%" align="center" width="text-align:center; width:20%">צפיה/לחיצה</th>
												<th   width="text-align:center !important; width:30%; background-color:red;">ספק</th>
												<th width="30%" align="center" width="text-align:center; width:30%">כותרת</th>
                                            </tr>
                                            </thead>
                                        <tbody>
										<?

											while ( $row = mysqli_fetch_assoc($result) )
											{
                                                //print '<pre>';
											    //print_r($row);
											    //print '</pre>';

                                                if ($row['view_click'] == "0")
                                                    $clickView = "צפיה";
                                                else
                                                    $clickView = "לחיצה";


//											//$query5 = "SELECT * FROM `users_points`  WHERE `user_id` = '".$row['index']."' AND `question_date` BETWEEN '".$start->format('Y-m-d')."' AND '".$end->format('Y-m-d')."'";
//                                            $query5 = "SELECT * FROM `daily_points`  WHERE `user_id` = '".$row['index']."' AND `point_date` BETWEEN '".$start->format('Y-m-01')."' AND '".$end->format('Y-m-t')."'";
//                                            $result5=mysqli_query($query5) or die('error connecting55');
//											$num5 = mysqli_num_rows($result5);
//											//echo $num5;

										
										?>
                                        <tr >
                                            <td align="left" style="text-align:left; direction:rtl;"><? print date("d/m/y H:i:s", strtotime($row["click_date"]));?></td>
                                            <td align="left" style="text-align:left; direction:rtl;"><?= stripslashes($clickView);?></td>
                                            <td align="left" style="text-align:left; direction:rtl; "><?= stripslashes($row['supplier_name']);?></td>
                                            <td align="left" style="text-align:left; direction:rtl;"><?= stripslashes($row['title'] );?></td>
                                        </tr>
										<?
										}
										?>										

                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /tile body -->

								


                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->	


                                </div>


                            </section>
                            <!-- /tile -->

	
	<?
	//print_r($jsonarray);
	?>
	

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


        <!-- Splash Modal -->
        <form method="post" action="" enctype="multipart/form-data" data-parsley-validate>
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
										<label for="exampleInputEmail1">בחירת תאריך:</label>
											 <div class='input-group datepicker w-360' data-format="DD/MM/YYYY" style="direction:ltr;">
												<input type='text' name="deal_date" pattern="\d{1,2}/\d{1,2}/\d{4}" class="form-control" required />
												<span class="input-group-addon">
													<span class="fa fa-calendar"></span>
												</span>
											</div>
									</div> 
									
									<div class="form-group" style="direction:rtl;">

												<label for="showapp">בחירת סוג: </label>
                                                <select name="sugselect" class="form-control" required>
												    <option value="" >יש לבחור סוג</option>
													
													<option value="1" >חייל</option>
												    <option value="2" >חיילת</option> 
												    <option value="3" >כל החיילים</option> 
													
													<option value="4" >אזרח</option>
												    <option value="5" >אזרחית</option> 
												    <option value="6" >כל האזרחים</option> 
													
													<option value="7" >כולם</option>
												</select>
                                            </div>


 

									<!--
									<div class="form-group" style="direction:rtl;">
										<label for="exampleInputEmail1">תמונה:</label>
										<input type="file" name="file" class="form-control" >
									</div>  
								    -->
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
        <input type="hidden" value="0" name="questionid" id="questionid">
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

        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="assets/js/vendor/slider/bootstrap-slider.min.js"></script>

        <script src="assets/js/vendor/colorpicker/js/bootstrap-colorpicker.min.js"></script>

        <script src="assets/js/vendor/touchspin/jquery.bootstrap-touchspin.min.js"></script>

		<script src="assets/js/moment/moment-with-locales.js"></script>

        <script src="assets/js/vendor/daterangepicker/daterangepicker.js"></script>
		
		
        <script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

        <script src="assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>

        <script src="assets/js/vendor/summernote/summernote.min.js"></script>
		 <script src="assets/js/vendor/parsley/parsley.min.js"></script>

        <!--/ vendor javascripts -->


        <script src="assets/js/vendor/summernote/summernote.min.js"></script>

        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

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
				

                //initialize basic datatable
				/*
                var table = $('#basic-usage').DataTable({
                    "ajax": 'users_data.php?type=<? print $_GET['type'];?>',
                    "columns": [
                        { "data": "id" },
                        { "data": "name" },
						{ "data": "email" },
						{ "data": "products" },
						{ "data": "emailssent" },
						{ "data": "quotes" },
						{ "data": "date" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				*/
                var table = $('#basic-usage').DataTable({
					"iDisplayLength": 100,
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ]
                });
                $('#basic-usage tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('row_selected') ) {
                        $(this).removeClass('row_selected');
                    }
                    else {
                        table.$('tr.row_selected').removeClass('row_selected');
                        $(this).addClass('row_selected');
                    }
                });
                //*initialize basic datatable
				
				

				
            });
			
				$('.newdatepicker').datetimepicker(
				{
					format: 'DD/MM/YYYY',
                    locale: 'he'
                }, 
				function(start, end, label) {
					//alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
				});

				
			function editCatagory(index,title)
			{
				$( "#modaltitle" ).html(title);
				$("#questionid").val(index);	

			}	

			function addCatagory(index,catagory,title)
			{
				$( "#modaltitle" ).html(title);
				$("#catindex").val(0);
				$("#cattitle").val('');	
				$("#catarea").val('');	
				$("#catbuilding").val('');	
				$("#catbuildname").val('');	
				$("#catdev").val('');	
				$("#catfloor").val('');	
			}
			

			function editQuestion  (index)
			{
				window.location = "edit_user.php?id="+index;

			}
			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "monthusers.php?del="+index;
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