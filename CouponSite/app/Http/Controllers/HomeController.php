<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Offer;

class HomeController extends Controller
{
    public function home(){
        $data['topstores'] = Store::select('id','secondary_url','logo_url')->where('is_topstore','yes')->where('status','active')->get();
        $data['offers'] = Offer::select('title','type','location','store_id')
            ->where('display_at_home','yes')
            ->where('status','active')
            ->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->orWhere('expiry_date', null)
            ->orderBy('id','DESC')
            ->limit(12)->with(['store' => function($q){
                $q->select('id','title','secondary_url','logo_url');
            }])
            ->whereHas('store', function($q){
            $q->where('status','active');
        })->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.home',$data);
    }
    public function getLoadMoreOffers($id){
        $response['offers'] = Offer::where('display_at_home','yes')->where('status','active')
        ->where('id','<',$id)
        ->where('starting_date', '<=', config('constants.TODAY_DATE'))
        ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
        ->orWhere('expiry_date', null)
        ->orderBy('id','DESC')
        ->limit(12)->with(['store' => function($q){
            $q->select('id','title','secondary_url','logo_url');
        }])
        ->whereHas('store', function($q){
           $q->where('status','active');
        })->get();
        return response()->json($response);
    }
}
