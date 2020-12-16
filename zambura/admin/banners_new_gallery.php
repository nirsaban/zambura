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
	mysqli_query("DELETE FROM `banners_new_gallery` WHERE `id` = '".$_GET['del']."'");
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

        <!-- blueimp Gallery styles -->
        <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <link rel="stylesheet" href="assets/js/vendor/file-upload/css/jquery.fileupload.css">
        <link rel="stylesheet" href="assets/js/vendor/file-upload/css/jquery.fileupload-ui.css">
        <!-- CSS adjustments for browsers with JavaScript disabled -->
        <noscript><link rel="stylesheet" href="assets/js/vendor/file-upload/css/jquery.fileupload-noscript.css"></noscript>
        <noscript><link rel="stylesheet" href="assets/js/vendor/file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>

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
                if ($_GET['android_iphone'] == "0")
                    $menu = 'banners_new_android';
                else
                    $menu = 'banners_new_iphone';

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




                            <?php
                            if ($_GET['android_iphone'] == "0")
                                $redirecturl = 'banners_new_android.php';
                            else
                                 $redirecturl = 'banners_new_iphone.php';


                            ?>



                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">

                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-folders">
                                    <li class="active" style="text-align:right;"><a href="<?= $redirecturl;?>"> חזרה לבאנרים <span class="pull-right badge bg-lightred"><? print $num_rows;?></span></a></li>
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

                            </div>
							
                            <!-- /right side header -->


							
							
						
							
                            <!-- right side body -->
						<div class="col-md-12" style="text-align:right; margin-top:15px; direction:rtl;">

						<?
						if ($_POST['update'])
						{
						?>
						<div class="alert alert-success">
							<strong>ספק עודכן בהצלחה</strong>
						</div>
						<?
						}
						?>
                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong> באנרים (<?= stripslashes($_GET['name']);?>)</strong> </h1>
                                </div>
                                <!-- /tile header -->


								
                              <!-- tile body -->
                              <div class="tile-body">



                                  <!-- The file upload form used as target for the file upload widget -->
                                  <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                                      <!-- Redirect browsers with JavaScript disabled to the origin page -->

                                      <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                      <div class="row fileupload-buttonbar">
                                          <div class="col-lg-7">
                                              <!-- The fileinput-button span is used to style the file input field as button -->
                                              <span class="btn btn-success fileinput-button">
                                                  <i class="glyphicon glyphicon-plus"></i>
                                                  <span>העלאת קבצים...</span>
                                                  <input type="file" name="files[]" multiple>
                                              </span>
 




                                              <!-- The global file processing state -->
                                              <span class="fileupload-process"></span>
                                          </div>
                                          <!-- The global progress state -->
                                          <div class="col-lg-5 fileupload-progress fade">
                                              <!-- The global progress bar -->
                                              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                  <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                              </div>
                                              <!-- The extended global progress state -->
                                              <div class="progress-extended">&nbsp;</div>
                                          </div>
                                      </div>
                                      <!-- The table listing the files available for upload/download -->
                                      <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                  </form>
                                  <br>





                                  <!-- The blueimp Gallery widget -->
                                  <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                      <div class="slides"></div>
                                      <h3 class="title"></h3>
                                      <a class="prev">‹</a>
                                      <a class="next">›</a>
                                      <a class="close">×</a>
                                      <a class="play-pause"></a>
                                      <ol class="indicator"></ol>
                                  </div>

	  <!-- The template to display files available for upload -->
	  <script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
          <td>
            <span class="preview"></span>
          </td>
          <td>
            <p class="name nomargin">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
          </td>
          <td class="upload">
            <div class="progress-list">
              <div class="details">
                <div class="title">&nbsp;</div>
                <div class="description">Upload progress</div>
              </div>
              <div class="status pull-right">
                <span class="animate-number size" data-value="0" data-animation-duration="1500">Processing...</span>
              </div>
              <div class="clearfix"></div>
              <div class="progress progress-striped active progress-xs nomargin" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </div>

          </td>
          <td class="text-right actions">
            {% if (!i && !o.options.autoUpload) { %}
              <button class="btn btn-success start btn-sm" disabled>
                <i class="fa fa-upload"></i>
                <span> Start</span>
              </button>
            {% } %}
            {% if (!i) { %}

            {% } %}
          </td>
        </tr>
      {% } %}
    </script>

	  <!-- The template to display files available for download -->
	  <script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
          <td>
            <span class="preview">
              {% if (file.thumbnailUrl) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
              {% } %}
            </span>
          </td>
          <td>
            <p class="name nomargin">
              {% if (file.url) { %}
                  <a href="{%=file.url%}" class="white" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
              {% } else { %}
                  <span>{%=file.name%}</span>
              {% } %}
            </p>
            {% if (file.error) { %}
              <div><span class="label label-red">Error</span> {%=file.error%}</div>
            {% } %}
          </td>
          <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
          </td>
          <td class="text-right actions">
            {% if (file.deleteUrl) { %}
              <label class="checkbox checkbox-custom-alt checkbox-custom inline-block">
                  <input type="checkbox" id="delete-{%=file.name%}" class="toggle"><i></i>
              </label>
              <button class="btn btn-danger btn-sm delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="fa fa-trash-o"></i>
                <span> Delete</span>
              </button>
            {% } else { %}
              <button class="btn btn-warning btn-sm cancel">
                <i class="fa fa-times"></i>
                <span> Cancel</span>
              </button>
            {% } %}
          </td>
        </tr>
      {% } %}
    </script>
	
<table role="presentation" class="table table-striped"><tbody class="files">
<?php

$query2 = "SELECT * FROM `banners_new_gallery` WHERE  `banner_id` = '".$_GET['id']."'";
$result2 = mysqli_query($query2) or die('error connecting'); 												
while ( $row2 = mysqli_fetch_array($result2))
{
?>
	<tr class="template-download fade in">
          <td>
            <span class="preview">
              
                <a href="<? print $configUrl;?>/uploads/<? print stripslashes($row2['image']);?>" title="<? print stripslashes($row2['image']);?>" download="<? print stripslashes($row2['image']);?>" data-gallery=""><img style="width:100px; height:100px;" src="<? print $configUrl;?>/uploads/<? print stripslashes($row2['image']);?>"></a>
              
            </span>
          </td>
          <td>
            <p class="name nomargin">
              
                  <a href="<? print $configUrl;?>/uploads/<? print stripslashes($row2['image']);?>" class="white" title="<? print stripslashes($row2['image']);?>" download="<? print stripslashes($row2['image']);?>" data-gallery=""><? print stripslashes($row2['image']);?></a>
              
            </p>
            
          </td>

          <td class="text-right actions">
            
              <button class="btn btn-danger btn-sm delete" data-type="DELETE" onClick="ConfirmDelete(<? print $row2['id'];?>)">
                <i class="fa fa-trash-o"></i>
                <span> מחיקה</span>
              </button>
          </td>
        </tr>
<?
}
?>
		</tbody></table>
		
	
	
	
	
                              </div>
                              <!-- /tile body -->

                            </section>
                            <!-- /tile -->

	                    <!-- row -->
    
                    <!-- /row -->

					
							
                        </div>
							  
							  
                              <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>								
								
								
								
                                <!-- /tile body -->

                                <!-- tile footer 
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top" style="background:#fff !important;">
                                    <!-- SUBMIT BUTTON 
                                    <button id="form2Submit" class="btn btn-lightred" type="submit">עדכן</button>
                                </div>
                                <!-- /tile footer -->

                            </section>
                            <!-- /tile -->





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

        <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
        <script src="assets/js/vendor/file-upload/js/vendor/jquery.ui.widget.js"></script>
        <!-- The Templates plugin is included to render the upload/download listings -->
        <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
        <!-- blueimp Gallery script -->
        <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="assets/js/vendor/file-upload/js/jquery.iframe-transport.js"></script>
        <!-- The basic File Upload plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload.js"></script>
        <!-- The File Upload processing plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload-process.js"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload-image.js"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload-audio.js"></script>
        <!-- The File Upload video preview plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload-video.js"></script>
        <!-- The File Upload validation plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload-validate.js"></script>
        <!-- The File Upload user interface plugin -->
        <script src="assets/js/vendor/file-upload/js/jquery.fileupload-ui.js"></script>

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


                /*
                 * jQuery File Upload Plugin JS Example 8.9.1
                 * https://github.com/blueimp/jQuery-File-Upload
                 *
                 * Copyright 2010, Sebastian Tschan
                 * https://blueimp.net
                 *
                 * Licensed under the MIT license:
                 * http://www.opensource.org/licenses/MIT
                 */

                /* global $, window */

                $(function () {
                    'use strict';

                    // Initialize the jQuery File Upload widget:
                    $('#fileupload').fileupload({
                        // Uncomment the following to send cross-domain cookies:
                        //xhrFields: {withCredentials: true},
                        url: 'assets/js/vendor/file-upload/server/php/'
                    });



                    //if (window.location.hostname === 'blueimp.github.io') 
					//{
                        // Demo settings:
                        $('#fileupload').fileupload('option', {
                            url: 'assets/js/vendor/file-upload/server/php/',
                            // Enable image resizing, except for Android and Opera,
                            // which actually support image resizing, but fail to
                            // send Blob objects via XHR requests:
                            disableImageResize: /Android(?!.*Chrome)|Opera/
                                    .test(window.navigator.userAgent),
                            maxFileSize: 5000000,
                            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
							autoUpload : true,
							sequentialUploads : true,
							done: function (e, data) {
								$.each(data.result.files, function (index, file) {
								//console.log(file);
								//console.log(index);
								//alert (file.name);

								$.post("banners_new_gallery_upload.php",
								{
									filename: file.name,
									id: "<?= $_GET['id'];?>",
									//type: "<?= $_GET['type'];?>",
								},
								function(data, status){
									if (status =="success")
									{
										//location.reload();
									}
								});

	
								});		
							},
							stop: function (e) {
							//location.reload();
							}														
                        });
                        // Upload server status check for browsers with CORS support:
                        /*
						if ($.support.cors) 
						{
                            $.ajax({
                                url: '//jquery-file-upload.appspot.com/',
                                type: 'HEAD'
                            }).fail(function () {
                                $('<div class="alert alert-danger"/>')
                                        .text('Upload server currently unavailable - ' +
                                        new Date())
                                        .appendTo('#fileupload');
                            });
                        }
						*/
                    //} 
					
					/*
					else {
                        // Load existing files:
                        $('#fileupload').addClass('fileupload-processing');
                        $.ajax({
                            // Uncomment the following to send cross-domain cookies:
                            //xhrFields: {withCredentials: true},
                            url: 'assets/js/vendor/file-upload/server/php/',
                            dataType: 'json',
                            context: $('#fileupload')[0]
                        }).always(function () {
                            $(this).removeClass('fileupload-processing');
                        }).done(function (result) {
                            $(this).fileupload('option', 'done')
                                    .call(this, $.Event('done'), {result: result});
                        });
                    }
				*/
                });



            });
			
			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "banners_new_gallery.php?del="+index+"&id=<? print $_GET['id'];?>&name=<? print $_GET['name'];?>&android_iphone=<? print $_GET['android_iphone'];?>";
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