<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;
use App\StoreCategory;
use View;

class CategoryController extends Controller
{
    public function getAllCategoriesList(){
        $data['topcategories'] = Category::where('is_topcategory','yes')->where('status',1)->get();
        $data['allcategories'] = Category::where('status',1)->orderBy('title','ASC')->withCount(['offers' => function($q){
            $q->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orwhere('expiry_date', null);
            });
        }])->get();
        $data['filtered_letters'] = $data['allcategories']->groupBy(function ($item, $key) {
            $letter = substr(strtoupper($item->title), 0, 1);
            if(is_numeric($letter)){
                return "0-9";
            }
            else{
                return $letter;
            }
        })->toArray();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.category.allcategories',$data);
    }
    public function getCategoryOffers(Request $request, $category){
        $data['category'] = Category::select('id','title','description')->where('url',$category)->where('status',1)->first();
        $data['offers'] = $data['category']->offers()
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
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
        else{
            $data['relatedstores'] = Store::select('id','title')
                ->where('status',1)
                ->whereHas('offers',function($q) use($data){
                $q->where('category_id',$data['category']->id)
                ->where('status',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($q){
                    $q->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            })->get();
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
    public function getFilteredCategoryOffers(Request $request){
        // stores_id = [] && categories_id = []
        if($request->stores_id != 0){
            $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
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
            $data['offerscount'] = $data['offers']->total();
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
        // stores_id = 0 && categories_id = []
        else if($request->stores_id == 0){
            $data['offers'] = Offer::select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
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
            $data['offerscount'] = $data['offers']->total();
            $data['partialview'] = (string)View::make('partialviews.offers',$data);
            return response()->json($data);
        }
    }
}
