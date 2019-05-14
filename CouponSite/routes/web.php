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
Route::get('/getsearchedresults/{title}','AjaxController@getSearchedResults');

// routes for StoreController
Route::get('/allstores','StoreController@getAllStoresList');
Route::get('/{category}/stores','StoreController@getCategoryStores');
Route::get('/store/{store}','StoreController@getStoreOffers');

// routes for CategoryController
Route::get('/allcategories','CategoryController@getAllCategoriesList');

//routes for FilteredController
Route::get('/coupons/{filter}','FilteredOfferController@getFilteredOffers');
Route::get('/applymorefilters/{filters}/{category}', 'FilteredOfferController@getMoreFilteredOffers');

// routes for BlogController
Route::get('/blog/','BlogController@getBlogsList');
Route::get('/blog/{blog}','BlogController@getReadblog');
Route::get('/blog/category/{category}','BlogController@getCategoryWiseBlogsList');
Route::post('/blog/postcomment','BlogController@postBlogComment');