<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
}
