<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function getAllCategoriesList(){
        $data['topcategories'] = Category::where('is_topcategory','yes')->where('status','active')->get();
        $data['allcategories'] = Category::where('status','active')->orderBy('title','ASC')->with(['offer' => function($q){
            $q->where('starting_date', '<=', config('constants.today_date'))
            ->where('expiry_date', '>=', config('constants.today_date'))
            ->where('status','active');
        }])->get();
        $data['panel_assets_url'] = env('PANEL_ASSETS_URL');
        return view('pages.category.allcategories',$data);
    }
}
