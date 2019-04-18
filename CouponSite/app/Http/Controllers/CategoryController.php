<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function getAllCategoriesList(){
        $data['topcategories'] = Category::where('is_topcategory','yes')->where('status',1)->get();
        $data['allcategories'] = Category::where('status',1)->orderBy('title','ASC')->with(['offers' => function($q){
            $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
            ->where('expiry_date', '>=', config('constants.TODAY_DATE'))
            ->where('status',1);
        }])->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.category.allcategories',$data);
    }
}
