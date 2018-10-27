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
Route::get('/' , 'HomeController@home');

// routes for StoreController
Route::get('/getpopularstores' , 'StoreController@getPopularStoresList');
Route::get('/store/allstores','StoreController@getAllStoresList');
Route::get('/store/storecoupons','StoreController@getStoreCoupons');

// routes for CategoryController
Route::get('/getpopularcategories' , 'CategoryController@getPopularCategoriesList');
Route::get('/category/allcategories' , 'CategoryController@getAllCategoriesList');

// routes for SpecialEventsController
Route::get('/getspecialevents' , 'SpecialEventsController@getSpecialEventsList'); 

// routes for OnlineCodeController
Route::get('/gettoponlinecodes', 'OnlineCodeController@getTopOnlineCodesList');

// route for InstoreOffersController
Route::get('/gettopinstoreoffers','InstoreOffersController@getTopInstoreOffersList');