<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Offer;
use App\Blog;

class HomeController extends Controller
{
    public function home(){
        $data['topstores'] = Store::select('id','secondary_url','logo_url')->where('is_topstore',1)->where('status',1)->get();
        $data['offers'] = Offer::select('id','title','details','location','type','code','expiry_date','store_id')
            ->with(['store' => function($q){
                $q->select('id','title','secondary_url','logo_url','network_url');
            }])
            ->whereHas('store', function($q){
                $q->where('status',1);
            })
            ->where('display_at_home',1)
            ->where('status',1)
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null)
            ->orderBy('id','DESC')
            ->skip(0)
            ->limit(4)
            ->get();
        $data['popularstores'] = Store::select('id','title','secondary_url')
            ->where('is_topstore',1)->orWhere('is_popularstore',1)->where('status',1)
            ->withCount(['offers' => function($q){
                $q->where('status',1)
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                ->orWhere('expiry_date', null);
            }])->limit(24)->get();
        $data['latestblogs'] = Blog::select('id','title','image_url')->where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.home',$data);
    }
    public function getLoadMoreOffers($rowscount){
        $response['offers'] = Offer::select('id','title','details','location','type','code','expiry_date','store_id')
        ->with(['store' => function($q){
            $q->select('id','title','secondary_url','logo_url','network_url');
        }])
        ->whereHas('store', function($q){
           $q->where('status',1);
        })
        ->where('display_at_home',1)
        ->where('status',1)
        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
        ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
        ->orWhere('expiry_date', null)
        ->orderBy('id','DESC')
        ->skip($rowscount)
        ->limit(4)
        ->get();
        $response['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return response()->json($response);
    }
}
