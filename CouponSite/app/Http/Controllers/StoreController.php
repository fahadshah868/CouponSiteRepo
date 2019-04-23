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
        $data['topstores'] = Store::select('title','logo_url','secondary_url')->where('is_topstore','yes')->where('status',1)->get();
        $data['allstores'] = Store::select('id','title','logo_url','secondary_url')
        ->where('status',1)
        ->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')
        ->withCount(['offers' => function($q){
            $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null);
        }])->get();
        // dd($data['allstores']);
        $data['filtered_letters'] = $data['allstores']->groupBy(function ($item, $key) {
            $letter = substr(strtoupper($item->title), 0, 1);
            if(is_numeric($letter)){
                return "0-9";
            }
            else{
                return $letter;
            }
        })->toArray();
        $data['allcategories'] = StoreCategory::select('category_id')->groupBy('category_id')
        ->with(['category' => function($q){
            $q->select('id','title');
        }])->whereHas('category' , function($q){
            $q->select('title')->where('status',1);
        })->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.allstores',$data);
    }
    public function getCategoryStores($category){
        if(strcasecmp($category,"allstores") == 0){
            $response['allstores'] = Store::select('id','title','logo_url','secondary_url')
            ->where('status',1)
            ->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')
            ->withCount(['offers'=> function($q){
                $q->where('status',1)
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
            $response['status'] = 1;
            return response()->json($response);
        }
        else{
            $response['storecategories'] = StoreCategory::select('store_id')->where('category_id',$category)->with(['store' => function($q) use($category){
                $q->select('id','title','logo_url','secondary_url')
                ->withCount(['offers' => function($oq) use($category){
                    $oq->where('status',1)->where('category_id',$category)
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                }]);
            }])
            ->whereHas('store',function($q){
                $q->select('id')->where('status',1);
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
            $response['status'] = 2;
            return response()->json($response);
        }
    }
    public function getstoreOffers($store){
        $data['store'] = Store::select('id','title','description','logo_url','network_url')->where('secondary_url',$store)->where('status',1)->with(['offers' => function($q){
            $q->select('id','store_id','category_id','anchor','title','details','expiry_date','location','type','is_verified')
            ->with(['category' => function($cq){
                $cq->select('id','title');
            }])
            ->whereHas('category',function($cq){
                $cq->where('status',1);
            })
            ->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null)
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC');
        }])->first();
        $data['categories'] = $data['store']->offers->groupBy(function ($item, $key) {
            return $item->category->id;
        });
        $data['alltopstores'] = Store::select('id','title','secondary_url')->where('is_topstore',1)->orWhere('is_popularstore',1)->where('status',1)
        ->withCount(['offers' => function($q){
            $q->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null);
        }])->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.storeoffers',$data);
    }
}