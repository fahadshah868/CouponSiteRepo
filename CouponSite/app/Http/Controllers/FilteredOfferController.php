<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;
use App\StoreCategory;
use View;

class FilteredOfferController extends Controller
{
    public function getFilteredOffers(Request $request, $filter){
        if(strcasecmp($filter,'onlinecodes') == 0){
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->whereHas('store', function($sq){
                $sq->where('status',1);
            })
            ->where('status',1)
            ->where('type',1)
            ->whereIn('location',[1,3])
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            if($request->ajax()){
                $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
                return response()->json($data);
            }
            else{
                $data['stores'] = $data['filteredoffers']->groupBy(function ($item, $key) {
                    return $item->store->id;
                });
                return view('pages.filteredoffer.filteredoffers',$data);
            }
        }
        else if(strcasecmp($filter,'onlinesales') == 0){
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->whereHas('store', function($sq){
                $sq->where('status',1);
            })
            ->where('status',1)
            ->where('type',2)
            ->whereIn('location',[1,3])
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            if($request->ajax()){
                $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
                return response()->json($data);
            }
            else{
                $data['stores'] = $data['filteredoffers']->groupBy(function ($item, $key) {
                    return $item->store->id;
                });
                return view('pages.filteredoffer.filteredoffers',$data);
            }
        }
        else if(strcasecmp($filter,'freeshipping') == 0){
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->whereHas('store', function($sq){
                $sq->where('status',1);
            })
            ->where('status',1)
            ->where('free_shipping',1)
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            if($request->ajax()){
                $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
                return response()->json($data);
            }
            else{
                $data['stores'] = $data['filteredoffers']->groupBy(function ($item, $key) {
                    return $item->store->id;
                });
                return view('pages.filteredoffer.filteredoffers',$data);
            }
        }
        else{
            $data['category'] = Category::select('id','title','description')->where('url',$filter)->where('status',1)->first();
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
                ->where(function($q){
                    $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                })
                ->orderBy('id','DESC')
                ->orderBy('is_popular','ASC')
                ->orderBy('anchor','DESC')
                ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            if($request->ajax()){
                $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
                return response()->json($data);
            }
            else{
                $data['stores'] = $data['filteredoffers']->groupBy(function ($item, $key) {
                    return $item->store->id;
                });
                $data['alltopcategories'] = Category::select('id','title','url')
                ->whereNotIn('id',[$data['category']->id])
                ->Where('is_popularcategory',1)
                ->where('status',1)
                ->withCount(['offers' => function($oq){
                    $oq->where('status',1)
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where(function($sq){
                        $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                    });
                }])
                ->orderBy('is_topcategory','ASC')
                ->orderBy('is_popularcategory','ASC')
                ->get();
                return view('pages.category.categoryoffers',$data);
            }
        }
    }
    public function getMoreFilteredOffers($_stores_id, $_categories_id){
        // stores_id = [] && categories_id = []
        if($_stores_id != 0 && $_categories_id != 0){
            $stores_id = explode(',',$_stores_id);
            $categories_id = explode(',',$_categories_id);
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where(function($q) use($stores_id, $categories_id){
                for($store = 0; $store < count($stores_id); $store++){
                    for($category=0; $category< count($categories_id); $category++){
                        if($store == 0){
                            $q->where('store_id',$stores_id[$store])->where('category_id',$categories_id[$category]);
                        }
                        else{
                            $q->orWhere('store_id',$stores_id[$store])->where('category_id',$categories_id[$category]);
                        }
                    }
                }
            })
            ->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($q) {
                $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $data['offerscount'] = $data['filteredoffers']->total();
            $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
            return response()->json($data);
        }
        // stores_id = [] && categories_id = 0
        else if($_stores_id != 0 && $_categories_id == 0){
            $stores_id = explode(',',$_stores_id);
            $categories_id = explode(',',$_categories_id);
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where(function($q) use($stores_id, $categories_id){
                for($store = 0; $store < count($stores_id); $store++){
                    if($store == 0){
                        $q->where('store_id',$stores_id[$store]);
                    }
                    else{
                        $q->orWhere('store_id',$stores_id[$store]);
                    }
                }
            })
            ->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($q) {
                $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $data['offerscount'] = $data['filteredoffers']->total();
            $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
            return response()->json($data);
        }
        // stores_id = 0 && categories_id = []
        else if($_stores_id == 0 && $_categories_id != 0){
            $stores_id = explode(',',$_stores_id);
            $categories_id = explode(',',$_categories_id);
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where(function($q) use($stores_id, $categories_id){
                for($category=0; $category< count($categories_id); $category++){
                    if($category == 0){
                        $q->where('category_id',$categories_id[$category]);
                    }
                    else{
                        $q->orWhere('category_id',$categories_id[$category]);
                    }
                }
            })
            ->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($q) {
                $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $data['offerscount'] = $data['filteredoffers']->total();
            $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
            return response()->json($data);
        }
        // stores_id = 0 && categories_id = 0
        else if($_stores_id == 0 && $_categories_id == 0){
            $stores_id = explode(',',$_stores_id);
            $categories_id = explode(',',$_categories_id);
            $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($q) {
                $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
            ->orderBy('id','DESC')
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(2);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $data['offerscount'] = $data['filteredoffers']->total();
            $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
            return response()->json($data);
        }
    }
}
