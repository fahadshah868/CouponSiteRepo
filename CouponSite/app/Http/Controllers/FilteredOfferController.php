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
                    $sq->select('id','title','logo_url');
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
                $data['stores'] = $data['filteredoffers']->groupBy(function ($item, $key) {
                    return $item->store->id;
                });
                $data['alltopcategories'] = Category::select('id','title','url')->where('is_topcategory',1)->orWhere('is_popularcategory',1)->where('status',1)
                ->withCount(['offers' => function($q){
                    $q->where('status',1)
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                }])->get();
                return view('pages.category.categoryoffers',$data);
            }
        }
    }
    public function getMoreFilteredOffers($filters, $category_id){
        if($filters != 0){
            $data['filters'] = explode(',',$filters);
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where('status',1)
            ->where('category_id',$category_id)
            ->Where(function($q) use($data){
                for($i=0; $i< count($data['filters']); $i++){
                    if($i==0){
                        $q->where('store_id',$data['filters'][$i]);
                    }
                    else{
                        $q->orWhere('store_id',$data['filters'][$i]);
                    }
                }
            })->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('partialviews.filteredoffers',$data);
        }
        else{
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where('status',1)
            ->where('category_id',$category_id)
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('partialviews.filteredoffers',$data);
        }
    }
}
