<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;
use App\StoreCategory;
use View;
use Session;

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
            Session::flash('filter',2);
            if($request->ajax()){
                $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
                return response()->json($data);
            }
            else{
                $data['stores'] = Store::select('id','title')
                ->where('status',1)->where('is_topstore',1)->where('is_popularstore',1)->get();
                $data['categories'] = Category::select('id','title')
                ->where('status',1)->where('is_topcategory',1)->orwhere('is_popularcategory',1)->get();
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
            Session::flash('filter',3);
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
            Session::flash('filter',4);
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
            Session::flash('filter',1);
            if($request->ajax()){
                $data['partialview'] = (string)View::make('partialviews.filteredoffers',$data);
                return response()->json($data);
            }
            else{
                $data['storecategories'] = StoreCategory::select('store_id')->where('category_id',$data['category']->id)
                ->with(['store' => function($q){
                    $q->select('id','title')
                    ->withCount(['offers' => function($sq){
                        $sq->where('status',1)
                        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                        ->where(function($sq){
                            $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                            ->orWhere('expiry_date', null);
                        });
                    }]);
                }])
                ->get();
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
    public function getMoreFilteredOffers(Request $request){
        //fetch category offers------------------------------------------------------------------------
        if($request->filter == 1){
            // stores_id = [] && categories_id = []
            if($request->stores_id != 0){
                $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','title','logo_url');
                }])
                ->where(function($q) use($request){
                    for($store = 0; $store < count($request->stores_id); $store++){
                        if($store == 0){
                            $q->where('store_id',$request->stores_id[$store])->where('category_id',$request->category_id);
                        }
                        else{
                            $q->orWhere('store_id',$request->stores_id[$store])->where('category_id',$request->category_id);
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
            else if($request->stores_id == 0){
                $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','title','logo_url');
                }])
                ->where('category_id',$request->category_id)
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
        //fetch online codes------------------------------------------------------------------------
        else if($request->filter == 2){
            if($request->filtertype != -1){
                $data = $this->getRelatedAssets($request);
            }
            // stores_id = [] && categories_id = []
            if($request->stores_id != 0 && $request->categories_id != 0){
                $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','title','logo_url');
                }])
                ->where(function($q) use($request){
                    for($store = 0; $store < count($request->stores_id); $store++){
                        for($category=0; $category< count($request->categories_id); $category++){
                            if($store == 0 && $category == 0){
                                $q->where(function($sq) use($request, $store, $category){
                                    $sq->where('store_id',$request->stores_id[$store])->where('category_id',$request->categories_id[$category]);
                                });
                            }
                            else{
                                $q->orWhere(function($sq) use($request, $store, $category){
                                    $sq->orWhere('store_id',$request->stores_id[$store])->where('category_id',$request->categories_id[$category]);
                                });
                            }
                        }
                    }
                })
                ->whereIn('location',[1,3])
                ->where('type',1)
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
            else if($request->stores_id != 0 && $request->categories_id == 0){
                $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','title','logo_url');
                }])
                ->where(function($q) use($request){
                    for($store = 0; $store < count($request->stores_id); $store++){
                        if($store == 0){
                            $q->where('store_id',$request->stores_id[$store]);
                        }
                        else{
                            $q->orWhere('store_id',$request->stores_id[$store]);
                        }
                    }
                })
                ->whereIn('location',[1,3])
                ->where('type',1)
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
            else if($request->stores_id == 0 && $request->categories_id != 0){
                $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','title','logo_url');
                }])
                ->where(function($q) use($request){
                    for($category=0; $category< count($request->categories_id); $category++){
                        if($category == 0){
                            $q->where('category_id',$request->categories_id[$category]);
                        }
                        else{
                            $q->orWhere('category_id',$request->categories_id[$category]);
                        }
                    }
                })
                ->whereIn('location',[1,3])
                ->where('type',1)
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
            else if($request->stores_id == 0 && $request->categories_id == 0){
                $data['filteredoffers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
                ->with(['store' => function($sq){
                    $sq->select('id','title','logo_url');
                }])
                ->whereIn('location',[1,3])
                ->where('type',1)
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
        //fetch online sales------------------------------------------------------------------------
        else if($request->filter == 3){

        }
        //fetch free shipping offers------------------------------------------------------------------------
        else if($request->filter == 4){

        }
    }
    public function getRelatedAssets(Request $request){
        $data['storecategories'] = null;
        $data['categories'] = null;
        $data['stores'] = null;
        //get related categories
        if($request->filtertype == 1){
            //get related categories
            if($request->stores_id != 0){
                $data['storecategories'] = StoreCategory::select('store_id','category_id')
                ->where(function($q) use($request){
                    for($store = 0; $store < count($request->stores_id); $store++){
                        if($store == 0){
                            $q->where('store_id',$request->stores_id[$store]);
                        }
                        else{
                            $q->orWhere('store_id',$request->stores_id[$store]);
                        }
                    }
                })
                ->groupBy('category_id')
                ->with(['category'=>function($q){
                    $q->select('id','title');
                }])
                ->whereHas('category', function($q){
                    $q->select('id')->where('status',1);
                })->get();
            }
            //get all top OR popular categories
            else{
                $data['categories'] = Category::select('id','title')
                ->where('status',1)->where('is_topcategory',1)->orwhere('is_popularcategory',1)->get();
            }
        }
        //get related stores
        else if($request->filtertype == 2){
            //get related categories
            if($request->categories_id != 0){
                $data['storecategories'] = StoreCategory::select('store_id','category_id')
                ->where(function($q) use($request){
                    for($category = 0; $category < count($request->categories_id); $category++){
                        if($category == 0){
                            $q->where('category_id',$request->categories_id[$category]);
                        }
                        else{
                            $q->orWhere('category_id',$request->categories_id[$category]);
                        }
                    }
                })
                ->groupBy('store_id')
                ->with(['store'=>function($q){
                    $q->select('id','title');
                }])
                ->whereHas('store', function($q){
                    $q->select('id')->where('status',1);
                })->get();
            }
            //get all stores
            else{
                $data['stores'] = Store::select('id','title')
                ->where('status',1)->where('is_topstore',1)->orwhere('is_popularstore',1)->get();
            }
        }
        //get all stores AND categories
        else if($request->filtertype == 0){
            $data['stores'] = Store::select('id','title')
            ->where('status',1)->where('is_topstore',1)->orwhere('is_popularstore',1)->get();
            $data['categories'] = Category::select('id','title')
            ->where('status',1)->where('is_topcategory',1)->orwhere('is_popularcategory',1)->get();
        }
        return $data;
    }
}
