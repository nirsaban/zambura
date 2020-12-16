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

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}


$i = 0;



if (!$_POST['startdate'])
		$startdate = date("d/m/Y");
	else
		 $startdate = $_POST['startdate'];
	 
	 
//print $startdate;
	


$explodeDate = explode("/",$startdate);
$newdate = ''.$explodeDate[2].'-'.$explodeDate[1].'-'.$explodeDate[0].'';

$dailyPointsArray = array();

$query = "SELECT * FROM `daily_points`  WHERE `point_date` LIKE '".$newdate."%' ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);


while ( $row = mysqli_fetch_assoc($result) )
{
    $dailyPointsArray[] =  $row;
}


//$dailyPointsArray = array_reverse(array_sort($dailyPointsArray, function ($value) {
//    return $value['points'];
//}));


function method1($a,$b)
{
    $a = $a['points'];
    $b = $b['points'];

    if ($a == $b) return 0;
    return ($a > $b) ? -1 : 1;
}
usort($dailyPointsArray, "method1");

$dailyPointsArray= unique_multidim_array($dailyPointsArray,'user_id');


//print '<div align="center">';
//print '<pre>';
//print_r($dailyPointsArray);
//print '</pre>';

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
				$menu = 'points_date';
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
                                    <li class="active" ><a href="points_date.php" class="pull-right" style="width:100%; text-align:right">ניקוד לפי תאריך </a></li>
									
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
							<form method="post" action="">
                            <div class="p-15 bg-white b-b">

									<div class="row">
									
                                    <div class="form-group col-md-12" align="center">
                                        <div class='input-group newdatepicker w-360 mt-10' >
                                            <input type='text' name="startdate"  id="startdate" value="<?= $_POST['startdate'];?>"  class="form-control " />
                                            
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                            
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
									<div>
									<h1><?= $startdate;?></h1>
									</div>
                                    <h1 class="custom-font" style="direction:rtl;"><strong>ניקוד לפי תאריך  (<?= count($dailyPointsArray);?>)</strong></h1>

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
                                                <!-- <th style="30%" class="no-sort">אפשריות</th> -->
                                                <th  width="text-align:center; width:20%">תאריך</th>
												<th  width="text-align:center; width:20%">נקודות יומיות</th>
                                                <th  width="text-align:center; width:20%">משחקים</th>
												<th  width="text-align:center; width:20%">שם</th>
												<th width="5%"></th>
												<th width="5%">#</th>
												
                                            </tr>
                                            </thead>
                                        <tbody>
										<?
                                            foreach ($dailyPointsArray as $row)
											{

											$i++;
											

                                            $query10 = "SELECT * FROM `users`  WHERE `index` = '".$row['user_id']."' ";
                                            $result10=mysqli_query($query10) or die('error connecting55');
                                            $row10 = mysqli_fetch_array($result10);


                                            $query11 = "SELECT * FROM `daily_points`  WHERE `user_id` = '".$row['user_id']."' AND `point_date` = '".$row['point_date']."' ";
                                            $result11=mysqli_query($query11) or die('error connecting55');
                                            //$row1 = mysqli_fetch_array($result11);
                                            $total_games = mysqli_num_rows($result11);

										?>
                                        <tr>
                                            <td align="center" style="text-align:center; direction:rtl;"><?= $row['point_date'];?></td>
                                            <td align="center" style="text-align:center; direction:rtl;"><?= $row['points'];?></td>
                                            <td align="center" style="text-align:center; direction:rtl;">
                                                <a href="#" onclick="showDetails(<?= $row['user_id'];?>,'<?= $row['point_date'];?>'); return false;">
                                                    <?= $total_games;?></a>
                                            </td>
								            <td align="center" style="text-align:center; direction:rtl;">
                                                <?= stripslashes($row10['firstname']);?> <?= stripslashes($row10['lastname']);?>
                                            </td>
                                            
											<td align="center" style="text-align:center; direction:rtl;">
											<?
											if ($row10['image'])
											{
												print '<img src="../php/'.$row10['image'].'" style="width:40px; height:40px;">';
											}
											else 
											{
												print '';
											}
											?>
											</td>

											<td align="center" style="text-align:center; direction:rtl;"><?= stripslashes($row['user_id']);?></td>

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


            <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-sm" style="width:500px !important" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="titledate" style="direction:rtl;">פרטים</h4>
                        </div>
                        <div class="modal-body">

                            <table id="records_table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th align="center">ת.לא נכונות</th>
                                    <th align="center">ת.נכונות</th>
                                    <th align="center">נקודות</th>
                                    <th align="center">תאריך</th>
                                    <th align="center">#</th>
                                </tr>
                                </thead>
                            <tbody>
                            </tbody>

                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
                        </div>
                    </div>


                </div>
            </div>


		
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

			function showDetails(user_id,date)
            {
                //$('#records_table').html('');
                $('#records_table tbody').html('');
                $.ajax({
                    url: 'ajax/get_points_date.php',
                    data: 'user_id='+user_id+'&date='+date,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response){

                        console.log("response",response)
                        if (response.length > 0)
                        {

                            var trHTML = '';
                            $.each(response, function (i, item) {
                                trHTML += '<tr>' +
                                    '<td align="center">' + item.wrongAnswerCount + '</td>' +
                                    '<td align="center">' + item.correctAnswerCount + '</td>' +
                                    '<td align="center">' + item.points + '</td>' +
                                    '<td align="center">' + item.point_date + '</td>' +
                                    '<td align="center">' + item.user_id + '</td>' +
                                    '</tr>';
                            });
                            $('#records_table tbody').append(trHTML);
                            $('#detailsModal').modal('show');

                        }
                        else
                        {
                        }


                    },
                    error: function(e){
                        //alert ("שגיאה יש לנסות שוב");
                        //console.log(e.responseText);
                    }
                });
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
					window.location = "todayusers.php?del="+index;
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