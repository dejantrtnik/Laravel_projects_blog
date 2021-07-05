<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AdminController;
use App\Http\Middleware\PreventBackHistory;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\IpController;
use App\Http\Controllers\ChartJsController;
use App\Http\Controllers\CommentsController;

use App\Http\Controllers\backupController;


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

Route::get('admin/logged_in_devices', 'App\Http\Controllers\LoggedInDeviceManager@index')
		->name('logged_in_devices.list')
		->middleware('auth');

Route::get('/logout/all', 'App\Http\Controllers\LoggedInDeviceManager@logoutAllDevices')
		->name('logged_in_devices.logoutAll')
		->middleware('auth');

Route::get('/logout/{device_id}', 'App\Http\Controllers\LoggedInDeviceManager@logoutDevice')
		->name('logged_in_devices.logoutSpecific')
		->middleware('auth');

// session
Route::get('session/get','App\Http\Controllers\SessionController@accessSessionData');
Route::get('session/set','App\Http\Controllers\SessionController@storeSessionData');
Route::get('session/remove','App\Http\Controllers\SessionController@deleteSessionData');

// admin
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
Route::get('/admin/users', 'App\Http\Controllers\AdminController@users')->name('users');
Route::get('/admin/users_req', 'App\Http\Controllers\AdminController@users_req')->name('users_req');
Route::get('/admin/posts', 'App\Http\Controllers\AdminController@posts')->name('posts');
Route::get('/admin/show/{id}', 'App\Http\Controllers\AdminController@show')->name('show');
Route::get('/admin/edit_role/{role}', 'App\Http\Controllers\AdminController@edit_role')->name('edit_role');
Route::post('/admin/white_list', 'App\Http\Controllers\AdminController@white_list')->name('white_list');
Route::post('/admin/black_list', 'App\Http\Controllers\AdminController@black_list')->name('black_list');
Route::get('/admin/project/', 'App\Http\Controllers\ProjectController@show')->name('project');
Route::get('/admin/chartjs', [ChartJsController::class, 'index'])->name('chartjs');
Route::get('/admin/chartjs_country/{ipStrlen}', [ChartJsController::class, 'show_country'])->name('chartjs_country');

Route::get('/admin/user_login', 'App\Http\Controllers\AdminController@show_login')->name('user_login ');

Route::get('/admin/user_login/{user_id}', 'App\Http\Controllers\AdminController@show_detail_by_user')->name('user_login ');

//Route::get('/admin/info_server', [PagesController::class, 'info'])->name('info_server')
Route::get('/admin/info_server', 'App\Http\Controllers\PagesController@info')->name('info_server');

//BACKUP
Route::get('/admin/backup', 'App\Http\Controllers\backupController@index')->name('index');
Route::get('/admin/backup/{var}', 'App\Http\Controllers\backupController@store')->name('backup_store');


// comments
Route::post('/admin/', 'App\Http\Controllers\CommentsController@store')->name('comment.store');
Route::get('/admin/comments', 'App\Http\Controllers\CommentsController@index')->name('admin.comments');
Route::post('/posts/{id}', 'App\Http\Controllers\CommentsController@store')->name('posts.show');

Route::get('/admin/{id}/comments', 'App\Http\Controllers\CommentsController@destroy')->name('comment.delete');

//Route::get('/admin/{id}/destroy', 'App\Http\Controllers\CommentsController@destroy')->name('comment.delete');

// search
Route::get('users/search/', 'App\Http\Controllers\UserController@search')->name('search_user');
Route::get('posts/search/', 'App\Http\Controllers\PostsController@search')->name('search_post');
Route::get('admin/ip/search', 'App\Http\Controllers\IpController@search')->name('search_ip');


// admin / ip
Route::get('/admin/ip/', [IpController::class, 'index']);
Route::get('/admin/ip/{table}', [IpController::class, 'show']);
Route::get('/admin/ip/country/{table}', [IpController::class, 'showCountry']);
Route::get('/admin/ip/user/{user_id}', [IpController::class, 'showVisit']);


Route::get('/admin/{id}/destroy', 'App\Http\Controllers\IpController@destroy')->name('ip.delete');
Route::get('/admin/{id}/destroy_white_list', 'App\Http\Controllers\IpController@destroy_white_list')->name('ip_white.delete');


// user
Route::get('/user', [UserController::class, 'index']);
Route::resource('/user', 'App\Http\Controllers\UserController');
Route::get('/user/create', 'App\Http\Controllers\UserController@create')->name('user.create');
Route::post('/user/{id}/edit', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::get('/user/{id}/destroy', 'App\Http\Controllers\UserController@destroy')->name('user.delete');

// posts
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/showAll/{id}', 'App\Http\Controllers\PostsController@showAll')->name('showAll');
Route::get('/posts/{id}/destroy', 'App\Http\Controllers\PostsController@destroy')->name('posts.delete');

// pages
Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/clock', 'App\Http\Controllers\PagesController@clock')->name('clock');
Route::get('/pages/contact/{id}', [PagesController::class, 'contact']);
Route::post('/pages/contact/', 'App\Http\Controllers\PagesController@telegram')->name('telegram');
Route::get('/pages/coding/{id}', 'App\Http\Controllers\PagesController@coding')->name('form');
Route::get('/show_video', 'App\Http\Controllers\PagesController@show_video')->name('show_video');
//Route::get('/pages/coding/php/', 'App\Http\Controllers\PagesController@coding')->name('form');


// project
Route::get('/project', [ProjectController::class, 'index']);
Route::get('/project/create', [ProjectController::class, 'create']);
Route::post('/project/create', 'App\Http\Controllers\ProjectController@store')->name('store');
Route::get('/admin/project/{id}/edit', 'App\Http\Controllers\ProjectController@edit')->name('project.edit');
Route::post('/admin/project/{id}/edit', 'App\Http\Controllers\ProjectController@update')->name('update');
//Route::delete('/admin/project/{id}', 'App\Http\Controllers\ProjectController@destroy')->name('destroy');
Route::get('/project/{id}/destroy', 'App\Http\Controllers\ProjectController@destroy')->name('project.destroy');
Route::get('/project/{id}', 'App\Http\Controllers\ProjectController@show_detail')->name('show_detail');

Route::delete('/project/{id}/destroy', 'App\Http\Controllers\ProjectController@destroy')->name('project.delete');
//Route::get('/project/create', [ProjectController::class, 'store']);

// other
Route::resource('posts', 'App\Http\Controllers\PostsController');

//
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::group(['/middleware' => 'prevent-back-history'],function(){
	Auth::routes();
	Route::get('/', [PagesController::class, 'index']);
});
