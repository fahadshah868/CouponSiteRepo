<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;

class StoreController extends Controller
{
    public function getAllStoresList(){
        $data['topstores'] = Store::where('is_topstore','yes')->where('status','active')->get();
        $data['allstores'] = Store::where('status','active')->orderBy('title','ASC')->with(['offer'=> function($q){
            $q->where('starting_date', '<=', config('constants.today_date'))
            ->where('expiry_date', '>=', config('constants.today_date'))
            ->where('status','active');
        }])->get();
        $data['allcategories'] = Category::where('status','active')->get();
        $data['panel_assets_url'] = env('PANEL_ASSETS_URL');
        return view('pages.store.allstores',$data);
    }
    public function getStoreOffers(){
        return view('pages.store.storeoffers');
    }
}
