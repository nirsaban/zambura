<?php

session_start();

include_once('../php/db.php');
include_once('config.php');

if ($_GET['logout'])
{
	unset($_SESSION['admin']);
}

if ($_POST['send'])
{
   
	if ($_POST['username'] == "zambura" && $_POST['password'] =="zambura0544647875")
	{
		$_SESSION['admin'] = 1;
		//$_SESSION['language'] = $_POST['language'];
		//die($_SESSION['admin']);
		header('Location: question_catagory.php');
	}
	else
	{
		$error = 1;
	}
	/*
	$query = "SELECT * FROM `admin` WHERE `username` = '".$_POST['username']."' AND `password` = '".$_POST['password']."'  ORDER BY `index` DESC";
	$result=mysqli_query($query) or die('error connecting11'); 
	$row = mysqli_fetch_array($result);
	$num_rows = mysqli_num_rows($result);
	
	if ($num_rows == 0)
	{
		$error = 1;
	}
	else
	{
		$_SESSION['admin'] = $row['index'];
		//$_SESSION['language'] = $_POST['language'];
		header('Location: catagories.php');

	}
	*/
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
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
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




            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">ZAMBURA </span></h3></div>

                <div class="container w-420 p-15 bg-white mt-40 text-center">

				<?
				if ($_POST['send'] && $error = 1)
				{
				?>
				<div class="alert alert-big alert-lightred alert-dismissable fade in">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					<h4>שגיאה</h4>
					<p>שם משתמש או סיסמה שגוים יש לנסות שוב</p>
                </div>				
				<?
				}
				?>


                    <h2 class="text-light text-greensea">התחברות</h2>

                    <form name="form2" id="form2" class="form-validation mt-20" action="" method="post" data-parsley-validate>

                        <div class="form-group">
                            <input type="text" name="username" style="direction:rtl;" class="form-control underline-input" placeholder="שם משתמש" data-parsley-error-message="יש להזין שם משתמש" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" style="direction:rtl;" placeholder="סיסמה" class="form-control underline-input" data-parsley-error-message="יש להזין סיסמה" required>
                        </div>



						
                        <div class="form-group text-center mt-20">
						<input type="button" id="form2Submit" class="btn btn-greensea b-0 br-2 mr-5" value="כניסה"> 
							<!--
                            <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                                <input type="checkbox" data-required="true" data-parsley-checkmin="1"  id="chkSelect" data-parsley-error-message="יש לאשר תקנון" required><i></i> הנני מאשר את התקנון
                            </label>
							-->
							<!--
                            <a href="forgotpass.html" class="pull-right mt-10">Forgot Password?</a>
							-->
                        </div>
					<input type="hidden" value="1" name="send">
                    </form>
<!--
                    <hr class="b-3x">

                    <div class="social-login text-left">

                        <ul class="pull-right list-unstyled list-inline">
                            <li class="p-0">
                                <a class="btn btn-sm btn-primary b-0 btn-rounded-20" href="javascript:;"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="p-0">
                                <a class="btn btn-sm btn-info b-0 btn-rounded-20" href="javascript:;"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="p-0">
                                <a class="btn btn-sm btn-lightred b-0 btn-rounded-20" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li class="p-0">
                                <a class="btn btn-sm btn-primary b-0 btn-rounded-20" href="javascript:;"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>

                        <h5>Or login with</h5>

                    </div>
<!--
                    <div class="bg-slategray lt wrap-reset mt-40">
                        <p class="m-0">
                            <a href="signup.html" class="text-uppercase">Create an account</a>
                        </p>
                    </div>
-->
                </div>

            </div>



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

        <script src="assets/js/vendor/parsley/parsley.min.js"></script>
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
					
					var isChecked = $('#chkSelect').is(':checked');
					//alert (isChecked)
					
                    $('#form2').submit();
                });

            });
        </script>
        <!--/ Page Specific Scripts -->



	<?
	//print_r($_POST);
	?>



    </body>
</html>
