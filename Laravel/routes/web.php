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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','norController@index');
Route::view('/chinh-sach','orther.chinhsach',['title'=> 'Chính sách']);
Route::get('/xem-phim/{name}/{tap}','norController@xemphim');
Route::get('/test','norController@test');
Route::get('/live_search/{name}','norController@live_search');
Route::get('/search','norController@search');
Route::post('/search','norController@Postsearch');
Route::post('/login','AuthController@chekus');
Route::get('/dhb','AuthController@dhb');
Route::get('/logout','AuthController@logout')->middleware('role:User,Admin');
Route::post('/','AuthController@register');
Route::get('/doi-mat-khau','AuthController@getDoiPass')->middleware('role:User,Admin');
Route::post('/doi-mat-khau','AuthController@postDoiPass')->middleware('role:User,Admin');
Route::post('/like','AuthController@like');
Route::post('/follow','AuthController@follow');
Route::get('/phim-da-thich','AuthController@getlike_follow')->middleware('role:User,Admin');
Route::get('/theo-doi','AuthController@getlike_follow')->middleware('role:User,Admin');
Route::get('/phim-da-xem','AuthController@getlike_follow')->middleware('role:User,Admin');
Route::get('/profile','AuthController@profile')->middleware('role:User,Admin');
Route::get('/xem-phim/{name}','norController@redirect_xemphim');
Route::get('/admin/anime/all-anime','AdminController@all_phim');
Route::post("/comment","AuthController@comment")->middleware('role:User,Admin');
Route::get('/auth/{provider}','Auth\LoginController@redirect');
Route::get('/auth/{provider}/callback','Auth\LoginController@callback');
Route::get('/testt','norController@testt')->middleware('role:Admin');
Route::get('/sua-thong-tin','AuthController@get_Edit_Profile')->middleware('role:User,Admin');
Route::post('/sua-thong-tin','AuthController@post_Edit_Profile')->middleware('role:User,Admin');
Route::get('/admin/dashboard','AdminController@dashboard')->middleware('role:Admin');
Route::get('/admin/getdata','AdminController@getdata')->middleware('role:Admin');
Route::get('/admin/getdefault/{name}','AdminController@getdefault')->middleware('role:Admin');
Route::get('/admin/getanime/{key}','AdminController@getanime')->middleware('role:Admin');
Route::get('/admin/showanime','AdminController@showanime')->middleware('role:Admin');
Route::get('/admin/showuser','AdminController@showuser')->middleware('role:Admin');
Route::get('/admin/shownews','AdminController@shownews')->middleware('role:Admin');
Route::get('/admin/update','AdminController@update')->middleware('role:Admin');
Route::get('/admin/deleteAM/{key}','AdminController@deleteAM')->middleware('role:Admin');
Route::post('/admin/updateAM','AdminController@updateAM')->middleware('role:Admin');
Route::get('/admin/getnews','AdminController@getnews')->middleware('role:Admin');
Route::get('/admin/getdatanews/{key}','AdminController@getdatanews')->middleware('role:Admin');
Route::get('/admin/deletenews/{key}','AdminController@deletenews')->middleware('role:Admin');
Route::post('/admin/updatenews','AdminController@updatenews')->middleware('role:Admin');
Route::get('/admin/getdefaultnews/{name}','AdminController@getdefaultnews')->middleware('role:Admin');
Route::get('/checkUsername','AuthController@checkUsername');
Route::get('/admin/getuser','AdminController@getuser')->middleware('role:Admin');

Route::get('/admin/getdatauser/{name}','AdminController@getdatauser')->middleware('role:Admin');

Route::get('/admin/deleteuser/{key}','AdminController@deleteuser')->middleware('role:Admin');

Route::get('/admin/getdefaultuser/{name}','AdminController@getdefaultuser')->middleware('role:Admin');

Route::post('/admin/updateuser','AdminController@updateuser')->middleware('role:Admin');

Route::get('/admin/mail','AdminController@sendMail');

Route::get('/forgetpass','AuthController@forget');

Route::get('/mail/{user}','AuthController@sendMail');

Route::get('/checkemail','AuthController@emailExists');