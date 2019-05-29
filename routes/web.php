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

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about')->name('pages.about');
Route::get('/services', 'PagesController@services')->name('pages.services');


Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController')->only('store','edit','update','destroy');
Route::resource('replies', 'RepliesController')->only('store','update','destroy', 'edit');
Route::resource('tags', 'TagsController')->only('show');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');


//route for post filters
Route::prefix('filtered')->name('filters.')->group( function() {
	Route::get('most-views', 'PostFiltersController@mostViews')->name('mostViews');
	Route::get('recent', 'PostsController@index')->name('recent');
	Route::get('most-comments', 'PostFiltersController@mostComments')->name('mostComments');
});