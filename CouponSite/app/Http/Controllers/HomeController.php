<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Repository\HomeRepo;

class HomeController extends Controller
{
    public function home(){
        $data['carouseloffers'] = HomeRepo::getCarouselOffers();
        $data['topstores'] = HomeRepo::getTopStores();
        $data['offers'] = HomeRepo::getOffers(1);
        $data['popularstores'] = HomeRepo::getPopularStores();
        $data['popularcategories'] = HomeRepo::getPopularCategories();
        $data['latestblogs'] = HomeRepo::getLatestBlogs();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.home',$data);
    }
    public function getLoadMoreOffers(Request $request){
        $response['offers'] = HomeRepo::getOffers($request->page);
        $response['hasmorepage'] = $response['offers']->hasMorePages();
        $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return response()->json($response);
    }
}
