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


function super_unique($array,$key)
{
    $temp_array = [];
    foreach ($array as &$v) {
        if (!isset($temp_array[$v[$key]]))
            $temp_array[$v[$key]] =& $v;
    }
    $array = array_values($temp_array);
    return $array;

}


function orderByPoints($a, $b)
{
    return $a < $b;
}


$HumanMonths = array(
    "01" => "ינואר",
    "02" => "פבואר",
    "03" => "מרץ",
    "04" => "אפריל",
    "05" => "מאי",
    "06" => "יוני",
    "07" => "יולי",
    "08" => "אוגוסט",
    "09" => "ספטמבר",
    "10" => "אוקטובר",
    "11" => "נובמבר",
    "12" => "דצמבר",
);

if ($_GET['month'] == "")
	$month  = date("m");
else
	$month  = $_GET['month'];

$year = $_GET['year'];
$currentyear = date("Y");
$lastyear = date("Y",strtotime("-1 year"));


function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
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
				$menu = 'topscores';
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
                                    <li class="active" style="text-align:right;"><a href="topscores.php?month=<?= $month;?>&year=<?= $year;?>"> לוח תוצאות <span class="pull-right badge bg-lightred"><? print $num_rows;?></span></a></li>
                                </ul>							

								<?
								
								if ($_GET['year'] == $lastyear)
									$lastyearClass = "red";
								else
									$lastyearClass = "primary";	

								
								if ($_GET['year'] == $currentyear)
									$thisyearClass = "red";
								else
									$thisyearClass = "primary";
								
							
								
								?>
                                <h5 class="b-b p-10 text-strong" style="text-align:right; direction:rtl;">בחירת שנה: </h5>
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >
								
								
								


									<li><a href="topscores.php?month=<?=  $_GET['month'];?>&year=<?= $lastyear; ?>" style="text-align:right"><i class="fa fa-fw fa-circle text-<?= $lastyearClass;?> pull-right" style="padding-top:3px;"></i><?= $lastyear; ?></a></li>									
									
									
									<li><a href="topscores.php?month=<?=  $_GET['month'];?>&year=<?= $currentyear; ?>" style="text-align:right"><i class="fa fa-fw fa-circle text-<?= $thisyearClass;?> pull-right" style="padding-top:3px;"></i><?= $currentyear; ?></a></li>
                                </ul>


								
								
                                <h5 class="b-b p-10 text-strong" style="text-align:right; direction:rtl;">חודש: </h5>
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >
									<?
									foreach ($HumanMonths as $key=>$currentMonth)
									{
										if ($_GET['month'] == $key || $month == $key)
										{
										?>
											<li><a href="topscores.php?month=<?= $key;?>&year=<?= $year;?>" style="text-align:right"><i class="fa fa-fw fa-circle text-red pull-right" style="padding-top:3px;"></i><?= $currentMonth;?></a></li>
										
										<?
										}	
										else
										{
										?>
											<li><a href="topscores.php?month=<?= $key;?>&year=<?= $year;?>" style="text-align:right"><i class="fa fa-fw fa-circle text-primary pull-right" style="padding-top:3px;"></i><?= $currentMonth;?></a></li>
										<?
										}
									?>
									<?
									}
									?>
									

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

                                    <h1 class="custom-font"><strong>לוח תוצאות - <?= $HumanMonths[$month];?> <?= $year;?></strong></h1>
 
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
												<th align="right" width="text-align:right; 30%">שנה</th>
												<th align="right" width="text-align:right; 30%">חודש</th>
                                                <th align="right" width="text-align:right; 30%">משחקים</th>
                                                <th align="right" width="text-align:right; 30%">נקודות</th>
												<th align="right" width="text-align:right; 30%">מייל</th>
												<th align="right" width="text-align:right; 30%">שם מלא</th>
												<th align="right" width="text-align:right; 30%"></th>
                                            </tr>
                                            </thead>
                                        <tbody>
										<?
											$i = 0;
											$year = date("Y");
											$month = date("m");
                                            $totalPoints = array();
                                            $getpoints = array();
                                            $getpoints2 = array();
                                            $usersPoint = array();
                                            $tablepoints = 0;
                                            $pointsArray = array();
                                            $testArray = array();
                                            $testArray2 = array();
                                            $limit = 0;
                                            $totalpoints = 0;


                                             //$query = "SELECT * FROM  `daily_points`  WHERE `user_id` > '0' AND  `point_date` LIKE '%".$year."-".$month."-%'  ORDER BY `point_date` ASC";


                                                //$query = "SELECT * FROM  `daily_points`  WHERE `user_id` > '0'  AND `user_id` = '5007' AND  `point_date` LIKE '%".$year."-".$month."-%'  ORDER BY `point_date` ASC";
                                                //$query = "SELECT * FROM  `daily_points`  WHERE `user_id` > '0'   AND  `point_date` LIKE '%".$year."-".$month."-%'  ORDER BY `point_date` ASC";
                                               // $query = "SELECT MAX(points) FROM  `daily_points`  WHERE `user_id` > '0'  AND `user_id` = '5007' AND  `point_date` LIKE '%".$year."-".$month."-%'  ORDER BY `point_date` ASC";

                                       // $query =  "SELECT user_id, MAX(points) AS hiscore, point_date AS sdate FROM `daily_points` WHERE `point_date` LIKE '%".$year."-".$month."-%' GROUP BY user_id, sdate ORDER BY points DESC;"
                                            //SELECT user_id, MAX(points) AS hiscore, point_date AS sdate FROM `daily_points` WHERE `point_date` LIKE '%2018-11%' GROUP BY user_id ORDER BY hiscore DESC LIMIT 10

                                       //$query =  "SELECT user_id, MAX(points) AS hiscore, point_date AS sdate FROM `daily_points` WHERE `point_date` LIKE '%".$year."-".$month."-%' GROUP BY user_id, sdate ORDER BY points DESC;"
                                        $users = "SELECT user_id FROM `daily_points` WHERE `point_date` LIKE '%".$year."-".$month."-%' GROUP BY user_id";
                                        $result = mysqli_query($users) or die(mysqli_error());

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $count = 0;
                                            for($i=0;$i<32;$i++)
                                            {
                                                if($i < 10)
                                                    $day = "0".$i;
                                                else
                                                    $day = $i;

                                               $user = $row['user_id'];
                                                //$maxPoint = "SELECT MAX(points) AS hiscore FROM `daily_points` WHERE `point_date` LIKE '%".$year."-".$month."-".$day."-%' AND user_id = '$user'";
                                                $maxPoint = "SELECT MAX(points) AS hiscore FROM `daily_points` WHERE `point_date`  = '".$year."-".$month."-".$day."' AND user_id = '$user'";

                                                $mPoint = mysqli_query($maxPoint) or die(mysqli_error());
                                                $mPoint1 = mysqli_fetch_assoc($mPoint);
                                               // echo $maxPoint;
                                                if(count($mPoint1['hiscore']) == '1')
                                                $count += $mPoint1['hiscore'];

                                                $totalPoints[$row['user_id']] = $count;
                                            }
                                        }
                                        uasort($totalPoints,"orderByPoints");
                                       // print_r($totalPoints);
                                        foreach ($totalPoints as $key1=>$value1)
                                        {
                                            $query3 = "SELECT * FROM `daily_points` WHERE `point_date` LIKE '%".$year."-".$month."-%'  AND user_id = '$key1'";
                                            $result3=mysqli_query($query3) or die(mysqli_error());
                                            $num1 = mysqli_num_rows($result3);


                                            $query2 = "SELECT * FROM  `users`  WHERE `index` = '".$key1."'";
                                            $result2=mysqli_query($query2) or die(mysqli_error());
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                echo "<tr>";
                                                echo "<th>".$year."</th>";
                                                echo "<th>".$month."</th>";
                                                echo "<th>".$num1."</th>";
                                                echo "<th>".$value1."</th>";
                                                echo "<th>".$row2['email']."</th>";
                                                echo "<th>".$row2['firstname']." ".$row2['lastname']."</th>";
                                                echo "</tr>";
                                            }
                                        }


//                                        $result = mysqli_query($query) or die(mysqli_error());
//                                                $num_rows = mysqli_num_rows($result);
//                                                print "Num ".$num_rows;
//                                                echo '<br>';
//                                                while ($row = mysqli_fetch_assoc($result)) {
//                                                    $getpoints[] = $row;
//                                                     //array_push($getpoints, $row);
//
//                                                    if ($row['user_id'] == "5007") {
//                                                        //echo $row['point_date'].' --- '.$row['points'].'<br>';
//                                                    }
//                                                }
//
//
//
//                                        echo "sor1 : " , count($getpoints);
//                                        echo '<br>';
//                                        uasort($getpoints,"orderByPoints");
//                                        $getpoints = super_unique($getpoints,'point_date');
//                                        echo "sor2 : " , count($getpoints);
//                                        echo '<br>';
//
//
////                                        print '<pre>';
////                                        print_r($getpoints);
////                                        print '</pre>';
//
//
//
//                                        foreach ($getpoints as $key1=>$value1)
//                                        {
//
//                                            $totalpoints += $value1['points'];
//                                            $getpoints[$key1]['points']  = $totalpoints;
//
//                                            if ($value1['user_id'] == "5007") {
//                                                //echo $value1['user_id'].' --- '.$value1['points'].'<br>';
//                                            }
//                                            //echo $value1['point_date'].'---'.$value1['user_id'].' '.$value1['points'].'<Br>';
//                                        }
//
//
//
//
//
//                                        echo '<br>';
//                                       // echo $totalpoints;
//                                        //$getpoints = array_reverse($getpoints);
//                                        //$getpoints = super_unique($getpoints,'user_id');
//
//                                        echo $totalpoints;
//
//
//
//
//
//
//
//
//
//                                        foreach ($getpoints as $value)
//                                        {
//                                            $limit++;
//                                            //if ($limit <= 10)
//                                                $pointsArray[] = $value;
//                                        }

                                            //print '<pre>';
											//print_r($pointsArray);
											//print '</pre>';



                                        foreach ($testArray as $pointsValue)
                                        {

//                                            $query2 = "SELECT * FROM  `users`  WHERE `index` = '".$pointsValue['user_id']."'";
//                                            $result2=mysqli_query($query2) or die(mysqli_error());
//                                            $row2 = mysqli_fetch_assoc($result2);
//
//                                            //echo $pointsValue['user_id'];
//
//                                            $query3 = "SELECT * FROM  `daily_points`  WHERE `user_id` = '".$pointsValue['user_id']."' AND  `point_date` LIKE '%".$year."-".$month."-%'";
//                                            $result3=mysqli_query($query3) or die(mysqli_error());
//                                            $num3 = mysqli_num_rows($result3);
										?>
                                        <tr>
											

											
											
											<?
											// H:i:s
											?>
                                            <td align="center" style="text-align:center; direction:rtl; cursor:pointer;"><?= stripslashes($year);?></td>
                                            <td align="center"  style="text-align:center; direction:rtl; cursor:pointer;"><?= stripslashes($HumanMonths[$month]);?></td>
                                            <td align="center"  style="text-align:center; direction:rtl; cursor:pointer;"><?= $num3;?></td>
                                            <td align="center"  style="text-align:center; direction:rtl; cursor:pointer;"><?= stripslashes($pointsValue['points']);?></td>
                                            <td align="center"  style="text-align:center; direction:rtl; cursor:pointer;"><?= stripslashes($row2['email']);?></td>
                                            <td align="center"  style="text-align:right; direction:ltr; cursor:pointer;"><?= stripslashes($row2['firstname']);?> <?= stripslashes($row2['lastname']);?></td>
                                            <td align="center"  style="text-align:center; direction:rtl; cursor:pointer;">
                                            <?
                                            if ($row2['image'])
                                            {
                                                print '<img src="../php/'.$row2['image'].'" style="width:40px; height:40px;">';
                                            }
                                            else
                                            {
                                                print '';
                                            }
                                            ?>
                                            </td>

                                            <td align="center"  style="text-align:center; direction:rtl; cursor:pointer;"><?= $pointsValue['user_id'];?></td>


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


		<form method="post" action="">
		<div class="modal fade" id="bookedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog modal-sm" style="width:500px !important" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titledate" style="direction:rtl;"></h4>
			  </div>
			  <div class="modal-body">

			  
			  
			  <div align="center" id="showQuestions" >
			  <span id="questiontitle" style="color:blue; font-size:25px; font-weight:bold; direction:rtl; text-align:right;">
			  <b>סטיסטיקה חודשית</b>
			  </span>
			  
			  <div style="margin-top:20px;">
			  </div>
			  
			  
			  <table align="center" cellspacing="4" cellpadding="5" style="direction:rtl;">
			  
			  <tr>
			  <th></th>
			  </tr>
			  <tr>
			  <td style="text-align:right;">
			  <span style="font-size:25px; font-weight:bold;">תשובות נכונות: </span>
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
				  <div id="correntmonth" style="font-size:20px; font-weight:bold;">
				  </div>
			  </td>
			  </tr>


			  <tr>
			  <td style="text-align:right;">
			   <span style="font-size:25px; font-weight:bold;">תשובות לא נכונות: </span>
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
				  <div id="wrongmonth" style="font-size:20px; font-weight:bold;">
				  </div>			  
			  </td>
			  </tr>

			  <tr>
			  <td>
			  <span style="font-size:25px; font-weight:bold;">
			  מספר הפעמים שענה במהלך החודש:  &nbsp;
			  </span>
			  </td>
			  <td>
			  <div id="totalmonth" style="font-size:20px; font-weight:bold;"></div>	
			  </td>
			  </tr>

			  </table>
			  </div>
			  		 
			  


				
			  
			  
					<input type="hidden" name="eventdate" id="eventdate" value="">
					<input type="hidden" name="newevent" value="1">
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
			  </div>
			</div>
			
			
		  </div>
		</div>
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

			function showModal(year,month,user)
			{
				$.ajax({
					url: 'get_top_scores.php',
					data: 'year='+year+'&month='+month+'&user='+user,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						console.log (response);
						
						//alert (response);

						$('#correntmonth').html(response.correntmonth);
						$('#wrongmonth').html(response.wrongmonth);
						$('#totalmonth').html(response.totalmonth);
						
					},
					error: function(e){
					//alert ("שגיאה יש לנסות שוב");
					//console.log(e.responseText);
					}
			   });
			   
			   
			   
				$('#bookedModal').modal('show'); 
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