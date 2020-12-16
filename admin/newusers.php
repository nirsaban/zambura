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
	$updateQuery = "UPDATE `users`
	SET  
	`deleted` ='1'
	WHERE `index` ='".mysqli_real_escape_string($_GET['del'])."'";
	$update =  mysqli_query($updateQuery) or die(mysqli_error()); 

	
	//$sql = "DELETE FROM `contacts` WHERE `index` = '".$_GET['del']."'";
	//$del = mysqli_query($sql);	

}

$i = 0;
//LIMIT 50
$query = "SELECT * FROM `users`  WHERE `date` >= '2018-08-01' AND `deleted` = '0' ORDER BY `index` DESC ";
$result=mysqli_query($query) or die('error connecting55'); 
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
				$menu = 'newusers';
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
                                    <li class="active" ><a href="newusers.php" class="pull-right" style="width:100%; text-align:right">משתמשים בגרסה החדשה <span class="pull-left badge bg-lightred"><? print $num_rows;?></span></a></li>
									
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
						<div class="col-md-12" style="text-align:right; margin-top:15px; ">

					

								
							
                            <!-- tile -->
                            <section class="tile">



                                <div class="tile-body">

                            <!-- tile -->
							

                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">

                                    <h1 class="custom-font" style="direction:rtl;"><strong>משתמשים (<?= $num_rows;?>)</strong></h1>
 
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
                                                <th style="30%" class="no-sort">אפשריות</th>	

												<th align="right" width="text-align:right; 30%">הרשמה</th>
												<th align="right" width="text-align:right; 30%">מנותק</th>
												<th align="right" width="text-align:right; 30%">קוד הזמנה</th>

                                                <th align="right" width="text-align:right; 30%">משחקים</th>
                                                <th align="right" width="text-align:right; 30%">נקודות החודש</th>
												<th align="right" width="text-align:right; 30%">ת. לא נכונות</th>
												<th align="right" width="text-align:right; 30%">ת. נכונות</th>
												<th align="right" width="text-align:right; 30%">כמות נקודות החודש</th>
												<th align="right" width="text-align:right; 30%">ת. לידה</th>
												<th align="right" width="text-align:right; 30%">מין</th>								
												<th align="right" width="text-align:right; 30%">עיר</th>			
												<th align="right" width="text-align:right; 30%">מייל</th>
												<th align="right" width="text-align:right; 30%">שם</th>
												<th width="5%"></th>
												<th width="5%">#</th>
												
                                            </tr>
                                            </thead>
                                        <tbody>
										<?

											$correctAnswers = 0;
											$wrongAnswers = 0;
                                            $points = 0;
                                            $start = date("Y-m-01");
                                            $end = date("Y-m-t");
                                            $monthPoints = 0;
											while ( $row = mysqli_fetch_array($result) )
											{
												$correctAnswers = 0;
												$wrongAnswers = 0;
                                                $points = 0;
                                                $monthPoints = 0;
                                                //$start = new DateTime('first day of this month');
                                                //$end = new DateTime('last day of this month');
												
											$i++;
											
											if ($row['gender'] == 0)
												$gender = "זכר";
											
											if ($row['gender'] == 1)
												$gender = "נקבה";

											if ($row['loggedIn'] == 0)
												$loggedInStatus = "לא";
											else
												$loggedInStatus = "כן";
											
											$query20 = "SELECT * FROM `users`  WHERE `partnerBy` = '".$row['index']."' ";
											$result20=mysqli_query($query20) or die('error connecting55'); 
											$num_rows20 = mysqli_num_rows($result20);
											//$row20 = mysqli_fetch_array($result20);
											
											
											$query5 = "SELECT * FROM `users_points`  WHERE `user_id` = '".$row['index']."' AND `question_date` BETWEEN '".$start."' AND '".$end."'";
                                            //$query5 = "SELECT * FROM `users_points`  WHERE `user_id` = '".$row['index']."'";
											$result5=mysqli_query($query5) or die('error connecting55'); 
											//$row5 = mysqli_fetch_array($result5);
											while ( $row5 = mysqli_fetch_array($result5) )
											{
                                                $points += $row5['points'];
												if ($row5['correct'] == "0")
													$wrongAnswers++;
												
												if ($row5['correct'] == "1")
													$correctAnswers++;													
											}


                                                $query8 = "SELECT * FROM `daily_points`  WHERE `user_id` = '".$row['index']."' AND `point_date` BETWEEN '".$start."' AND '".$end."' GROUP BY `point_date` ORDER BY `points` DESC";
                                                $result8=mysqli_query($query8) or die('error connecting55');
                                                $total_games = mysqli_num_rows($result8);
                                                $pointsArray = array();
                                                while ( $row8 = mysqli_fetch_array($result8) )
                                                {
                                                    //echo $row8['point_date'].' -- '.$row8['points'].'<br>';
                                                    $monthPoints += $row8['points'];
                                                }

										?>
                                        <tr>
										
                                            <td class="actions" >
													<button  onClick="ConfirmDelete('<?= $row['index'];?>')"  class="btn btn-info btn-rounded btn-icon-only btn-ef btn-ef-7 btn-ef-7g mb-10" ><i class="fa fa-trash"></i> Add <i class="after fa fa-plus"></i></button>
													<!--
													<button   onClick="editQuestion('<?= $row['index'];?>')"  class="btn btn-info btn-rounded btn-icon-only btn-ef btn-ef-7 btn-ef-7g mb-10" ><i class="fa fa-pencil"></i> Add <i class="after fa fa-plus"></i></button>
													-->
													
												   
											</td>										
                                            <td align="center" style="text-align:center; direction:rtl;"><? print date("d/m/y H:i:s", strtotime($row["date"]));?></td>
                                            
											<td align="center" style="text-align:center; direction:rtl;">
											<?= $loggedInStatus;?>
											</td>
											<td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['partnerCode']);?></td>


                                            <td align="center" style="text-align:center; direction:rtl;"><?= $total_games;?></td>

                                            <td align="center" style="text-align:center; direction:rtl;"><?= $monthPoints;?> </td>

                                            <td align="center" style="text-align:center; direction:rtl;"><?= $wrongAnswers;?></td>
                                            <td align="center" style="text-align:center; direction:rtl;"><?= $correctAnswers;?></td>
											<td align="center" style="text-align:center; direction:rtl;"><?= $points;?></td>
											
											<td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['birthday']);?></td>
											
                                            <td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($gender);?></td>
								            <td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['address']);?></td>
                                            <td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['email'] );?></td>
								            <td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['firstname']);?> <?= stripslashes($row['lastname']);?></td>
                                            
											<td align="center" style="text-align:center; direction:rtl;">
											<?
											if ($row['image'])
											{
												print '<img src="../php/'.$row['image'].'" style="width:40px; height:40px;">';
											}
											else 
											{
												print '';
											}
											?>
											</td>

											<td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['index']);?></td>

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

        <script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

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
					window.location = "newusers.php?del="+index;
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