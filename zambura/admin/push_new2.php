<?
if (!isset($_SESSION)) {
session_start();
}
set_time_limit(0);
include_once('../php/db.php');
include_once('config.php');

mb_internal_encoding("UTF-8");

if (!$_SESSION['admin'])
{
	header('Location: index.php');
	exit;
}
$application_id =  "96b66281-ac3d-44e5-834f-e39b3cc98626";
$g = 0;




  function sendMessage($appid,$desc,$deviceid,$image)
  {

    
    $fields = array(
      'app_id' => $appid,
	  //'delayed_option' => "timezone",
	  //'delivery_time_of_day' => "2016-05-18 12:50:00 GMT-03:00",
      //'included_segments' => array('All'),
	  'big_picture' => $image,
	  'include_player_ids' => array($deviceid),
      'data' => array("foo" => "bar"),
      'contents' => array(
      "en" => $desc
      )
    );
    
    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                           'Authorization: Basic YWUyZjI5NzAtZDE0NS00ZThmLTk2Y2QtZjhmYjFmZGM0YmFl'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    
    //return $response;
  }
  
  
  
  
if ($_POST['insert'])
{
	
if ($_FILES['file']['name'])
{

	$upload_file_name = $_FILES['file']['name'];
	$fileName = "../php/uploads/".$savedate."_".$upload_file_name;
	$saveDir = "".$savedate."_".$upload_file_name;
	$tmp_name = $_FILES["file"]["tmp_name"];

	if(move_uploaded_file($tmp_name,$fileName)) 
	{
		$newfile = "".$configUrl."/".$saveDir."";
	}
	else
	{
		$newfile = '';
	}
	
	//die($newfile);
	
}


	
	$pushids = array();
	
	if (is_array($_POST['pushid']))
	{
		foreach ($_POST['pushid'] as $newid)
		{
			if ($newid)
			{
				$pushids[] = $newid;
			}
			
		}
		
		$pushids = array_unique($pushids);

		if ($_POST['details'])
		{
			foreach ($pushids as $sendid)
			{
				$g++;
				sendMessage($application_id,$_POST['details'],$sendid,$newfile);
			}
			
		}
	}
}

//print_r($pushids);



									


$query = "SELECT * FROM `users`  WHERE `push_id` != '' AND `deleted` = '0' AND  `date` >= '2017-07-01' ORDER BY `index` DESC";
$result=mysqli_query($query) or die(mysqli_error());
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
                        <a class="brand" href="#">
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
				$menu = 'push_new';
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
                                <a href="new_supplier.php" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת עסק חדש</a>

                            </div>
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders" >
                                    <li class="active" ><a href="push_new.php" class="pull-right" style="width:100%; text-align:right">שליחת הודעות לנרשמים חדשים <span class="pull-left badge bg-lightred"><? print $num_rows;?></span></a></li>
									
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
									<strong>לא נמצאו משתמשים חדשים</strong>
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
                            <!-- right side header 
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

                            <!-- tile -->
                            <section class="tile">
						<?
						if ($_POST['insert'])
						{
						?>
						<div class="alert alert-success" style="direction:rtl; text-align:right;">
							<strong>הודעה נשלחה בהצלחה ל <?= $g;?> משתמשים חדשים.</strong>
						</div>
						<?
						}
						?>
                                <!-- tile header 
                                <div class="tile-header dvd dvd-btm">

                                    <!-- <h1 class="custom-font"><strong><?= $tableName;?> </strong></h1> 
 
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">
								
                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
									<form name="form2" action="" method="post" role="form" id="form2" enctype="multipart/form-data" data-parsley-validate>
                                        <table class="table table hover" id="basic-usage" style="direction:rtl;">
                                            <thead>
                                            <tr>

                                                <th width="3%" style="text-align:center;" class="no-sort">
                                                    <label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
                                                        <input type="checkbox" id="select-all"><i></i>
                                                    </label>
                                                </th>											
												<th style="text-align:center;" width="3%">#</th>
												<th style="text-align:center;" width="15%">שם</th>
												<th style="text-align:center;" width="3%">טלפון</th>
												<th style="text-align:center;" width="3%">מייל</th>
												<th style="text-align:center;" width="20%">ת.הרשמה</th>
                                                <!-- <th style="30%" class="no-sort">אפשריות</th> -->
                                            </tr>
                                            </thead>
                                        <tbody>
										<?
										$i = 0;
										while ( $row = mysqli_fetch_array($result))
										{
											$i++;

										?>
                                        <tr>
                                            <td align="center">
												<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" name="pushid[]" value="<?= stripslashes($row['push_id']);?>" class="selectMe"><i></i></label>
											</td>										
                                            <td align="center"><?= $row['index'];?></td>
                                            <td align="center"><?= stripslashes($row['name']);?></td>
                                            <td align="center"><?= stripslashes($row['phone']);?></td>
                                            <td align="center"><?= stripslashes($row['email']);?></td>
                                            <td align="center"><?= date("d/m/y h:i:s", strtotime($row["date"]))?></td>
											<!--
                                            <td class="actions">
												<a role="button" href="user_edit.php?type=<? print $_GET['type'];?>&id=<? print $row['index'];?>" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a>

											</td>
											-->

                                        </tr>
										<?
										}
										?>										

                                        </tbody>
                                        </table>
                                    </div>



                            <!-- tile -->
                            <section class="tile">



                                <div class="tile-body">


                                    
										<div class="row" style="text-align:right; direction:rtl;">
											<!--
											<div class="form-group col-md-6">
                                            <label for="area" tab-index="3" >תמונה גדולה: </label>
                                                <input type="file" tab-index="8" name="file2" required>
                                            </div>
											-->
											<div class="form-group col-md-12">
                                            <label for="area" tab-index="3" >תמונה: </label>
                                                <input type="file" tab-index="6" name="file" >
                                            </div>											

											
											
                                        </div>




                                        <div class="form-group" style="text-align:right; direction:rtl;">
                                            <label for="message" >תוכן ההודעה: </label>
                                            <textarea class="form-control" rows="8" name="details" id="summernote" placeholder="תוכן ההודעה" required></textarea>
                                        </div>
										<input type="hidden" name="insert" value="1">
                                    </form>

                                </div>
                                <!-- /tile body -->

                                <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top" style="background:#fff !important;">
                                    <!-- SUBMIT BUTTON -->
                                    <button id="form2Submit" class="btn btn-lightred" type="submit">שליחה</button>
                                </div>
								<?
								//print '<pre>';
								//print_r($_POST);
								//print '</pre>';
								?>
                                <!-- /tile footer -->

                            </section>
                            <!-- /tile -->





                       
	
									
									
                                </div>
                                <!-- /tile body -->

								


                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->	

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

				$("#basic-usage .selectMe").attr ( "checked" , true );
			
			
                $('#form2Submit').on('click', function(){
                    $('#form2').submit();
                });

				
                $('#select-all').change(function() {
                    if ($(this).is(":checked")) {
                        $('#basic-usage .selectMe').prop('checked', true);
                    } else {
                        $('#basic-usage .selectMe').prop('checked', false);
                    }
                });
				
                var table = $('#basic-usage').DataTable({
					"iDisplayLength": -1,
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
			
			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "push_new.php?del="+index;
				}
			}			
        </script>
        <!--/ Page Specific Scripts -->





    </body>
</html>
