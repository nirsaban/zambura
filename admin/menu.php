<?
$query90 = "SELECT  `read` FROM `message_specialist` WHERE `type` = 'question' AND  `read` = '0' ";
$result90 = mysqli_query($query90) or die(mysqli_error()); 
$num_rows90 = mysqli_num_rows($result90);

if ($num_rows90 > 0)
	$newMessagesCount = '<span class="badge bg-lightred">'.$num_rows90.'</span>';
else
    $newMessagesCount = '';
    

    $query91 = "SELECT  `is_seen` FROM `first_prize_winner_bank` WHERE   `is_seen` = '0' ";
    $result91 = mysqli_query($query91) or die(mysqli_error()); 
    $num_rows91 = mysqli_num_rows($result91);
    
    if ($num_rows91 > 0)
        $unreadBank = '<span class="badge bg-lightred">'.$num_rows91.'</span>';
    else
        $unreadBank = '';
        
    
        $query92 = "SELECT  `is_read` FROM `second_price_winners` WHERE   `is_read` = '0' ";
        $result92 = mysqli_query($query92) or die(mysqli_error()); 
        $num_rows92 = mysqli_num_rows($result92);
        
        if ($num_rows92 > 0)
            $second_price_winners = '<span class="badge bg-lightred">'.$num_rows92.'</span>';
        else
            $second_price_winners = '';
            
    

?>
                <aside id="sidebar">


                    <div id="sidebar-wrap">

                        <div class="panel-group slim-scroll" role="tablist">
                            <div class="panel panel-default">
                         
                                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">


                                        <!-- ===================================================
                                        ================= NAVIGATION Content ===================
                                        ==================================================== -->
										
										<!--
										active open
										-->
										
                                        <ul id="navigation">
<!--
<span class="badge bg-lightred">44</span></span> <i class="fa fa-question"></i>
-->
										

                                            <li class="<?if ($menu =="questions") { print 'active open'; } ?>" >
                                                <a role="button" tabindex="0"><i class="fa fa-question"></i> <span>שאלות</span> </a>
                                                <ul>


                                                            <?php
                                                            $query5 = "SELECT * FROM `question_categories`  WHERE `deleted` = '0' ORDER BY `title` ASC ";
                                                            $result5=mysqli_query($query5) or die('error connecting55');

                                                            if ($menu == "questions")
                                                                $activeclass = "active";
                                                            else
                                                                $activeclass = "";

                                                            while ( $row5 = mysqli_fetch_array($result5) ) {


                                                                $query2 = "SELECT * FROM `questions`   WHERE `category_id` = '".$row5['index']."'  ";
                                                                $result2=mysqli_query($query2) or die('error connecting55');
                                                                $num_rows2 = mysqli_num_rows($result2);

                                                                print '<li class="'.$activeclass.'"><a href="questions.php?cat='.$row5['index'].'"><i class="fa fa-caret-right"></i> '.stripslashes($row5['title']).' <span class="badge bg-lightred">'.$num_rows2.'</span></span> </a></li>';


                                                                  }
                                                               ?>

                                                        </ul>
                                                    </li>

                                            <li class="<?if ($submenu =="general") { print 'active open'; } ?>" >
                                                <a role="button" tabindex="0"><i class="fa fa-cog"></i> <span>ניהול</span> </a>
                                                <ul>
                                                        <li style="text-align:right;" class="<?if ($menu =="question_catagory") { print 'active'; } ?>"><a href="question_catagory.php"><span>קטגוריות שאלות </span><i class="fa fa-info-circle"></i> </a></li>
                                                         <li style="text-align:right;" class="<?if ($menu =="question_clues") { print 'active'; } ?>"><a href="question_clues.php"><span>רמזים לשאלות </span><i class="fa fa-info-circle"></i> </a></li>
                                                         <li style="text-align:right;" class="<?if ($menu =="game_prizes") { print 'active'; } ?>"><a href="game_prizes.php"><span>פרסים </span><i class="fa fa-info-circle"></i> </a></li>
                                                         <li style="text-align:right;" class="<?if ($menu =="specialist_recommendation") { print 'active'; } ?>"><a href="specialist_recommendation.php"><span>המלצת המומחה  </span><i class="fa fa-info-circle"></i> </a></li>
                                                         <li style="text-align:right;" class="<?if ($menu =="questions_motivation") { print 'active'; } ?>"><a href="questions_motivation.php"><span>הודעות פרגון  </span><i class="fa fa-info-circle"></i> </a></li>


                                                    <li style="text-align:right;" class="<?if ($menu =="tips") { print 'active'; } ?>"><a href="tips.php"><span>טיפים </span><i class="fa fa-info-circle"></i> </a></li>
                                                        <li style="text-align:right;" class="<?if ($menu =="tips_catagory") { print 'active'; } ?>"><a href="tips_catagory.php"><span>קטגוריות דילים </span><i class="fa fa-info-circle"></i> </a></li>
                                                        <li style="text-align:right;" class="<?if ($menu =="suppliers") { print 'active'; } ?>"><a href="suppliers.php"><span>ספקים </span><i class="fa fa-info-circle"></i> </a></li>
                                                        <li style="text-align:right;" class="<?if ($menu =="deals") { print 'active'; } ?>"><a href="deals.php"><span>דילים </span><i class="fa fa-info-circle"></i> </a></li>
                                                        <li style="text-align:right;" class="<?if ($menu =="calander") { print 'active'; } ?>"><a href="calander.php"><span>לוח שנה </span><i class="fa fa-info-circle"></i> </a></li>
                                              </ul>
                                            </li>

                                            <li style="text-align:right;" class="<? if ($menu =="information") { print 'active'; } ?>"><a href="information.php"> <span>מידע שימושי </span><i class="fa fa-info-circle"></i> </a></li>
 											<li style="text-align:right;" class="<? if ($menu =="deals") { print 'active'; } ?>"><a href="dealsbycat.php"> <span>דילים לפי ספק </span><i class="fa fa-gift"></i> </a></li>

<!--                                            <li style="text-align:right;" class="--><?// if ($menu =="catalog_categories") { print 'active'; } ?><!--"><a href="catalog_categories.php"> <span>קטגוריות לקטלוג </span><i class="fa fa-list"></i> </a></li>-->

                                            <li style="text-align:right;" class="<? if ($menu =="banners") { print 'active'; } ?>"><a href="banners.php"> <span>ניהול באנרים </span><i class="fa fa-picture-o"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="banners_new_android") { print 'active'; } ?>"><a href="banners_new_android.php"> <span>ניהול באנרים אנדרואיד </span><i class="fa fa-picture-o"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="banners_new_iphone") { print 'active'; } ?>"><a href="banners_new_iphone.php"> <span>ניהול באנרים אייפון </span><i class="fa fa-picture-o"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="banners_new_stats") { print 'active'; } ?>"><a href="banners_new_stats.php"> <span>סטיסטיקות באנרים </span><i class="fa fa-bar-chart"></i> </a></li>


                                            <li style="text-align:right;" class="<? if ($menu =="messagespecialist") { print 'active'; } ?>"><a href="messagespecialist.php">  <span>פניה למומחה <?= $newMessagesCount;?> </span>  <i class="fa fa-comment"></i> </a></li>


                                            <li style="text-align:right;" class="<? if ($menu =="daily_winners") { print 'active'; } ?>"><a href="daily_winners.php">  <span>זוכים יומיים  </span>  <i class="fa fa-trophy"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="first_prize_winner_bank") { print 'active'; } ?>"><a href="first_prize_winner_bank.php">  <span>פרטי בנק  <?= $unreadBank;?></span>  <i class="fa fa-list"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="second_price_winners") { print 'active'; } ?>"><a href="second_price_winners.php">  <span>זכיה בשאלת בונוס  <?= $second_price_winners;?></span>  <i class="fa fa-list"></i> </a></li>


                                            <li style="text-align:right;" class="<? if ($menu =="points_date") { print 'active'; } ?>"><a href="points_date.php">  <span>ניקוד לפי תאריך  </span>  <i class="fa fa-list"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="daily_bonus") { print 'active'; } ?>"><a href="daily_bonus.php">  <span>ענו על שאלת בונוס  </span>  <i class="fa fa-list"></i> </a></li>


                                            <li style="text-align:right;" class="<? if ($menu =="push") { print 'active'; } ?>"><a href="push.php?type=1"> <span>שליחת הודעות </span><i class="fa fa-comment-o"></i> </a></li>
											
 											<li style="text-align:right;" class="<? if ($menu =="push_new") { print 'active'; } ?>"><a href="push_new.php"> <span>שליחת הודעות לנרשמים חדשים </span><i class="fa fa-comment-o"></i> </a></li>

                                            <li style="text-align:right;" class="<? if ($menu =="users") { print 'active'; } ?>"><a href="users.php"> <span>משתמשים </span><i class="fa fa-users"></i> </a></li>

 											<li style="text-align:right;" class="<? if ($menu =="topscores") { print 'active'; } ?>"><a href="topscores.php?year=<?= date("Y");?>"> <span>לוח תוצאות </span><i class="fa fa-trophy"></i> </a></li>
											
											 <li style="text-align:right;" class="<? if ($menu =="dailyquestion") { print 'active'; } ?>"><a href="dailyquestion.php"> <span>השאלה היומית </span><i class="fa fa-info-circle"></i> </a></li>
											 <li style="text-align:right;" class="<? if ($menu =="randomquestions") { print 'active'; } ?>"><a href="randomquestions.php"> <span>שאלות שהוגרלו </span><i class="fa fa-info-circle"></i> </a></li>

											 <li style="text-align:right;" class="<? if ($menu =="partnercode") { print 'active'; } ?>"><a href="partnercode.php"> <span>משתמשים שהוזמנו </span><i class="fa fa-users"></i> </a></li>
											 <li style="text-align:right;" class="<? if ($menu =="newusers") { print 'active'; } ?>"><a href="newusers.php"> <span>משתמשים בגרסה החדשה </span><i class="fa fa-users"></i> </a></li>
											 <li style="text-align:right;" class="<? if ($menu =="todayusers") { print 'active'; } ?>"><a href="todayusers.php"> <span>הרשמות משתמשים לפי תאריך </span><i class="fa fa-users"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="monthusers") { print 'active'; } ?>"><a href="monthusers.php"> <span>הרשמות משתמשים החודש </span><i class="fa fa-users"></i> </a></li>
                                            <li style="text-align:right;" class="<? if ($menu =="ageusers") { print 'active'; } ?>"><a href="ageusers.php"> <span>הרשמות לפי גיל </span><i class="fa fa-users"></i> </a></li>

											 <li style="text-align:right;" class="<? if ($menu =="gascompanies") { print 'active'; } ?>"><a href="gas_station_catagories.php"> <span>חברות דלק </span><i class="fa fa-car"></i> </a></li>
											 


											 <li style="text-align:right;" class="<? if ($menu =="landingpage") { print 'active'; } ?>"><a href="landingpage.php"> <span>הרשמות דף נחיתה </span><i class="fa fa-users"></i> </a></li>
	
											<!--
											 <li style="text-align:right;" class="<? if ($menu =="managedays") { print 'active'; } ?>"><a href="managedays.php"> <span>ימי השנה </span><i class="fa fa-calendar"></i> </a></li>
											-->
                                            <li style="text-align:right;" class="<? if ($menu =="push_logs") { print 'active'; } ?>"><a href="push_logs.php"> <span>לוגים פוש </span><i class="fa fa-list"></i> </a></li>

                                            <li style="text-align:right;" class="<? if ($menu =="stats") { print 'active'; } ?>"><a href="stats.php"> <span>סטיסטיקות </span><i class="fa fa-bar-chart"></i> </a></li>
											
											<!--
 											<li style="text-align:right;" class="<? if ($menu =="settings") { print 'active'; } ?>"><a href="settings.php"> <span>הגדרות אפליקציה </span><i class="fa fa-cog"></i> </a></li>
											-->
											
                                        </ul>
                                    
                                        <!--/ NAVIGATION Content -->
                                        
                                        
                                    </div>
                                </div>
                            </div>
							
                        </div>

                    </div>


                </aside>