<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Repository\Ajax;
use App\Store;
use App\Category;
use App\Offer;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function getAjaxRequest($action){
        //get top and popular stores
        if($action == 1){
            $data['topstores'] = Ajax::getTopStores();
            $data['popularstores'] = Ajax::getPopularStores();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top and popular categories
        else if($action == 2){
            $data['topcategories'] = Ajax::getTopCategories();
            $data['popularcategories'] = Ajax::getPopularCategories();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
    }
    public function getSearchedResults($title){
        $response['stores'] = Ajax::getSearchedStores($title);
        $response['categories'] = Ajax::getSearchedCategories($title);
        $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return response()->json($response);
    }
}
