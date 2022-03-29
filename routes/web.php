<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/

// Route::get('/','AdminController@dashboard')->name('/');

Route::get('login', 'AdminController@adminLogin')->name('admin-login');

Route::get('logout', 'AdminController@adminLogout')->name('admin-logout');
Route::post('authenticate', 'AdminController@mobilelogin')->name('login-authenticate');


Route::group(['middleware' => ['guest']], function () {
	Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin-dashboard');

	Route::get('admin/services', 'AdminController@listServices')->name('admin-main-services');
	Route::post('admin/add-service', 'AdminController@listServices')->name('admin-main-add-service');
	Route::get('admin/products', 'AdminController@listProducts')->name('admin-main-services-product');
	Route::post('admin/add-product', 'AdminController@listProducts')->name('admin-main-add-product');
	Route::get('admin/delete-product', 'AdminController@deleteProduct')->name('admin-delete-product');

	Route::get('admin/change-status', 'AdminController@getStatusChanged')->name('admin-change-status');

	Route::get('admin/gallery', 'AdminController@listGalleryImages')->name('admin-gallery-images');
	Route::post('admin/add-gallery-image', 'AdminController@listGalleryImages')->name('admin-gallery-add-images');
	Route::get('admin/delete-gallery-image', 'AdminController@deleteGalleryImage')->name('admin-delete-gallery-image');

	Route::post('admin/editsubcategory/{id}', 'CategoryController@getMainSubCategories')->name('admin-main-sub-category');
	Route::get('admin/deletecategory', 'AdminController@getCatDeleted')->name('admin-delete-sub-category');

	Route::get('admin/users', 'AdminController@userListing')->name('admin-users');
	Route::post('admin/users', 'AdminController@userListing');
	Route::post('admin/edituser', 'AdminController@editUser')->name('admin-edit-users');
	Route::get('admin/deleteuser', 'AdminController@userDelete')->name('admin-delete-users');
	Route::post('admin/search-users', 'AdminController@userSearch')->name('admin-users-search');

	Route::get('admin/feedback', 'AdminController@userFeedbackListing')->name('admin-feedback');
	/* User Routes 
	Route::get('admin/users', 'AdminController@userListing')->name('users');
	Route::post('admin/users', 'AdminController@userListing')->name('add-user');
	Route::post('admin/changepassword', 'AdminController@changePass')->name('change-password');
	Route::post('admin/activateuser/{id}', 'AdminController@userActivate')->name('user-activate');
	Route::post('admin/deactivateuser/{id}', 'AdminController@userDeactivate')->name('user-deactivate');
	Route::post('admin/deleteuser/{id}', 'AdminController@userDelete')->name('user-delete');*/

	
	/* Jobs Routes */
	Route::get('admin/order', 'JobsController@getAllJobs')->name('admin-jobs');
	Route::get('admin/receipt', 'AdminController@makeReportOfOrder')->name('admin-order-receipt');
	Route::get('admin/view-order', 'JobsController@viewJob')->name('admin-view-job');
	Route::post('admin/add-order', 'AdminController@createOrderFromAdmin')->name('admin-add-order');
	Route::get('admin/order-status', 'JobsController@changeOrderStatus')->name('admin-order-status');
});
