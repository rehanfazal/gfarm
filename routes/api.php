<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('mobilesignup', 'Api\MobileController@mobileSignUp');
Route::post('mobilelogin', 'Api\MobileController@mobilelogin');
Route::post('mobileloginforuser', 'Api\MobileController@mobileloginForUser');
Route::post('mobileloginguest', 'Api\MobileController@mobileloginForGuest');
Route::post('mobilelogout', 'Api\MobileController@mobilelogout');
Route::post('mobileusers', 'Api\MobileController@mobileUsers');
Route::post('useraccountactive', 'Api\MobileController@userAccountActive');
Route::post('useraccountunactive', 'Api\MobileController@userAccountUnActive');
Route::post('emailverify', 'Api\MobileController@otpConfirmViaEmail');

/* Change/Reset Password */
Route::post('forgotpassword', 'Api\MobileController@forgetPassword');
Route::post('forgotpasswordotp', 'Api\MobileController@matchforgotpasswordCode');
Route::post('newpassword', 'Api\MobileController@newPassword');

/* User Ratings */
Route::post('checkusername','Api\MobileController@checkUsername');
Route::post('getuserinfo','Api\MobileController@getUserData');

Route::post('updateuserinfo','Api\MobileController@getUserDataUpdated');

/* Categories Routes */
Route::post('getmainservices','Api\CategoryController@getAllServices');
Route::post('getallproducts','Api\CategoryController@getAllProducts');

/* Gallery Routes */
Route::post('getgalleryimages','Api\MobileController@getGalleryData');

/* Jobs Routes */
Route::post('addorder','Api\JobsController@addOrder');

Route::post('getjobdetails','Api\JobsController@getOrderDetails');
Route::post('getuserorders','Api\JobsController@getUserOrders');
Route::post('addfeedback','Api\JobsController@addFeedback');
