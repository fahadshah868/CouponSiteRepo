<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;

class FilteredOfferController extends Controller
{
    public function getFilteredOffers($filter){
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
            $data['category'] = Category::select('id','title')->where('title',$filter)->where('status',1)->first()
            ->offers()->select('id','store_id','category_id','title','details','expiry_date','location','type','is_verified')
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
            ->orderBy('is_popular','ASC')
            ->orderBy('anchor','DESC')
            ->paginate(1);
            return view('pages.filteredoffer.filteredoffers',$data);
        }
    }
}
