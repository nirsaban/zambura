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




function hebrewDate($value)
{
	if ($value =="Sunday")
	{
		$newvalue = 'יום ראשון';
	}
	else if ($value =="Monday")
	{
		$newvalue = 'יום שני';
	}
	else if ($value =="Tuesday")
	{
		$newvalue = 'יום שלישי';
	}
	else if ($value =="Wednesday")
	{
		$newvalue = 'יום רביעי';
	}
	else if ($value =="Thursday")
	{
		$newvalue = 'יום חמישי';
	}
	else if ($value =="Friday")
	{
		$newvalue = 'יום שישי';
	}
	else if ($value =="Saturday")
	{
		$newvalue = 'יום שבת';
	}	
	
	return $newvalue;
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
		<link rel="stylesheet" href="assets/js/vendor/fullcalendar/fullcalendar.css">
		<link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">
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
                        <a class="brand" href="main.php">
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
				$menu = 'randomquestions';
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
                            <div class="p-15 bg-white" style="min-height: 61px">

                                <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                <a href="new_club.php" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת מועדון חדש</a>

                            </div>
							-->
                            <!-- /left side header -->






                            <!-- left side body -->
                            <div class="p-15 collapse collapse-xs collapse-sm" id="mail-nav">
							
							<!--
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >

									<li style="text-align:right; background-color:#E0E0E0;"><a href="question_catagory.php" style="text-align:right"><i class="fa fa-fw fa-circle text-orange pull-right" style="padding-top:3px;"></i>קטגוריות שאלות</a></li>
									<li style="text-align:right; background-color:#E0E0E0;"><a href="questions.php" style="text-align:right"><i class="fa fa-fw fa-circle text-orange pull-right" style="padding-top:3px;"></i>שאלות</a></li>
									<li style="text-align:right; background-color:#E0E0E0;"><a href="tips.php" style="text-align:right"><i class="fa fa-fw fa-circle text-orange pull-right" style="padding-top:3px;"></i>טיפים</a></li>
									<li style="text-align:right; background-color:#E0E0E0;"><a href="tips_catagory.php" style="text-align:right"><i class="fa fa-fw fa-circle text-orange pull-right" style="padding-top:3px;"></i>קטגוריות דילים</a></li>	
									<li style="text-align:right; background-color:#E0E0E0;"><a href="suppliers.php" style="text-align:right"><i class="fa fa-fw fa-circle text-orange pull-right" style="padding-top:3px;"></i>ספקים</a></li>																		
									<li style="text-align:right; background-color:#E0E0E0;"><a href="deals.php" style="text-align:right"><i class="fa fa-fw fa-circle text-orange pull-right" style="padding-top:3px;"></i>דילים</a></li>
									<li style="text-align:right; background-color:#E0E0E0;"><a href="calander.php" style="text-align:right"><i class="fa fa-fw fa-circle text-red pull-right" style="padding-top:3px;"></i>לוח שנה</a></li>

								</ul>							
						  -->

								
                                <h5 style="direction:rtl;" class="b-b p-10 text-strong">מקרא צבעים</h5>
                                <ul class="nav nav-pills nav-stacked nav-sm" id="mail-labels" >
                                    <li style="text-align:right; direction:rtl;"><a href="javascript:;"><i style="color:#D98880;" class="fa fa-fw fa-circle text-default"></i>שאלה לחיילים</a></li>
                                    <li style="text-align:right; direction:rtl;"><a href="javascript:;"><i style="color:#E6B0AA;" class="fa fa-fw fa-circle text-orange"></i>שאלה לאזרחים</a></li>
                                    <li style="text-align:right; direction:rtl;"><a href="javascript:;"><i style="color:#A93226;" class="fa fa-fw fa-circle text-peter-river"></i>שאלה לכולם</a></li>
                                </ul>
							

							
							
                            </div>
                            <!-- /left side body -->


							    <!--
								<div align="center">
									<button type="button" class="btn btn-sm btn-lightred b-0 br-2 text-strong" data-toggle="modal" data-target=".bs-example-modal-sm">הוספת תור חדש</button>								 
								</div>
                               -->

                           





                        </div>
                        <!-- /left side -->







                        <!-- right side -->
                        <div class="tcol">
                            <!-- tile -->
                            <section class="tile">
							
                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm" style="text-align:right; direction:rtl;">
                                    <h1 class="custom-font" ><strong>השאלה היומית</strong> </h1>
                                </div>
                                <!-- /tile header -->
								
							</section>	
						
                            <!-- right side header 
                            <div class="p-15 bg-white">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-default" id="change-view-today">היום</button>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm" id="change-view-day" >יום</button>
                                        <button class="btn btn-default btn-sm" id="change-view-week">שבוע</button>
                                        <button class="btn btn-default btn-sm" id="change-view-month">חודש</button>
                                    </div>
                                </div>
                            </div>
							-->
							<div style="margin-top:10px;">
							</div>
                            <!-- /right side header -->

							
                            <!-- right side body -->
                            <div class="p-15">

                                <div id='calendar'></div>

                            </div>
                            <!-- /right side body -->
							
						
							
                            <!-- right side body -->
						<div class="col-md-12" style="text-align:right; margin-top:15px; ">
						
						

						<?
						if ($_POST['update'])
						{
						?>
						<div class="alert alert-success" style="direction:rtl;">
							<strong>תור הוזן בהצלחה , לצפיה <a href="review_appointments.php?id=<? print $_GET['id'];?>">לחצ/י כאן</a></strong>
						</div>
						<?
						}
						?>
						<?
						if ($_GET['del'])
						{
						?>
						<div class="alert alert-success" style="direction:rtl;">
							<strong>תור נמחק בהצלחה</strong>
						</div>
						<?
						}
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
			  <div id="questiontitle" style="color:blue; font-size:25px; font-weight:bold; direction:rtl; text-align:right;">
				<b>השאלה היומית</b>
			  </div>
			  
			  <div style="margin-top:20px;">
			  </div>
			  
			  
			  <table align="center" cellspacing="4" cellpadding="5" style="direction:rtl;">
			  
			  <tr>
			  <th></th>
			  </tr>
			  <tr>
			  <td style="text-align:right;">
			  <span style="font-size:25px; font-weight:bold;">ענו נכונה</span>
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
				  <div id="correnttoday" style="font-size:20px; font-weight:bold;">
				  </div>
			  </td>
			  </tr>


			  <tr>
			  <td style="text-align:right;">
			   <span style="font-size:25px; font-weight:bold;">ענו לא נכון</span>
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
				  <div id="wrongtoday" style="font-size:20px; font-weight:bold;">
				  </div>			  
			  </td>
			  </tr>

			  <!--
			  <tr>
			  <td>
			  <span style="font-size:25px; font-weight:bold;">
			  תשובה א ענו:  &nbsp;
			  </span>
			  </td>
			  <td>
			  <div id="one" style="font-size:20px; font-weight:bold;"></div>	
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
			  <span style="font-size:25px; font-weight:bold;">
			  תשובה ב ענו:  &nbsp;
			  </span>
			  </td>
			  <td>
			  <div id="two" style="font-size:20px; font-weight:bold;"></div>	
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
			  <span style="font-size:25px; font-weight:bold;">
			  תשובה ג ענו:  &nbsp;
			  </span>
			  </td>
			  <td>
			  <div id="three" style="font-size:20px; font-weight:bold;"></div>
			  </td>
			  </tr>
			  
			  <tr>
			  <td>
			  <span style="font-size:25px; font-weight:bold;"> 
			  תשובה ד ענו:  &nbsp;
			  </span>
			  </td>
			  <td>
			  <div id="four" style="font-size:20px; font-weight:bold;"></div>		
			  </td>
			  </tr>
			  -->
		  
			  
			  
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

        <script src="assets/js/vendor/fullcalendar/lib/moment.min.js"></script>
        <script src="assets/js/vendor/fullcalendar/lib/jquery-ui.custom.min.js"></script>
        <script src="assets/js/vendor/fullcalendar/fullcalendar.min.js"></script>
        <script src="assets/js/vendor/fullcalendar/lang-all.js"></script>
		
		

		
        <script src="assets/js/vendor/slider/bootstrap-slider.min.js"></script>

        <script src="assets/js/vendor/colorpicker/js/bootstrap-colorpicker.min.js"></script>

        <script src="assets/js/vendor/touchspin/jquery.bootstrap-touchspin.min.js"></script>

        <script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

        <script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

        <script src="assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>

        <script src="assets/js/vendor/summernote/summernote.min.js"></script>
		
		 <script src="assets/js/vendor/parsley/parsley.min.js"></script>



        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
		

			function getQuestions(date,id)
			{
				
				$.ajax({
					url: 'get_random_questions.php',
					data: 'date='+date+'&id='+id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						console.log (response);
						//alert (response.correnttoday);
						//alert (response.correnttoday)
						//alert (response.lengt);
						//if (response.length > 0)
						//{
							if (response.num > 0)
							     $('#questiontitle').html(response.title);
							else
								$('#questiontitle').html("השאלה היומית");
							
							//alert (response.num);
							$('#correnttoday').html(response.correnttoday); 
							$('#wrongtoday').html(response.wrongtoday);
							
							$('#one').html(response.one); 
							$('#two').html(response.two); 
							$('#three').html(response.three); 
							$('#four').html(response.four); 							
						//}
						//else
						//{
						//	$('#questiontitle').html("");
						//}

						
						
					},
					error: function(e){
					//alert ("שגיאה יש לנסות שוב");
					//console.log(e.responseText);
					}
			   });
			}



			
			var currentView = "agendaDay";
			
			
            $(window).load(function(){
                $('#form2Submit').on('click', function(){
                    $('#form2').submit();
                });
				$('#summernote').summernote({
                    height: 200   //set editable area's height
                });
				/*
				 $('#startime').datetimepicker({
	                format: 'HH:mm',
					use24hours: true,
				});				
				*/
				
				
				//$('#external-events').data('event', { title: 'my event' });

			
	
                $('#calendar').fullCalendar({
					/*
					viewDisplay: function(view) {
					  alert('The new title of the view is ' + view.title);

					  // view consist Available views
					  // month, basicWeek,basicDay,agendaWeek,agendaDay
					},
					*/
					
                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
					//lang: 'he',

                    defaultDate: '<?= date("Y-m-d");?>',
					//aspectRatio:9,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar
					slotDuration: '00:10:00',
					defaultTimedEventDuration: '00:20:00',
					height: '500',
					defaultView : 'month',
					/*
					businessHours:
						{

								start: '11:00:00',
								end:   '12:00:00',
								dow: [0, 1, 2, 3, 4, 5,6]
						},					
					*/
					minTime : '09:00:00',
					maxTime : '22:00:00',


					eventRender: function(event, element, view) {
						
						$(element).find(".fc-event-time").remove();					
						
						//$(element).addClass('fc-state-highlight');
					   // if(view.name === 'basicDay') {
						    //element.height(200);
							//$(element).height(500);
					   // }
					},					
					dayClick: function(date, jsEvent, view) {
						//alert (view.name);
					  if(view.name == 'month' || view.name == 'basicWeek') {

					    var droptime = date.format();
						var explode = droptime.split("-");
						//var explodeend = date.end.format().split("-");
						//alert (date.end.format());
						var day = explode[2].substr(0, 2);
						var starttime = explode[2].substr(3,5);
						
						var month = explode[1];
						var year = explode[0];
						var newdate = day+"/"+month+"/"+year;	
						
						
						
						
						  $('#titledate').html('הוספת תאריך '+newdate); 
						  $('#eventdate').val(newdate); 
						  $('#bookedModal').modal('show'); 
						  
						  //if (jsEvent.title)
						  //$('#questiontitle').html(response.title);
						  
						  getQuestions(newdate); 
						  
						  //getTips(newdate); 
						  //getDeals(newdate);
						  

						  currentView = "agendaDay";
						//$('#calendar').fullCalendar('changeView', 'agendaDay');
						//$('#calendar').fullCalendar('gotoDate', date);      
					  }
					},	

				   eventRender: function(event, element,calEvent, jsEvent, view) {
					   //alert (calEvent.id)
					  element.bind('dblclick', function(calEvent) {
						// alert (calEvent.id)
					  });
				   },					
					eventClick: function(calEvent, jsEvent, view) {
						//alert ("clock");
						//alert (calEvent.id);
						//alert (calEvent.eventType);
						//alert (calEvent.eventType);
						console.log("console: ", calEvent)
						console.log("console2: " , jsEvent)
						//alert (calEvent.date);
						
						  $('#titledate').html('הוספת תאריך '+calEvent.date); 
						  $('#eventdate').val(calEvent.date); 
						  $('#bookedModal').modal('show'); 
						  
						  //if (jsEvent.title)
							  //$('#questiontitle').html(calEvent.title);
						  
						  //alert (calEvent.id)
						  getQuestions(calEvent.date,calEvent.id); 
						  //getTips(calEvent.date); 
						  //getDeals(calEvent.date);

						  
						//$('<div class="event-control p-10 mb-10">'+'<a class="pull-right text-muted event-remove"><i class="fa fa-trash-o"></i></a></div>');
						//alert('Event: ' + calEvent.title);
						//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
						//alert('View: ' + view.name);

						// change the border color just for fun
						//$(this).css('border-color', 'red');

					},					
                    eventLimit: true, // allow "more" link when too many events
					eventBackgroundColor : '#16A085',
					eventTextColor : 'white',
					eventBorderColor: 'white',
					
                   events: [

						
						
						//
						
					<?
					
						$query5 = "SELECT * FROM `month_questions`   ORDER BY `index` DESC LIMIT 10";
						$result5=mysqli_query($query5) or die('error connecting'); 
						$num_rows5 = mysqli_num_rows($result5);
						
						while ( $row5 = mysqli_fetch_array($result5))
						{
						    
						    

                                     
                                                        
                            
                            
							$booked = 'false';
							$eventType = 'open';
							
							
							//if ($row5['type'] == 1)
							$eventColor = '#D98880';

							//if ($row5['type'] == 2)
							//$eventColor = '#E6B0AA';

							//if ($row5['type'] == 3)
							//$eventColor = '#A93226';

							
							$explode = explode(" ",$row5['date']);
							$explode2= explode(" ",$explode[0]);
							//$newdate = ''.$explode[2].'-'.$explode[1].'-'.$explode[0].'';
							$newdate = $explode2[0];
							
							//print '<pre>';
							//print_r($newdate);
							//print '</pre>';
							//exit;

							$eventType = 'questions';
							


							$find = array("'", '"');
							$replace   = array("", "");

							$newphrase2 = str_replace($find, $replace, trim($row5['question']));

							
							$questionTitle = stripslashes($newphrase2);
							$questionTitle = mb_substr($questionTitle,0,25);

							
							
					?>
                        {
							id: '<?= $row5['index'];?>',
                            title: "<?= $questionTitle;?>",
							eventType: "<?= $eventType;?>",
                            start: '<?= $newdate;?>T00:00',
                            end: '<?= $newdate;?>T00:00',
                            className: 'b-l b-2x b-lightred',
							editable  : <?= $booked;?>,
							date: '<?= $row5['date'];?>',
							//eventColor: 'blue',
							color : '<?= $eventColor;?>',							
                        },
						<?
						}
						?>
						
						//

						
                    ],
						timeFormat: ' ' // uppercase H for 24-hour clock					
 
                });

                // Hide default header
                //$('.fc-header').hide();



                // Previous month action
                $('#cal-prev').click(function(){
                    $('#calendar').fullCalendar( 'prev' );
                });

                // Next month action
                $('#cal-next').click(function(){
                    $('#calendar').fullCalendar( 'next' );
                });

                // Change to month view
                $('#change-view-month').click(function(){
                    $('#calendar').fullCalendar('changeView', 'month');

                    // safari fix
                    $('#content .main').fadeOut(0, function() {
                        setTimeout( function() {
                            $('#content .main').css({'display':'table'});
                        }, 0);
                    });

                });

                // Change to week view
                $('#change-view-week').click(function(){
					//alert (123);
					//alert("The view's title is " + view.name);
                    $('#calendar').fullCalendar( 'changeView', 'agendaWeek');
					currentView = "agendaWeek";
                    // safari fix
                    $('#content .main').fadeOut(0, function() {
                        setTimeout( function() {
                            $('#content .main').css({'display':'table'});
                        }, 0);
                    });

                });

                // Change to day view
                $('#change-view-day').click(function(){
					
					currentView = "agendaDay";
                    $('#calendar').fullCalendar( 'changeView','agendaDay');

                    // safari fix
                    $('#content .main').fadeOut(0, function() {
                        setTimeout( function() {
                            $('#content .main').css({'display':'table'});
                        }, 0);
                    });

                });

                // Change to today view
                $('#change-view-today').click(function(){
					currentView = "today";
                    $('#calendar').fullCalendar('today');
                });

                /* initialize the external events
                 -----------------------------------------------------------------*/
                $('#external-events .event-control').each(function() {
					//alert (123);

                    // store data so the calendar knows to render an event upon drop
                    $(this).data('event', {
						//duration : '03:00',
						id: $(this).attr('id'),
                        title: $.trim($(this).text()),
						color: $(this).attr("data-color"),	
						eventType: $(this).attr("data-type"),	
						editable : $(this).attr("data-booked"),	
							
						invitedName : $(this).attr("data-name"),	
						//invitedAddress : $(this).attr("data-booked"),	
						invitedPhone : $(this).attr("data-phone"),	
						invitedEmail : $(this).attr("data-email"),	
						invitedDesc : $(this).attr("data-desc"),	
						//eventHour : $(this).attr("data-hour"),	

							
                        stick: false // maintain when user navigates (see docs on the renderEvent method)
                    });

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });

                $('#external-events .event-control .event-remove').on('click', function(){
                  //  $(this).parent().remove();
                });


				
            });
			

			
			function ConfirmDelete(index)
			{
				var confirmbox = confirm("האם לאשר מחיקה?");
				if (confirmbox)
				{
					window.location = "supplier_appointments.php?id=<?= $_GET['id'];?>&page=<?= $_GET['page'];?>&del="+index;
				}
			}	
			
			$('#question_3').on('change', function() {
				
				if ($(this).find(":selected").val() != 0)
				{
					$('#question_1').val(0); 
					$('#question_2').val(0); 
				}
				
			});
			
			$('#tips_3').on('change', function() {
				
				if ($(this).find(":selected").val() != 0)
				{
					$('#tips_1').val(0); 
					$('#tips_2').val(0); 
				}
				
			});			
			
			$('#deal_3').on('change', function() {
				
				if ($(this).find(":selected").val() != 0)
				{
					/*
					$('#deal_1').val(0); 
					$('#deal_2').val(0); 
					*/
				}	
			});				

			
			$('#deal_6').on('change', function() {
				
				if ($(this).find(":selected").val() != 0)
				{
					/*
					$('#deal_4').val(0); 
					$('#deal_5').val(0); 
					*/
				}	
			});		


			$('#deal_7').on('change', function() {
				
				if ($(this).find(":selected").val() != 0)
				{
					/*
					$('#deal_1').val(0); 
					$('#deal_2').val(0); 
					$('#deal_3').val(0); 
					$('#deal_4').val(0); 
					$('#deal_5').val(0); 
					$('#deal_6').val(0); 
					*/
					
				}	
			});	

			$("#showQuestions").click(function(){
				$("#toggleQuestions").toggle();
			});

			$("#showTips").click(function(){
				$("#toggleTips").toggle();
			});

			$("#showDeals").click(function(){
				$("#toggleDeals").toggle();
			});			
			
        </script>
        <!--/ Page Specific Scripts -->






    </body>
</html>

<?
//print '<pre>';
////);
//print '</pre>';
?>