<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;
use App\StoreCategory;

class FilteredOfferController extends Controller
{
    public function getFilteredOffers(Request $request, $filter){
        if(strcasecmp($filter,'onlinecodes') == 0){
            dd('1');
            return view('pages.filteredoffer.filteredoffers');
        }
        else if(strcasecmp($filter,'onlinesales') == 0){
            dd('2');
            return view('pages.filteredoffer.filteredoffers');
        }
        else if(strcasecmp($filter,'freeshipping') == 0){
            dd('3');
            return view('pages.filteredoffer.filteredoffers');
        }
        else{
            $data['category'] = Category::select('id','title','description')->where('title',$filter)->where('status',1)->first();
            $data['filteredoffers'] = $data['category']->offers()
                ->select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','logo_url');
                }])
                ->whereHas('store', function($sq){
                    $sq->where('status',1);
                })
                ->where('status',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null)
                ->orderBy('id','DESC')
                ->orderBy('is_popular','ASC')
                ->orderBy('anchor','DESC')
                ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            if($request->ajax()){
                return view('partialviews.filteredoffers',$data);
            }
            else{
                $data['stores'] = StoreCategory::select('store_id')->where('category_id',$data['category']->id)
                ->groupBy('store_id')
                ->with(['store' => function($q){
                    $q->select('id','title')
                    ->withCount(['offers' => function($oq){
                        $oq->where('status',1)
                        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                        ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                    }]);
                }]);
                return view('pages.filteredoffer.filteredoffers',$data);
            }
        }
    }
}
