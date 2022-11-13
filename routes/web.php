<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;

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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::controller(DashboardController::class)->group(function () {
	Route::get('/dashboard', 'index');
});

Route::controller(PostsController::class)->group(function () {
	Route::name('posts.')->prefix('posts')->group(function () {
		Route::get('all', 'index')->name('all');
		Route::get('add', 'create')->name('add');
		Route::post('save', 'store')->name('save');
		Route::get('view/{slug}', 'show')->name('view');
		Route::get('edit/{slug}', 'edit')->name('edit');
		Route::post('update/{slug}', 'update')->name('update');
		Route::get('activate/{slug}', 'publish')->name('activate');
		Route::get('deactivate/{slug}', 'unpublish')->name('deactivate');
		Route::get('deletepostimage/{slug}', 'deleteimage')->name('deletepostimage');
		Route::get('delete/{slug}', 'destroy')->name('delete');
	});
});
