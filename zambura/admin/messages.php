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

$application_id =  "96b66281-ac3d-44e5-834f-e39b3cc98626";


  function sendMessage($appid,$desc,$deviceid,$image)
  {

    
    $fields = array(
      'app_id' => $appid,
	  //'delayed_option' => "timezone",
	  //'delivery_time_of_day' => "2016-05-18 12:50:00 GMT-03:00",
      //'included_segments' => array('All'),
	  'big_picture' => $image,
	  'include_player_ids' => array($deviceid),
	  'data' => array("type" => "newmessage"),
      'contents' => array(
      "en" => $desc
      )
    );
    
    $fields = json_encode($fields, JSON_UNESCAPED_SLASHES);
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
    
    return $response;
  }
  
  
$query = "SELECT * FROM `message_specialist` WHERE `user_id` = '".$_GET['id']."' ORDER BY `index` DESC";
$result = mysqli_query($query) or die('error connecting');                                               
$row = mysqli_fetch_array($result);

$query2 = "SELECT * FROM `users` WHERE `index` = '".$_GET['id']."' ";
$result2 = mysqli_query($query2) or die('error connecting');                                               
$row2 = mysqli_fetch_array($result2);

  



if ($_POST['chattext'])
{
        $sql= "INSERT INTO `message_specialist` (`user_id`,`message`,`type`,`read`)  VALUES ('".addslashes($_GET['id'])."','".addslashes($_POST['chattext'])."','answer','1')";
        $InsertSql = mysqli_query($sql); 
		
		if ($row2['push_id'])
		{
			sendMessage($application_id,"התקבלה הודעה חדשה",$row2['push_id']);
		}
}



    $updateQuery = "UPDATE `message_specialist` 
     SET   
     `read` ='1'
     WHERE `user_id` ='".mysqli_real_escape_string($_GET['id'])."'";
     $update =  mysqli_query($updateQuery) or die(mysqli_error()); 





                        

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
        <link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">



        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->

	<style>
	.tile-body.slim-scroll
	{
		max-height: none !important;
	}
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

                <div class="page page-full page-mail">


                    <div class="tbox tbox-sm">


                        <!-- left side -->
                        <div class="tcol w-md bg-tr-white lt b-r">



                            <!-- left side header
                            <div class="p-15 bg-white" style="min-height: 61px">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="new_club.php" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת מועדון חדש</a>

                            </div>
                            -->
                            <!-- /left side header -->








                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="messagespecialist.php">חזרה לפניה למומחה </a></li>


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








                        </div>
                        <!-- /left side -->







                       <!-- right side -->
                        <div class="tcol">


                    
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

                            </div> -->
                            
                            <!-- /right side header -->
                            
                       <form name="form2" action="" method="post" style="padding:10px;" >
                           
                                
                                   <section class="tile time-simple">


                                                    <!-- tile body -->
                                                    <div class="tile-body">


                                                        <!-- row -->
                                                        <div class="row">

                                                            <!-- col -->
                                                            <div class="col-md-12" style="direction:rtl; text-align:right;">
                                                                <h3 class="text-uppercase text-success mt-0 mb-20">פרטי הודעה</h3>
                                                                <p class="text-default lt">תאריך הודעה אחרונה : <? print date("Y-m-d H:i:s",strtotime($row['date'])) ?></p>
                                                            </div>
                                                            <!-- /col -->



                                                        </div>
                                                        <!-- /row -->

                                                        <!-- row -->
                                                        <div class="row b-t pt-20">

                                                            <!-- col -->
                                                            <div class="col-md-6 b-r" style="direction:rtl;">


                                                            <div class="row" style="direction:rtl; text-align:right; ">
                    

                    
                    
                    
                                                            </div>
															
                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-3 b-r" style="direction:rtl; text-align:right; ">


                                                                

                                                                <!-- col -->
                                                                <div class="col-md-12">

                                                                </div>
                                                                <!-- /col -->

                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-3" style="text-align:right; direction:rtl">

                                                                
                                                            	 <p class="text-uppercase text-strong mb-10 custom-font">פרטי הלקוח</p>
                                                                <ul class="list-unstyled text-default lt mb-20">
                                                                    <li><strong>שם מלא:</strong> <? print stripslashes($row2['firstname']);?> <? print stripslashes($row2['lastname']);?></li>
                                                                    <li><strong>מייל:</strong> <? print stripslashes($row2['email']);?></li>
                                                                </ul>
                                        
                                        
                                                            </div>
                                                            <!-- /col -->

                                                        </div>
                                                        <!-- /row -->
                                                        <div class="row b-t pt-20" style="direction:rtl; text-align:right; ">
                                                            <!-- col -->
                                                           
                                                        </div>

                                                    </div>
                                                    <!-- /tile body -->
                                                <!-- tile footer -->

                                                <!-- /tile footer -->
                                                </section>
                                                
                              <input type="hidden" name="update" value="1">
                              </form>
                                    
                        <!--
                            <div class="col-md-6" style="text-align:right; margin-top:15px; direction:rtl;">
                                <div class="search" id="main-search">
                                    <input type="text" class="form-control underline-input" placeholder="חיפוש...">
                                    <button class="btn btn-rounded btn-success btn-sm" type="submit">חיפוש</button>
                                </div>
                            </div>                  
                        
                    
 <!-- col -->
                       <form method="post" action="" style="padding:10px">
                           
                        <div class="col-md-12">
                            
                            
                            
                            <!-- tile -->
                            <section class="tile widget-chat">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm" style="text-align:right;"> 
                                    <h1 class="custom-font">הודעות</h1>

                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                
                              <!-- tile footer -->
                                <div class="tile-footer">
                                    <div class="chat-form">
                                        <div class="input-group">
                                              <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="fa fa-chevron-left"></i></button>
                                             </span>
											 <textarea rows="4" cols="50" name="chattext" class="form-control" placeholder="מלא/י את הודעתך כאן..." style="direction:rtl;"></textarea>
                                            <!--
											<input type="text" name="chattext" class="form-control" placeholder="מלא/י את הודעתך כאן..." style="direction:rtl;">
											-->
                                        </div>
                                    </div>
                                </div>
                                <!-- /tile footer -->
                                
                                
                                <div class="tile-body slim-scroll" style="max-height: 320px;overflow:auto;">

                                    <ul class="chats p-0">
                             <?
                             $query5 = "SELECT * FROM `message_specialist` WHERE `user_id` = '".$_GET['id']."' ORDER BY `index` ASC";
                            $result5 = mysqli_query($query5) or die('error connecting');                                               
                             while ( $row5 = mysqli_fetch_array($result5))
                              {
								  
								  if ($row5['type'] =="answer") 
								  {
									  $bgcolor = "#e05d6f";
									  $profileimage = "assets/images/admin.jpg";
									  
								  }
								  else
								  {
									  $bgcolor = "#0000ff";
									  if ($row2['image'])
									  {
										  $profileimage = stripslashes($row2['image']);
									  }
									  else
									  {
										  $profileimage = "assets/images/avatar.jpg";
									  }
									  
								  }
                             ?>
                                        <li class="out">
                                            <div class="media" style="">
                                                <div class="pull-right thumb thumb-sm">
                                                    <img class="media-object img-circle" src="<?= $profileimage;?>" alt="">
                                                </div>
                                                <div class="media-body" style=" border-right: 3px solid <?= $bgcolor;?>; direction:rtl !important;">
                                                    <p class="media-heading"><span class="datetime"><? print date("Y-m-d H:i:s",strtotime($row5['date'])) ?></span></p>
                                                    <span class="body" style="direction:rtl !important;"><? print stripslashes($row5['message']);?></span>
                                                </div>
                                            </div>
                                        </li>
                           <?
                           }
                           ?>


                                    </ul>

                                </div>
                                <!-- /tile body -->



                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->
                        </form>

                            <!-- right side body -->



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
                    window.location = "deals.php?del="+index;
                }
            }
            
        </script>
        <!--/ Page Specific Scripts -->





    </body>
</html>
