<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;

class StoreController extends Controller
{
    public function getAllStoresList(){
        $data['topstores'] = Store::where('is_topstore','yes')->where('status','active')->get(['title','logo_url','secondary_url']);
        $data['allstores'] = Store::where('status','active')->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')->with(['offer'=> function($q){
            $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->where('status','active');
        }])->get(['title','secondary_url']);
        $data['filtered_letters'] = $data['allstores']->groupBy(function ($item, $key) {
            $letter = substr(strtoupper($item->title), 0, 1);
            if(is_numeric($letter)){
                return "0-9";
            }
            else{
                return $letter;
            }
        })->toArray();
        $data['allcategories'] = Category::where('status','active')->orderBy('is_topcategory','ASC')->orderBy('is_popularcategory','ASC')->get(['title']);
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.store.allstores',$data);
    }
    public function getStoreOffers(){
        return view('pages.store.storeoffers');
    }
}
