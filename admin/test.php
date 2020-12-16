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

if ($_POST['catindex'] == "0")
{
	$sql= "INSERT INTO `question_categories` (`title`)  VALUES ('".addslashes($_POST['cattitle'])."')";
	$InsertSql = mysqli_query($sql,$con);	
}

if ($_POST['updatenew'])
{
	if ($_POST['catindex'] !="0")
	{
		$updateQuery = "UPDATE `question_categories` 
		SET 
		`title` ='".addslashes($_POST['cattitle'])."'
		WHERE `index` ='".mysql_real_escape_string($_POST['catindex'])."'";
		$update =  mysqli_query($updateQuery,$con) or die(mysqli_error($con));  
	}	
}




/*
if ($_POST['catindex'] == "0")
{
	$sql= "INSERT INTO `navigation` (`catagory`,`area`,`building_name_signing`,`building_name`,`devision`,`floor`)  VALUES ('".addslashes($_POST['cattitle'])."','".addslashes($_POST['catarea'])."','".addslashes($_POST['catbuilding'])."','".addslashes($_POST['catbuildname'])."','".addslashes($_POST['catdev'])."','".addslashes($_POST['catfloor'])."')";
	$InsertSql = mysql_query($sql);		
}

if ($_POST['catindex'] !="0")
{
	$updateQuery = "UPDATE `navigation`
	SET  
	`catagory` ='".addslashes($_POST['cattitle'])."',
	`area` ='".addslashes($_POST['catarea'])."',
	`building_name_signing` ='".addslashes($_POST['catbuilding'])."',
	`building_name` ='".addslashes($_POST['catbuildname'])."',
	`devision` ='".addslashes($_POST['catdev'])."',
	`floor` ='".addslashes($_POST['catfloor'])."'
	
	
	WHERE `index` ='".mysql_real_escape_string($_POST['catindex'])."'";
	$update =  mysql_query($updateQuery) or die(mysql_error()); 	
}
*/


if ($_GET['del'])
{
	$updateQuery = "UPDATE `question_categories`
	SET  
	`deleted` ='1'

	WHERE `index` ='".mysql_real_escape_string($_GET['del'])."'";
	$update =  mysql_query($updateQuery) or die(mysql_error()); 

	
	//$sql = "DELETE FROM `contacts` WHERE `index` = '".$_GET['del']."'";
	//$del = mysql_query($sql);	

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
     <!-- <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css"> -->
        <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
         <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
         <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="assets/css/main.css"> -->
         <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>
 <body id="minovate" class="appWrapper">


<div id="wrap" class="animsition">


    <section id="header">
        <header class="clearfix">

         
            <div class="branding">
                <a class="brand" href="index.php">
                    <span><strong>ZAMBURA </strong></span>
                </a>
                <a href="#" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
            </div>
    
            <ul class="nav-right pull-right list-inline">
            

                
                

                <li class="dropdown nav-profile">
                    
                    <a href class="dropdown-toggle" data-toggle="dropdown">
                    
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
                
            </ul>
        



        </header>

    </section>
    <div id="controls">






</div>
<section id="content">

<div class="page page-full page-calendar">


    <div class="tbox tbox-sm">
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
                        <div class="col-md-12" style="text-align:right; margin-top:15px; ">

					

								
							
<!-- tile -->
<section class="tile">



    <div class="tile-body">

<!-- tile -->


<!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">

        <h1 class="custom-font"><strong>קטגוריות שאלות </strong></h1>

    </div>
    <div class="tile-body p-0">
								
                              <!-- tile body -->
                                <div class="tile-body">
                              <div class="table-responsive">
                                        <table class="table table hover" id="basic-usage2" style="width:100%" align="center">
                                            <thead>
                                            <tr>
                     <th  style="text-align:right; width:30%" class="no-sort">אפשריות</th>
                     <th  style="text-align:center; width:30%">כמות שאלות</th>
                     <th  style="text-align:center; width:30%">כותרת</th>
					<th  style="width:5%">Id</th>
					
                 </tr>
                 </thead>
             <tbody>
			<?php
				$i = 0;
				$query = "SELECT * FROM `question_categories`  WHERE `deleted` = '0' ORDER BY `title` ASC";
				$result=mysqli_query($query,$con) or die('error connecting55'); 
				$num_rows = mysqli_num_rows($result);
				
				while ( $row = mysqli_fetch_array($result) )
				{
				$i++;

                     $query2 = "SELECT * FROM `questions`   WHERE `category_id` = '".$row['index']."'  ";
                     $result2=mysqli_query($query2,$con) or die('error connecting55');
                     $num_rows2 = mysqli_num_rows($result2);
					
                 
			?>
             <tr>
			
                 <td class="actions">
													<button  onClick="ConfirmDelete('<?= $row['index'];?>')"  class="btn btn-info btn-rounded btn-icon-only btn-ef btn-ef-7 btn-ef-7g mb-10"><i class="fa fa-trash"></i> Add <i class="after fa fa-plus"></i></button>
													<button  onClick="editCatagory('<?= $row['index'];?>','עריכת קטגוריה')" data-toggle="modal" data-target="#tipmodal" data-options="splash-2 splash-ef-9"  class="btn btn-info btn-rounded btn-icon-only btn-ef btn-ef-7 btn-ef-7g mb-10"><i class="fa fa-pencil"></i> Add <i class="after fa fa-plus"></i></button>
											</td>
                                            <td align="center" >
<!--                                                <a style="" href="questions_by_category.php?id=--><?//= $row['index'];?><!--">-->
                                                    <?= $num_rows2;?>
<!--                                                </a>-->
                                            </td>
                                            <td align="center" ><?= stripslashes($row['title']);?></td>

                                            <td align="center" ><?= $row['index'];?></td>

                                        </tr>
										
											<input type="hidden" id="dbtitle_<?= $row['index'];?>" name="dbtitle_<?= $row['index'];?>" value='<?= stripslashes($row['title']);?>'>
										<?php
										}
										?>										
											

                                        </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="p-15 bg-white" style="min-height: 61px; text-align:center;">

                                    <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" data-toggle="collapse" data-target="#mail-nav" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
                                    <a href="#"  onClick="addCatagory(0,'','הוספת קטגוריה')" data-toggle="modal" data-target="#tipmodal" data-options="splash-2 splash-ef-9" class="btn btn-sm btn-lightred b-0 br-2 text-strong">הוספת קטגוריה</a>

                                </div>
                                </div>

<!-- /right side body -->

</div>
<!-- /right side -->

</div>



</div>

</section>

</div>
        <!--/ Application Content -->


        <!-- Splash Modal -->
        <form method="post" action="" enctype="multipart/form-data" data-parsley-validate>
        <div class="modal splash fade" id="tipmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
										<label for="exampleInputEmail1">קטגוריה:</label>
										<input type="text" class="form-control" value='' name="cattitle" id="cattitle" placeholder="שם קטגוריה">
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
        <input type="hidden" value="0" name="catindex" id="catindex">
		<input type="hidden" value="1" name="updatenew" id="updatenew">
        </form>




        <!-- Splash Modal -->
        <form method="post" action="" enctype="multipart/form-data" data-parsley-validate>
        <div class="modal splash fade" id="adddate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font" id="modaltitle">הוספת תאריך</h3>
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
													<option value="1" >חיילים</option>
												    <option value="2" >אזרחים</option> 
												    <option value="3" >כולם</option> 
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
        <input type="hidden" value="0" name="tipid" id="tipid">
        </form>


    
</body>
</html>