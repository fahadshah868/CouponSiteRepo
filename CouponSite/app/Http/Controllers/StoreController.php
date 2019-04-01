<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\StoreCategory;
use App\Offer;

class StoreController extends Controller
{
    public function getAllStoresList(){
        $data['topstores'] = Store::select('title','logo_url','secondary_url')->where('is_topstore','yes')->where('status','active')->get();
        $data['allstores'] = Store::select('id','title','logo_url','secondary_url')
        ->where('status','active')
        ->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')
        ->with(['offer' => function($q){
            $q->select('store_id')->where('status','active')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null);
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
        $data['allcategories'] = StoreCategory::select('category_id')->groupBy('category_id')->with('category')->whereHas('category' , function($q){
            $q->select('title')->where('status','active');
        })->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.allstores',$data);
    }
    public function getCategoryStores($category){
        if(strcasecmp($category,"allstores") == 0){
            $response['allstores'] = Store::select('id','title','logo_url','secondary_url')
            ->where('status','active')
            ->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')
            ->with(['offer'=> function($q){
                $q->select('store_id')->where('status','active')
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
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
            $response['filtered_stores_header'] = "All Stores & Coupons";
            $response['status'] = 1;
            return response()->json($response);
        }
        else{
            $response['storecategories'] = StoreCategory::select('store_id')->where('category_id',$category)->with(['store','store.offer' => function($q) use($category){
                $q->select('store_id')->where('status','active')->where('category_id',$category)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            }])
            ->whereHas('store',function($q){
                $q->select('id','title','secondary_url')->where('status','active');
            })->get();
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
            $response['filtered_stores_header'] = $category." Stores & Coupons";
            $response['status'] = 2;
            return response()->json($response);
        }
    }
    public function getStoreOffers($id){
        $data['storeoffers'] = Store::select('id','title','description','logo_url','network_url')->where('secondary_url',$id)->where('status','active')->with(['offer' => function($q){
            $q->select('store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with('category')
            ->whereHas('category',function($q){
                $q->where('status','active');
            })
            ->where('status','active')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null);
        }])->get();
        $data['storecategories'] = null;
        foreach($data['storeoffers'] as $sample){
            $data['storecategories'] = $sample->offer->groupBy(function ($item, $key) {
                return $item->category->title;
            });
        }
        dd($data['storecategories']);
        return view('pages.store.storeoffers',$data);
    }
}