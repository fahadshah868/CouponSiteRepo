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
//routes for homecontroller
Route::get('/' , 'HomeController@home');
Route::get('/loadmoreoffers/{rowscount}','HomeController@getLoadMoreOffers');

// routes for ajaxcontroller
Route::get('/getajaxrequest/{action}','AjaxController@getAjaxRequest');

// routes for StoreController
Route::get('/allstores','StoreController@getAllStoresList');
Route::get('/{category}/stores','StoreController@getCategoryStores');
Route::get('/store/{store}','StoreController@getStoreOffers');

// routes for CategoryController
Route::get('/allcategories','CategoryController@getAllCategoriesList');

//routes for FilteredController
Route::get('/coupons/{filter}','FilteredOfferController@getFilteredOffers');

// routes for OnlineCodeController
Route::get('/gettoponlinecodes','OnlineCodeController@getTopOnlineCodesList');

// route for InstoreOffersController
Route::get('/gettopinstoreoffers','InstoreOffersController@getTopInstoreOffersList');