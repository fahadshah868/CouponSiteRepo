<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Offer;

class HomeController extends Controller
{
    public function home(){
        $data['topstores'] = Store::select('id','secondary_url','logo_url')->where('is_topstore','yes')->where('status','active')->get();
        $data['offers'] = Offer::select('title','type','location','store_id')->where('display_at_home','yes')->where('status','active')->limit(12)->with(['store' => function($q){
            $q->select('id','title','secondary_url','logo_url');
        }])->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.home',$data);
    }
}
