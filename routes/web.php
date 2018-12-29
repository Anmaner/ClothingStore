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


Route::get('/', 'IndexController@index')->name('main');

Route::get('shopping/{category?}', 'ShoppingController@category')->middleware('CorrectCategory:shopping')->name('shopping');

Route::get('blog/{category?}', 'BlogController@category')->middleware('CorrectCategory:blog')->name('blog');

Route::group(['prefix' => 'blog-search'], function() {
	Route::get('tags/{curTag}', 'BlogSearchController@tags')->middleware('CorrectSearch:tags')->name('blog.search.tags');
});