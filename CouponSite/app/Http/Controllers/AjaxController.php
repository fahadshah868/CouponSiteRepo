<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\Offer;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function getAjaxRequest($action){
        //get top and popular stores
        if($action == 1){
            $data['topstores'] = Store::select('title','secondary_url','logo_url')->where('is_topstore','yes')->where('status',1)->limit(10)->get();
            $data['popularstores'] = Store::select('id','title','secondary_url')->where('is_popularstore','yes')->where('is_topstore','no')->where('status',1)->limit(30)->with(['offers'=> function($q) {
                $q->select('store_id')->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->where('status',1);
            }])->get();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top and popular categories
        else if($action == 2){
            $data['topcategories'] = Category::select('title','url','logo_url')->where('is_topcategory','yes')->where('status',1)->limit(10)->get();
            $data['popularcategories'] = Category::select('id','title','url')->where('is_popularcategory','yes')->where('is_topcategory','no')->where('status',1)->limit(30)->with(['offers'=> function($q) {
                $q->select('category_id')->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->where('status',1);
            }])->get();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top online codes
        else if($action == 3){
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top sales
        else if($action == 4){
            //todo
            return response()->json("4");
        }
        //get top Freeshipping offers
        else if($action == 5){
            //todo
            return response()->json("5");
        }
    }
    public function getSearchedResults($title){
        $response['stores'] = Store::select('title','secondary_url')->where('title', 'like', '%' . $title . '%')->where('status',1)->limit(4)->get();
        $response['categories'] = Category::select('title','url')->where('title', 'like', '%' . $title . '%')->where('status',1)->limit(4)->get();
        return response()->json($response);
    }
}
