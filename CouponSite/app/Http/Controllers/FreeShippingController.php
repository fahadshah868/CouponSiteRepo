<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;
use App\StoreCategory;
use View;

class FreeShippingController extends Controller
{
    public function getAllFreeShippingOffers(Request $request){
        $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
        ->with(['store' => function($sq){
            $sq->select('id','title','logo_url');
        }])
        ->whereHas('store', function($sq){
            $sq->where('is_active','y');
        })
        ->where('is_active','y')
        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
        ->where(function($q){
            $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null);
        })
        ->where('free_shipping',1)
        ->orderBy('id','DESC')
        ->orderBy('is_popular','ASC')
        ->orderBy('anchor','DESC')
        ->paginate(2);
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        if($request->ajax()){
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
        else{
            $data['stores'] = Store::select('id','title')
            ->whereHas('offers', function($q){
                $q->where('is_active','y')
                ->where('free_shipping',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($q){
                    $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            })
            ->where('is_active','y')
            ->orderBy('is_topstore','ASC')
            ->orderBy('is_popularstore','ASC')
            ->get();
            $data['categories'] = Category::select('id','title')
            ->whereHas('offers', function($q){
                $q->where('is_active','y')
                ->where('free_shipping',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($q){
                    $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            })
            ->where('is_active','y')
            ->orderBy('is_topcategory','ASC')
            ->orderBy('is_popularcategory','ASC')
            ->get();
            return view('pages.freeshipping.allfreeshippingoffers',$data);
        }
    }
    public function getFilteredFreeShippingOffers(Request $request){
        if($request->filtertype != -1){
            $data = $this->getRelatedAssets($request);
        }
        // stores_id = [] && categories_id = []
        if($request->stores_id != 0 && $request->categories_id != 0){
            $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
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
            ->where('free_shipping',1)
            ->where('is_active','y')
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
            $data['offerscount'] = $data['offers']->total();
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
        // stores_id = [] && categories_id = 0
        else if($request->stores_id != 0 && $request->categories_id == 0){
            $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
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
            ->where('free_shipping',1)
            ->where('is_active','y')
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
            $data['offerscount'] = $data['offers']->total();
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
        // stores_id = 0 && categories_id = []
        else if($request->stores_id == 0 && $request->categories_id != 0){
            $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
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
            ->where('free_shipping',1)
            ->where('is_active','y')
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
            $data['offerscount'] = $data['offers']->total();
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
        // stores_id = 0 && categories_id = 0
        else if($request->stores_id == 0 && $request->categories_id == 0){
            $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
            ->with(['store' => function($sq){
                $sq->select('id','title','logo_url');
            }])
            ->where('free_shipping',1)
            ->where('is_active','y')
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
            $data['offerscount'] = $data['offers']->total();
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
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
                ->with(['category'=>function($q) use($request){
                    $q->select('id','title')
                    ->whereHas('offers', function($sq) use($request){
                        $sq->where('is_active','y')
                        ->where('free_shipping',1)
                        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                        ->where(function($q){
                            $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                            ->orWhere('expiry_date', null);
                        });
                    });
                }])
                ->whereHas('category', function($q){
                    $q->select('id')->where('is_active','y');
                })->get();
            }
            //get all top OR popular categories
            else{
                $data['categories'] = Category::select('id','title')
                ->whereHas('offers', function($sq) use($request){
                    $sq->where('is_active','y')
                    ->where('free_shipping',1)
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where(function($q){
                        $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                    });
                })
                ->where('is_active','y')
                ->orderBy('is_topcategory','ASC')
                ->orderBy('is_popularcategory','ASC')
                ->get();
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
                ->with(['store'=>function($q) use($request){
                    $q->select('id','title')
                    ->whereHas('offers', function($sq) use($request){
                        $sq->where('is_active','y')
                        ->where('free_shipping',1)
                        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                        ->where(function($q){
                            $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                            ->orWhere('expiry_date', null);
                        });
                    });
                }])
                ->whereHas('store', function($q){
                    $q->select('id')->where('is_active','y');
                })->get();
            }
            //get all stores
            else{
                $data['stores'] = Store::select('id','title')
                ->whereHas('offers', function($sq) use($request){
                    $sq->where('is_active','y')
                    ->where('free_shipping',1)
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where(function($q){
                        $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                    });
                })
                ->where('is_active','y')
                ->orderBy('is_topstore','ASC')
                ->orderBy('is_popularstore','ASC')
                ->get();
            }
        }
        //get all stores AND categories
        else if($request->filtertype == 0){
            // get stores which has online code offers 
            $data['stores'] = Store::select('id','title')
            ->whereHas('offers', function($sq) use($request){
                $sq->where('is_active','y')
                ->where('free_shipping',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($q){
                    $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            })
            ->where('is_active','y')
            ->orderBy('is_topstore','ASC')
            ->orderBy('is_popularstore','ASC')
            ->get();
            // get categories which has online code offers
            $data['categories'] = Category::select('id','title')
            ->whereHas('offers', function($sq) use($request){
                $sq->where('is_active','y')
                ->where('free_shipping',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($q){
                    $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            })
            ->where('is_active','y')
            ->orderBy('is_topcategory','ASC')
            ->orderBy('is_popularcategory','ASC')
            ->get();
        }
        return $data;
    }
}
