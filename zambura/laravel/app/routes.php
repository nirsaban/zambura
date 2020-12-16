<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	//return View::make('hello');
});


Route::post('GetQuestions', 'HomeController@GetQuestions');
Route::post('GetQuestionByDate', 'HomeController@GetQuestionByDate');
Route::post('RegisterUser', 'HomeController@RegisterUser');
Route::post('NewRegisterUser', 'HomeController@NewRegisterUser');
Route::post('LoginUser', 'HomeController@LoginUser');
Route::post('NewLoginUser', 'HomeController@NewLoginUser');
Route::post('GetTipByDate', 'HomeController@GetTipByDate');
Route::post('GetDealCategories', 'HomeController@GetDealCategories');
Route::post('GetDealCategoriesNew', 'HomeController@GetDealCategoriesNew');
Route::post('GetDeals', 'HomeController@GetDeals');
Route::post('UploadNewImage', 'HomeController@UploadNewImage');
Route::post('updateProfile', 'HomeController@updateProfile');
Route::post('updateProfileNew', 'HomeController@updateProfileNew');
Route::post('answerQuestion', 'HomeController@answerQuestion');
Route::post('GetAnswers', 'HomeController@GetAnswers');
Route::post('MessageSpecialist', 'HomeController@MessageSpecialist');
Route::post('GetInfoArticles', 'HomeController@GetInfoArticles');
Route::post('GetDealByDate', 'HomeController@GetDealByDate');
Route::post('AddFavDeal', 'HomeController@AddFavDeal');
Route::post('GetUserFav', 'HomeController@GetUserFav');
Route::post('DelFavoriteById', 'HomeController@DelFavoriteById');
Route::post('GetDealsWithLocation', 'HomeController@GetDealsWithLocation');
Route::post('GetGrouponsWithLocations', 'HomeController@GetGrouponsWithLocations');
Route::post('ForgotPassword', 'HomeController@ForgotPassword');
Route::post('LogOutUser', 'HomeController@LogOutUser');
Route::post('GetSpecialistMsg', 'HomeController@GetSpecialistMsg');
Route::post('GetBannersByType', 'HomeController@GetBannersByType');
Route::post('NewGetBannersByType', 'HomeController@NewGetBannersByType');
Route::post('GetPointsPerMonth', 'HomeController@GetPointsPerMonth');
Route::post('GetPointsPerMonth1', 'HomeController@GetPointsPerMonth1');
Route::get('DailyDealCron', 'HomeController@DailyDealCron');
Route::get('DailyReleaseDayCron', 'HomeController@DailyReleaseDayCron');
Route::get('DailyBirthdayCron', 'HomeController@DailyBirthdayCron');
Route::post('CheckUserSeenDeal', 'HomeController@CheckUserSeenDeal');
Route::post('UserSeenDeal', 'HomeController@UserSeenDeal');
Route::post('CheckUserSeenTip', 'HomeController@CheckUserSeenTip');
Route::post('UserSeenTip', 'HomeController@UserSeenTip');
Route::post('CountDealView', 'HomeController@CountDealView');
Route::post('checkBannerType', 'HomeController@checkBannerType');
Route::post('NewGetRandomQuestions', 'HomeController@NewGetRandomQuestions');
Route::post('NewAddUserPoints', 'HomeController@NewAddUserPoints');
Route::post('newGetMonth', 'HomeController@newGetMonth');
Route::post('newGetMonth2', 'HomeController@newGetMonth2');
Route::get('sendFiveQuestions', 'HomeController@sendFiveQuestions');
// Route::get('NewDailyBirthdayCron', 'HomeController@NewDailyBirthdayCron');
// Route::get('tipForSaturday', 'HomeController@tipForSaturday');
Route::get('monthlyCron', 'HomeController@monthlyCron');
Route::post('getLeaders', 'HomeController@getLeaders');
Route::post('updateVersion', 'HomeController@updateVersion');
Route::post('getDriverPopupDate', 'HomeController@getDriverPopupDate');
Route::post('updateDriverPopupDate', 'HomeController@updateDriverPopupDate');
Route::post('checkUser', 'HomeController@checkUser');
Route::post('addShownBanners', 'HomeController@addShownBanners');
Route::get('getTestQuestions', 'HomeController@getTestQuestions');
Route::post('getUser', 'HomeController@getUser');

//new
Route::post('getGamePrizes', 'NewController@getGamePrizes');
Route::post('getUserDailyPoints', 'NewController@getUserDailyPoints');
Route::post('getGameHints', 'NewController@getGameHints');
Route::post('GetRandomQuestionsNew', 'NewController@GetRandomQuestionsNew');
Route::post('getQuestionFeedback', 'NewController@getQuestionFeedback');
Route::post('getRandomBonusQuestions', 'NewController@getRandomBonusQuestions');
Route::post('getSpecialistRecommendation', 'NewController@getSpecialistRecommendation');
Route::post('savePointsNew', 'NewController@savePointsNew');
Route::post('checkUserPlayedMonth', 'NewController@checkUserPlayedMonth');

Route::post('UsersDailyPoints', 'NewController@UsersDailyPoints');
Route::post('UsersMonthlyPoints', 'NewController@UsersMonthlyPoints');
Route::post('UsersMonthlyPoints1', 'NewController@UsersMonthlyPoints1');
Route::post('getCategoriesQuestions', 'NewController@getCategoriesQuestions');
Route::post('GetGrouponsWithLocationsNew', 'NewController@GetGrouponsWithLocationsNew');
Route::post('NewAddUserPointsNew', 'NewController@NewAddUserPointsNew');

Route::post('FirstPrizeBankForm', 'NewController@FirstPrizeBankForm');
Route::post('GetWinnersList', 'NewController@GetWinnersList');
Route::post('GetBanners', 'NewController@GetBanners');
Route::post('GetBannersByTitle', 'NewController@GetBannersByTitle');
Route::post('BannerIdViewClick', 'NewController@BannerIdViewClick');
Route::post('MovieCardWinnerSend', 'NewController@MovieCardWinnerSend');

Route::post('sendTestPush', 'NewController@sendTestPush');
Route::post('updateUserPush', 'NewController@updateUserPush');


//push
Route::get('pushCron1', 'NewController@pushCron1');
Route::get('pushCron2', 'NewController@pushCron2');
Route::get('pushCron3', 'NewController@pushCron3');
Route::get('pushCron4', 'NewController@pushCron4');






