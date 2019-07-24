<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\Offer;
use App\Blog;
use App\CarouselOffer;

class HomeController extends Controller
{
    public function home(){
        $data['carouseloffers'] = CarouselOffer::select('id','title','location','type','code','starting_date','expiry_date','image_url','store_id')
            ->with(['store' => function($q){
                $q->select('id','title','secondary_url','logo_url','network_url');
            }])
            ->whereHas('store', function($q){
                $q->where('is_active','y');
            })
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
        ->orderBy('id','DESC')
        ->get();
        $data['topstores'] = Store::select('id','secondary_url','logo_url')->where('is_topstore',1)->where('is_active','y')->get();
        $data['offers'] = Offer::select('id','title','details','location','type','code','expiry_date','store_id')
            ->with(['store' => function($q){
                $q->select('id','title','secondary_url','logo_url','network_url');
            }])
            ->whereHas('store', function($q){
                $q->where('is_active','y');
            })
            ->where('display_at_home',1)
            ->where('is_active','y')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            })
        ->orderBy('id','DESC')
        ->simplePaginate(20);
        $data['popularstores'] = Store::select('id','title','secondary_url')
        ->where('is_popularstore',1)->where('is_active','y')
        ->withCount(['offers' => function($q){
            $q->where('is_active','y')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            });
        }])->limit(24)->get();
        $data['popularcategories'] = Category::select('id','title','url')
        ->where('is_popularcategory',1)->where('is_active','y')
        ->withCount(['offers' => function($q){
            $q->where('is_active','y')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where(function($sq){
                $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            });
        }])->limit(24)->get();
        $data['latestblogs'] = Blog::select('id','url','title','image_url')->where('is_active','y')->orderBy('id','DESC')->limit(3)->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.home',$data);
    }
    public function getLoadMoreOffers(){
        $response['offers'] = Offer::select('id','title','details','location','type','code','expiry_date','store_id')
        ->with(['store' => function($q){
            $q->select('id','title','secondary_url','logo_url','network_url');
        }])
        ->whereHas('store', function($q){
           $q->where('is_active','y');
        })
        ->where('display_at_home',1)
        ->where('is_active','y')
        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
        ->where(function($sq){
            $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null);
        })
        ->orderBy('id','DESC')
        ->simplePaginate(20);
        $response['hasmorepage'] = $response['offers']->hasMorePages();
        $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return response()->json($response);
    }
}
