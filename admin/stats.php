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

function countUsers($when,$type)
{
	if ($when == "today")
	  $queryWhen = " AND  DAY(`date`) = DAY(CURDATE()) AND MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE())";

	if ($when == "week")
	  $queryWhen = " AND  WEEK(`date`) = WEEK(CURDATE()) AND MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) ";
	

	if ($when == "month")
	  $queryWhen = " AND  MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) ";
	
	
	
	if ($type =="all")
	  $queryType = " ";

	if ($type =="soliders")
	  $queryType = " AND `soldier` = '1' ";

	if ($type =="civilans")
	  $queryType = " AND `soldier` = '0' ";  
	
	
	
	$query1 = "SELECT * FROM `users` WHERE `index` != '' ".$queryType." ".$queryWhen." ";
	$result1 = mysqli_query($query1) or die('error connecting 1');
	$num1 = mysqli_num_rows($result1);
	
	return $num1;
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
				$menu = 'stats';
				include_once('menu.php');
				?>

                <!--/ SIDEBAR Content -->


            </div>
            <!--/ CONTROLS Content -->



            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-dashboard">
					
					<!--
                    <div class="pageheader">

                        <h2>Dashboard <span>// You can place subtitle here</span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> Minovate</a>
                                </li>
                                <li>
                                    <a href="index.html">Dashboard</a>
                                </li>
                            </ul>

                            <div class="page-toolbar">
                                <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                </a>
                            </div>

                        </div>

                    </div>
					-->
					
					

                    <!-- cards row -->
                    <div class="row">

                        <div class="col-md-6">

                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-dutch text-center p-30 tcol">
                                    <i class="fa fa-cutlery fa-3x"></i>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">

                                    <h1 class="m-0">
                                        <? 
                                        $query1 = "SELECT * FROM `questions` WHERE `deleted` = '0' ";
                                        $result1 = mysqli_query($query1) or die('error connecting 1');
                                        $num1 = mysqli_num_rows($result1);

                                        echo $num1;
                                        ?>
                                    </h1>
                                    <span class="text-muted">שאלות</span>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>

                        <div class="col-md-6">

                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-drank text-center p-30 tcol">
                                    <i class="fa fa-star fa-3x"></i>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">

                                    <h1 class="m-0">
                                        <? 
                                        $query2 = "SELECT * FROM `tips` WHERE `deleted` = '0'";
                                        $result2 = mysqli_query($query2) or die('error connecting 2');
                                        $num2 = mysqli_num_rows($result2);

                                        echo $num2;
                                        ?>
                                    </h1>
                                    <span class="text-muted">טיפים</span>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>

                    </div>
                    <!-- /row -->

                    <div class="row">

                        <div class="col-md-4">

                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-warning text-center p-30 tcol">
                                    <i class="fa fa-users fa-3x"></i>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">

                                    <h1 class="m-0">
                                        <? 
                                        $query3 = "SELECT * FROM `suppliers` WHERE `deleted` = '0'";
                                        $result3 = mysqli_query($query3) or die('error connecting 3');
                                        $num3 = mysqli_num_rows($result3);

                                        echo $num3;
                                        ?>
                                    </h1>
                                    <span class="text-muted">ספקים</span>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>

                        <div class="col-md-4">

                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-danger text-center p-30 tcol">
                                    <i class="fa fa-delicious fa-3x"></i>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">

                                    <h1 class="m-0">
                                        <? 
                                         $query4 = "SELECT * FROM `deals` WHERE `deleted` = '0'";
                                         $result4 = mysqli_query($query4) or die('error connecting 4');
                                         $num4 = mysqli_num_rows($result4);

                                        echo $num4;
                                        ?>
                                    </h1>
                                    <span class="text-muted">דילים</span>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>

                        <div class="col-md-4">

                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-cyan text-center p-30 tcol">
                                    <i class="fa fa-money fa-3x"></i>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">

                                    <h1 class="m-0">
                                        <? 
                                        $query5 = "SELECT * FROM `users` WHERE `deleted` = '0'";
                                        $result5 = mysqli_query($query5) or die('error connecting 5');
                                        $num5 = mysqli_num_rows($result5);

                                        echo $num5;
                                        ?>
                                    </h1>
                                    <span class="text-muted">משתמשים</span>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>

                    </div>
                    <!-- /row -->


                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile" fullscreen="isFullscreen02">

                                

                                

                                <!-- tile body -->
                                <div class="tile-body p-0">

                                    <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default panel-transparent">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <span><i class="fa fa-minus text-sm mr-5"></i>משתמשים חדשים היום</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <table class="table table-no-border m-0">
                                                        <tbody>
                                                        <tr>
                                                            <td>כל המשתמשים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('today','all');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>חיילים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('today','soliders');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>אזרחים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('today','civilans');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default panel-transparent">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <span><i class="fa fa-minus text-sm mr-5"></i>משתמשים חדשים השבוע</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    <table class="table table-no-border m-0">
                                                        <tbody>
                                                        <tr>
                                                            <td>כל המשתמשים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('week','all');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>חיילים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('week','soliders');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>אזרחים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('week','civilans');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default panel-transparent">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <span><i class="fa fa-minus text-sm mr-5"></i>משתמשים חדשים החודש</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                <div class="panel-body">
                                                    <table class="table table-no-border m-0">
                                                        <tbody>
                                                        <tr>
                                                            <td>כל המשתמשים</td>
                                                            <td>                                                                
                                                                <? 


                                                                print countUsers('month','all');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>חיילים</td>
                                                            <td>
                                                                <? 


                                                                print countUsers('month','soliders');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>אזרחים</td>
                                                            <td>                                                                
                                                                <? 


                                                                print countUsers('month','civilans');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->


                    </div>
                    <!-- /row -->





                   
                             




                 






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

        <script src="assets/js/vendor/d3/d3.min.js"></script>
        <script src="assets/js/vendor/d3/d3.layout.min.js"></script>

        <script src="assets/js/vendor/rickshaw/rickshaw.min.js"></script>

        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="assets/js/vendor/daterangepicker/moment.min.js"></script>
        <script src="assets/js/vendor/daterangepicker/daterangepicker.js"></script>

        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="assets/js/vendor/flot/jquery.flot.min.js"></script>
        <script src="assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
        <script src="assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>

        <script src="assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>

        <script src="assets/js/vendor/raphael/raphael-min.js"></script>
        <script src="assets/js/vendor/morris/morris.min.js"></script>

        <script src="assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>

        <script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

        <script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

        <script src="assets/js/vendor/summernote/summernote.min.js"></script>

        <script src="assets/js/vendor/coolclock/coolclock.js"></script>
        <script src="assets/js/vendor/coolclock/excanvas.js"></script>
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
                // Initialize Statistics chart
                var data = [{
                    data: [[1,15],[2,40],[3,35],[4,39],[5,42],[6,50],[7,46],[8,49],[9,59],[10,60],[11,58],[12,74]],
                    label: 'Unique Visits',
                    points: {
                        show: true,
                        radius: 4
                    },
                    splines: {
                        show: true,
                        tension: 0.45,
                        lineWidth: 4,
                        fill: 0
                    }
                }, {
                    data: [[1,50],[2,80],[3,90],[4,85],[5,99],[6,125],[7,114],[8,96],[9,130],[10,145],[11,139],[12,160]],
                    label: 'Page Views',
                    bars: {
                        show: true,
                        barWidth: 0.6,
                        lineWidth: 0,
                        fillColor: { colors: [{ opacity: 0.3 }, { opacity: 0.8}] }
                    }
                }];

                var options = {
                    colors: ['#e05d6f','#61c8b8'],
                    series: {
                        shadowSize: 0
                    },
                    legend: {
                        backgroundOpacity: 0,
                        margin: -7,
                        position: 'ne',
                        noColumns: 2
                    },
                    xaxis: {
                        tickLength: 0,
                        font: {
                            color: '#fff'
                        },
                        position: 'bottom',
                        ticks: [
                            [ 1, 'JAN' ], [ 2, 'FEB' ], [ 3, 'MAR' ], [ 4, 'APR' ], [ 5, 'MAY' ], [ 6, 'JUN' ], [ 7, 'JUL' ], [ 8, 'AUG' ], [ 9, 'SEP' ], [ 10, 'OCT' ], [ 11, 'NOV' ], [ 12, 'DEC' ]
                        ]
                    },
                    yaxis: {
                        tickLength: 0,
                        font: {
                            color: '#fff'
                        }
                    },
                    grid: {
                        borderWidth: {
                            top: 0,
                            right: 0,
                            bottom: 1,
                            left: 1
                        },
                        borderColor: 'rgba(255,255,255,.3)',
                        margin:0,
                        minBorderMargin:0,
                        labelMargin:20,
                        hoverable: true,
                        clickable: true,
                        mouseActiveRadius:6
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: '%s: %y',
                        defaultTheme: false,
                        shifts: {
                            x: 0,
                            y: 20
                        }
                    }
                };

                var plot = $.plot($("#statistics-chart"), data, options);

                $(window).resize(function() {
                    // redraw the graph in the correctly sized div
                    plot.resize();
                    plot.setupGrid();
                    plot.draw();
                });
                // * Initialize Statistics chart

                //Initialize morris chart
                Morris.Donut({
                    element: 'browser-usage',
                    data: [
                        {label: 'Chrome', value: 25, color: '#00a3d8'},
                        {label: 'Safari', value: 20, color: '#2fbbe8'},
                        {label: 'Firefox', value: 15, color: '#72cae7'},
                        {label: 'Opera', value: 5, color: '#d9544f'},
                        {label: 'Internet Explorer', value: 10, color: '#ffc100'},
                        {label: 'Other', value: 25, color: '#1693A5'}
                    ],
                    resize: true
                });
                //*Initialize morris chart


                // Initialize owl carousels
                $('#todo-carousel, #feed-carousel, #notes-carousel').owlCarousel({
                    autoPlay: 5000,
                    stopOnHover: true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    singleItem : true,
                    responsive: true
                });

                $('#appointments-carousel').owlCarousel({
                    autoPlay: 5000,
                    stopOnHover: true,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    navigation: true,
                    navigationText : ['<i class=\'fa fa-chevron-left\'></i>','<i class=\'fa fa-chevron-right\'></i>'],
                    singleItem : true
                });
                //* Initialize owl carousels


                // Initialize rickshaw chart
                var graph;

                var seriesData = [ [], []];
                var random = new Rickshaw.Fixtures.RandomData(50);

                for (var i = 0; i < 50; i++) {
                    random.addData(seriesData);
                }

                graph = new Rickshaw.Graph( {
                    element: document.querySelector("#realtime-rickshaw"),
                    renderer: 'area',
                    height: 133,
                    series: [{
                        name: 'Series 1',
                        color: 'steelblue',
                        data: seriesData[0]
                    }, {
                        name: 'Series 2',
                        color: 'lightblue',
                        data: seriesData[1]
                    }]
                });

                var hoverDetail = new Rickshaw.Graph.HoverDetail( {
                    graph: graph,
                });

                graph.render();

                setInterval( function() {
                    random.removeData(seriesData);
                    random.addData(seriesData);
                    graph.update();

                },1000);
                //* Initialize rickshaw chart

                //Initialize mini calendar datepicker
                $('#mini-calendar').datetimepicker({
                    inline: true
                });
                //*Initialize mini calendar datepicker


                //todo's
                $('.widget-todo .todo-list li .checkbox').on('change', function() {
                    var todo = $(this).parents('li');

                    if (todo.hasClass('completed')) {
                        todo.removeClass('completed');
                    } else {
                        todo.addClass('completed');
                    }
                });
                //* todo's


                //initialize datatable
                $('#project-progress').DataTable({
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                });
                //*initialize datatable

                //load wysiwyg editor
                $('#summernote').summernote({
                    toolbar: [
                        //['style', ['style']], // no style button
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        //['insert', ['picture', 'link']], // no insert buttons
                        //['table', ['table']], // no table button
                        //['help', ['help']] //no help button
                    ],
                    height: 143   //set editable area's height
                });
                //*load wysiwyg editor
            });
        </script>
        <!--/ Page Specific Scripts -->



    </body>
</html>
