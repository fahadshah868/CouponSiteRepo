<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Repository\Home;

class HomeController extends Controller
{
    public function home(){
        $data['carouseloffers'] = Home::getCarouselOffers();
        $data['topstores'] = Home::getTopStores();
        $data['offers'] = Home::getOffers(1);
        $data['popularstores'] = Home::getPopularStores();
        $data['popularcategories'] = Home::getPopularCategories();
        $data['latestblogs'] = Home::getLatestBlogs();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.home',$data);
    }
    public function getLoadMoreOffers(Request $request){
        $response['offers'] = Home::getOffers($request->page);
        $response['hasmorepage'] = $response['offers']->hasMorePages();
        $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return response()->json($response);
    }
}
