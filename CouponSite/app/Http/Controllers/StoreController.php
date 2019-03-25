<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\StoreCategory;

class StoreController extends Controller
{
    public function getAllStoresList(){
        $data['topstores'] = Store::select('title','logo_url','secondary_url')->where('is_topstore','yes')->where('status','active')->get();
        $data['allstores'] = Store::select('id','title','logo_url','secondary_url')->where('status','active')->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')->with(['offer'=> function($q){
            $q->select('store_id')->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null)
            ->where('status','active');
        }])->get();
        $data['filtered_letters'] = $data['allstores']->groupBy(function ($item, $key) {
            $letter = substr(strtoupper($item->title), 0, 1);
            if(is_numeric($letter)){
                return "0-9";
            }
            else{
                return $letter;
            }
        })->toArray();
        $data['allcategories'] = StoreCategory::select('category_id')->groupBy('category_id')->with('category')->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.allstores',$data);
    }
    public function getCategoryStores($_category){
        if(strcasecmp($_category,"allstores") == 0){
            $response['allstores'] = Store::select('id','title','logo_url','secondary_url')->where('status','active')->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')->with(['offer'=> function($q){
                $q->select('store_id')->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null)
                ->where('status','active');
            }])->get();
            $response['filtered_letters'] = $response['allstores']->groupBy(function ($item, $key) {
                $letter = substr(strtoupper($item->title), 0, 1);
                if(is_numeric($letter)){
                    return "0-9";
                }
                else{
                    return $letter;
                }
            })->toArray();
            $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $response['status'] = "allstores";
            return response()->json($response);
        }
        else{
            $response['storecategories'] = StoreCategory::select('store_id')->where('category_id',$_category)->with(['store' => function($q){
                $q->select('id','title','logo_url','secondary_url')->with(['offer' => function($oq){
                    $oq->select('title','store_id')->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null)
                    ->where('status','active');
                }]);
            }])->get();
            $response['filtered_letters'] = $response['storecategories']->groupBy(function ($item, $key) {
                $letter = substr(strtoupper($item->store->title), 0, 1);
                if(is_numeric($letter)){
                    return "0-9";
                }
                else{
                    return $letter;
                }
            })->toArray();
            $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $response['status'] = "filteredstores";
            return response()->json($response);
        }
    }
    public function getStoreOffers(){
        return view('pages.store.storeoffers');
    }
}