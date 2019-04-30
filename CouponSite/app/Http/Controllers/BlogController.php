<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Store;
use App\Category;

class BlogController extends Controller
{
    public function getAllBlogsList(){
        $data['allblogs'] = Blog::select('id','title','url','image_url','author')->where('status',1)->get();
        $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
        $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.blog.allblogs',$data);
    }
    public function getReadBlog($url){
        $data['blog'] = Blog::select('id','title','body','image_url','author')->where('url',$url)->where('status',1)->first();
        $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
        $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.blog.readblog',$data);
    }
    public function getsearchBlog(Request $request){
        $url = str_replace(' ', '-', $request->title);
        $data['searchedblogs'] = Blog::select('id','title','url','body','image_url','author')->where('url','LIKE','%'.$url.'%')->where('status',1)->get();
        $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
        $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
        $data['searched_title'] = $request->title;
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.blog.searchedblogs',$data);
    }
}
