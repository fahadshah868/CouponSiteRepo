<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Store;
use App\Category;

class BlogController extends Controller
{
    public function getAllBlogsList(){
        $data['allblogs'] = Blog::select('id','title','image_url','author')->where('status',1)->get();
        $data['topstores'] = Store::select('id','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
        $data['topcategories'] = Category::select('id','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.blog.allblogs',$data);
    }
}
