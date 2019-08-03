<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\StoreCategory;
use Facades\App\Repository\StoreRepo;

class StoreController extends Controller
{
    public function getAllStoresList(){
        $data['topstores'] = StoreRepo::getAllTopStores();
        $data['allstores'] = StoreRepo::getAllStores();
        $data['filtered_letters'] = $data['allstores']->groupBy(function ($item, $key) {
            $letter = substr(strtoupper($item->title), 0, 1);
            if(is_numeric($letter)){
                return "0-9";
            }
            else{
                return $letter;
            }
        })->toArray();
        $data['allcategories'] = StoreRepo::getAllCategories();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.allstores',$data);
    }
    public function getCategoryStores($category){
        if(strcasecmp($category,"allstores") == 0){
            $response['allstores'] = StoreRepo::getAllStores();
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
            $response['storecategories'] = StoreCategory::select('store_id')
            ->where('category_id',$category)
            ->with(['store' => function($q) use($category){
                $q->select('id','title','logo_url','secondary_url')
                ->withCount(['offers' => function($oq) use($category){
                    $oq->where('is_active','y')->where('category_id',$category)
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where(function($sq){
                        $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                    });
                }]);
            }])
            ->whereHas('store',function($q){
                $q->select('id')->where('is_active','y');
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
        $data['store'] = Store::select('id','title','description','logo_url','network_url')->where('secondary_url',$store)->where('is_active','y')->with(['offers' => function($q){
            $q->select('id','store_id','category_id','anchor','title','details','expiry_date','location','type','is_verified')
            ->with(['category' => function($cq){
                $cq->select('id','title');
            }])
            ->whereHas('category',function($cq){
                $cq->where('is_active','y');
            })
            ->where('is_active','y')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC');
        }])->first();
        $data['categories'] = $data['store']->offers->groupBy(function ($item, $key) {
            return $item->category->id;
        });
        $data['alltopstores'] = Store::select('id','title','secondary_url')
        ->where('is_active','y')
        ->where('is_popularstore',1)
        ->whereNotIn('id',[$data['store']->id])
        ->withCount(['offers' => function($q){
            $q->where('is_active','y')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            });
        }])
        ->orderBy('is_topstore','ASC')
        ->orderBy('is_popularstore','ASC')
        ->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.storeoffers',$data);
    }
}