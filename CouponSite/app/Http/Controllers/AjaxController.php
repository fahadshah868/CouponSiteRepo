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
            $data['topstores'] = Store::where('is_topstore','yes')->where('status','active')->limit(10)->get(['title','logo_url','secondary_url']);
            $data['popularstores'] = Store::where('is_popularstore','yes')->where('is_topstore','no')->where('status','active')->limit(30)->with(['offer'=> function($q) {
                $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->where('status','active');
            }])->get(['title','secondary_url']);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top and popular categories
        else if($action == 2){
            $data['topcategories'] = Category::where('is_topcategory','yes')->where('status','active')->limit(10)->get(['title','logo_url']);
            $data['popularcategories'] = Category::where('is_popularcategory','yes')->where('is_topcategory','no')->where('status','active')->limit(30)->with(['offer'=> function($q) {
                $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->where('status','active');
            }])->get(['title']);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top online codes
        else if($action == 3){
            $data['toponlinecodes'] = Offer::where('location','online')->where('type','code')->where('is_popular','yes')->where('starting_date','<=',config('constants.TODAY_DATE'))->where('expiry_date','>=',config('constants.TODAY_DATE'))->where('status','active')->orderBy('id', 'DESC')->limit(8)->with('store')->get();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return response()->json($data);
        }
        //get top sales
        else if($action == 4){
            $data['topstores'] = Category::where('is_topcategory','yes')->limit(5)->get();
            $response = [
                "status" => "true",
                "success_message" => "success"
            ];
            return response()->json("4");
        }
        //get top Freeshipping offers
        else if($action == 5){
            $data['topstores'] = Category::where('is_topcategory','yes')->limit(5)->get();
            $response = [
                "status" => "true",
                "success_message" => "success"
            ];
            return response()->json("5");
        }
    }
}
