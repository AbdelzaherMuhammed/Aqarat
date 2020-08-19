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


/*
user route
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/logout' , 'Auth\LoginController@logout');


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['namespace' => 'Front'], function(){
    //Aqar pages
    Route::get('/showAllBuilding' , 'MainController@showAllEnabled');
    Route::get('/forRent' , 'MainController@forRent');
    Route::get('/forBuy' , 'MainController@forBuy');
    Route::get('/type/{id}' , 'MainController@showByType');

    //welcome page
    Route::get('/search' , 'MainController@search');
    Route::get('/building-details/{id}' , 'MainController@showDetails');
    Route::get('/ajax/aqar/information' , 'MainController@getAjaxInfo');

    //Contact routes
    Route::get('/contact-us' , 'MainController@showContact');
    Route::post('/contact-us', 'MainController@contactCreate')->name('contact-create');

    // Adding Aqar
    Route::get('/user/create/building', 'MainController@userAddAqar');
    Route::post('/user/create/building', 'MainController@userCreateAqar');

    // Editing Aqar
    Route::get('/user/edit/building/{id}', 'MainController@userEditAqar')->middleware('auth');
    Route::post('/user/edit/building', 'MainController@userUpdateAqar')->middleware('auth');

    Route::get('user/building/show', 'MainController@userBuildingShow')->middleware('auth');
    Route::get('user/building/waiting', 'MainController@userBuildingWaiting')->middleware('auth');

    Route::get('/user/edit-profile', 'AuthController@editUserProfile')->middleware('auth');
    Route::put('/user/edit-profile', 'AuthController@UpdateUserProfile')->middleware('auth')->name('user-edit-setting');
    Route::post('/user/change-password', 'AuthController@changePassword')->middleware('auth');




});







/*
 * admin route
 */

Route::group(['middleware' => ['web' , 'admin'], 'namespace' => 'Admin'] , function (){

    /*
     * datatable ajax
     */
    Route::get('/adminpanel/users/data' , [ 'as' => 'adminpanel.users.data' , 'uses' => 'UsersController@anyData']);
    Route::get('/adminpanel/aqars/data' , [ 'as' => 'adminpanel.aqars.data' , 'uses' => 'AqarController@anyData']);
    Route::get('/adminpanel/contact/data' , [ 'as' => 'adminpanel.contact.data' , 'uses' => 'ContactUsController@anyData']);


    /*
     * main admin
     */
    Route::get('adminpanel' , 'AdminController@index');
    Route::get('adminpanel/status' , 'AdminController@aqarsStatus');
    Route::post('adminpanel/status' , 'AdminController@showAqarsYear');


    /*
     * users
     */
    Route::resource('user' ,'UsersController');
    Route::post('adminpanel/user/updatePassword' , 'UsersController@updatePassword');
    Route::get('adminpanel/user/{id}/delete' , 'UsersController@destroy');


    /*
     * settings
     */
    Route::resource('setting' , 'SiteSettingController');




    /*
     * aqars
     */

    Route::resource('aqar' , 'AqarController')->except(['index', 'show']);
    Route::get('adminpanel/aqar/{id?}' , 'AqarController@index');
    Route::get('adminpanel/aqar/{id}/delete' , 'AqarController@destroy');
    Route::get('adminpanel/change-aqar-status/{id}' , 'AqarController@changeAqarStatus');



    /*
     * Contact
     */
    Route::resource('contact' , 'ContactUsController');
    Route::get('adminpanel/contact/{id}/delete' , 'ContactUsController@destroy');

});

