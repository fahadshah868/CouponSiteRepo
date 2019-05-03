<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Store;
use App\Category;
use App\BlogComment;

class BlogController extends Controller
{
    public function getBlogsList(Request $request){
        if($request->has('title')){
            $url = str_replace(' ', '-', $request->title);
            $data['searchedblogs'] = Blog::select('id','title','url','body','image_url','author')->where('url','LIKE','%'.$url.'%')->where('status',1)->get();
            $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
            $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
            $data['searched_title'] = $request->title;
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('pages.blog.searchedblogs',$data);
        }
        else{
            $data['allblogs'] = Blog::select('id','title','url','image_url','author')->where('status',1)->get();
            $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
            $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('pages.blog.allblogs',$data);
        }
    }
    public function getReadBlog($url){
        $data['blog'] = Blog::select('id','title','body','image_url','author')->where('url',$url)->where('status',1)->first();
        $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
        $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        $data['allblogs'] = Blog::select('id','title','url','image_url','author')->where('status',1)->get();
        return view('pages.blog.readblog',$data);
    }
    public function postBlogComment(Request $request){
        if($request->ajax()){
            $blogcomment = new BlogComment;
            $blogcomment->comment = $request->comment;
            $blogcomment->author = $request->author;
            $blogcomment->email = $request->email;
            $blogcomment->is_approved = 'no';
            $blogcomment->blog_id = $request->blog_id;
            $blogcomment->save();
            $response = [
                'status' => 'success',
                'message' => 'Your comment has been successfully received. Your comment will be visible after it is approved.',
            ];
            return response()->json($response);
        }
        else{
            $blogcomment = new BlogComment;
            $blogcomment->comment = $request->comment;
            $blogcomment->author = $request->author;
            $blogcomment->email = $request->email;
            $blogcomment->is_approved = 'no';
            $blogcomment->blog_id = $request->blog_id;
            $blogcomment->save();
            $data['blog'] = Blog::select('id','title','body','image_url','author')->where('url',$request->blog_title)->where('status',1)->first();
            $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
            $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $data['message'] = 'Your comment has been successfully received. Your comment will be visible after it is approved.';
            return view('pages.blog.readblog',$data);
        }
    }
}
