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




if ($_GET['del'])
{
	/*
	$updateQuery = "UPDATE `message_specialist`
	SET  
	`deleted` ='1'

	WHERE `index` ='".mysqli_real_escape_string($_GET['del'])."'";
	$update =  mysqli_query($updateQuery) or die(mysqli_error()); 
	*/
	
	$sql = "DELETE FROM `message_specialist` WHERE `user_id` = '".$_GET['del']."'";
	$del = mysqli_query($sql);	

}

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
  
  

if ($_POST['details'])
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

	
	$query10 = "SELECT * FROM `users`  WHERE  `push_id` != '' AND `deleted` = '0' ORDER BY `index` DESC";
	$result10=mysqli_query($query10) or die('error connecting22'); 
	//$num_rows = mysqli_num_rows($result);	
	while ( $row10 = mysqli_fetch_array($result10))
	{
		sendMessage($application_id,$_POST['details'],$row10['push_id'],$newfile);
		
		
		$sql= "INSERT INTO `message_specialist` (`user_id`,`message`,`type`)  VALUES (
		'".addslashes($row10['index'])."',
		'".addslashes($_POST['details'])."',
		'answer')";
		$InsertSql = mysqli_query($sql)  or die(mysqli_error());
		$insertId = mysqli_insert_id();	

		
	}
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
				$menu = 'messagespecialist';
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
                                <a href="new_supplier.php"  class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת ספק</a>

                            </div>
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">
							
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="messagespecialist.php"> פניה למומחה <span class="pull-right badge bg-lightred"><? print $num_rows;?></span></a></li>
                                </ul>							


							
							
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

                                    <h1 class="custom-font"><strong>פניה למומחה </strong></h1>
 
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">
								
                                <!-- tile body -->
                                <div class="tile-body">
									<form name="form2" action="" method="post" role="form" id="form2" enctype="multipart/form-data" data-parsley-validate>								
                                    <div class="table-responsive">
                                        <table class="table table hover" id="basic-usage">
                                            <thead>
                                            <tr>
                                                <th style="30%" class="no-sort">אפשריות</th>	



												<th align="right" width="text-align:right; 30%">תאריך</th>
												<th align="right" width="text-align:right; 30%">הודעה אחרונה</th>
												<th align="right" width="text-align:right; 30%">שם מלא</th>
												
                                            </tr>
                                            </thead>
                                        <tbody>
										<?
											$i = 0;
											//$query = "SELECT * FROM `message_specialist`  WHERE `deleted` = '0' GROUP BY `user_id` ORDER BY `date`  DESC ";
											$query = "SELECT distinct `user_id` FROM `message_specialist`  WHERE `type` = 'question' GROUP BY `user_id` ORDER BY MAX(date) DESC";
		
											$result=mysqli_query($query) or die(mysqli_error()); 
											$num_rows = mysqli_num_rows($result);
											
											while ( $row = mysqli_fetch_array($result) )
											{
											$i++;
											

											$query2 = "SELECT * FROM `users`  WHERE `index` = '".$row['user_id']."' ";
											$result2=mysqli_query($query2) or die('error connecting55'); 
											$row2 = mysqli_fetch_array($result2);
											
											
											
											$query5 = "SELECT * FROM `message_specialist`  WHERE `type` = 'question' AND `user_id` = '".$row['user_id']."' ORDER BY `index` DESC";
											$result5=mysqli_query($query5) or die('error connecting55'); 
											$row5 = mysqli_fetch_array($result5);



											$msg = stripslashes($row5['message']);

										?>
                                        <tr>
										
                                            <td class="actions">
											
											
												<button  onClick="ConfirmDelete('<?= $row['user_id'];?>')"  class="btn btn-info btn-rounded btn-icon-only btn-ef btn-ef-7 btn-ef-7g mb-10"><i class="fa fa-trash"></i> Add <i class="after fa fa-plus"></i></button>

	   
											</td>
											<?
											// H:i:s
											?>
                                            <td align="center" style="text-align:center; direction:rtl;"><? print date("d/m/y", strtotime($row5["date"]));?></td>

                                            <td align="center; " onClick="goMessage('<?= $row['user_id'];?>')" style="text-align:center; direction:rtl; cursor:pointer;"><?= stripslashes($msg);?></td>
											

                                            <td align="center" onClick="goMessage('<?= $row['user_id'];?>')" style="text-align:center; direction:rtl; cursor:pointer;"><?= stripslashes($row2['firstname']);?> <?= stripslashes($row2['lastname']);?></td>

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
								
								<!--
										<div class="row" style="text-align:right; direction:rtl;">

											<div class="form-group col-md-12">
                                            <label for="area" tab-index="3" >תמונה: </label>
                                                <input type="file" tab-index="6" name="file" >
                                            </div>											

											
											
                                        </div>
								-->



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
								
								
								
								
                            </section>
                            <!-- /tile -->	
							
							
							
							
							


                                </div>


                            </section>
                            <!-- /tile -->

	
	<?


	
	/*
	print '<pre>';
	print_r($messagesArray);
	print '</pre>';
	//print_r($jsonarray);
	*/
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
				
				
                $('#form2Submit').on('click', function(){
					var details = $( "#summernote" ).val();
					if (details =="")
						alert ("יש להזין תוכן ההודעה");
					else
                    $('#form2').submit();
                });
				

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
				
				
			function goMessage(index)
			{
				window.location = "messages.php?id="+index;
			}			
		

			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "messagespecialist.php?del="+index;
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