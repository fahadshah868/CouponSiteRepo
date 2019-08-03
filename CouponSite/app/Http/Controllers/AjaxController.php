<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Repository\AjaxRepo;

class AjaxController extends Controller
{
    public function getAjaxRequest($action){
        //get top and popular stores
        if($action == 1){
            $data['topstores'] = AjaxRepo::getTopStores();
            $data['popularstores'] = AjaxRepo::getPopularStores();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top and popular categories
        else if($action == 2){
            $data['topcategories'] = AjaxRepo::getTopCategories();
            $data['popularcategories'] = AjaxRepo::getPopularCategories();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
    }
    public function getSearchedResults($title){
        $response['stores'] = AjaxRepo::getSearchedStores($title);
        $response['categories'] = AjaxRepo::getSearchedCategories($title);
        $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return response()->json($response);
    }
}
