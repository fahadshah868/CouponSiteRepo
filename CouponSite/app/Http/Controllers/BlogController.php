<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;
use App\Blog;
use App\Store;
use App\Category;
use App\BlogComment;
use Session;
use Redirect;
use URL;
use Validator;

class BlogController extends Controller
{
    public function getBlogsList(Request $request){
        if($request->ajax()){
            $data['allblogs'] = Blog::select('id','title','url','image_url','author')
            ->where('status',1)
            ->simplePaginate(3);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('partialviews.allblogs',$data);
        }
        else{
            //search blogs by title using searchbar
            if($request->has('title')){
                $url = str_replace(' ', '-', $request->title);
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('url','LIKE','%'.$url.'%')
                ->where('status',1)
                ->simplePaginate(3);
                $data['blogcategories'] = BlogCategory::select('id','title','url')->where('status',1)->get();
                $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
                $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
                Session::flash('searched_blog_message', 'Searched Results For '.$request->title);
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('pages.blog.filteredblogs',$data);
            }
            //get all blogs in http request
            else{
                $data['blogcategories'] = BlogCategory::select('id','title','url')->where('status',1)->get();
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('status',1)
                ->simplePaginate(3);
                $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->orWhere('is_popularstore',1)->limit(9)->get();
                $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('pages.blog.allblogs',$data);
            }
        }
    }
    public function getfilteredblogs(Request $request, $url){
        if($request->ajax()){
            if($request->remark == 1){      //get category wise blogs using pagination
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('blog_category_id',$request->blog_category_id)
                ->where('status',1)
                ->simplePaginate(3);
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('partialviews.allblogs',$data);
            }
            else if($request->remark == 2){     //get all blogs using pagination
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->whereNotIn('id',[$request->id])
                ->where('status',1)
                ->simplePaginate(3);
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('partialviews.allblogs',$data);
            }
        }
        else{
            $flag = false;
            $filtereddata['allblogs'] = null;
            $filtereddata['blog_category_id'] = null;
            $filtereddata['blogcategories'] = BlogCategory::select('id','title','url')->where('status',1)->get();
            foreach($filtereddata['blogcategories'] as $blogcategory){
                if(strcasecmp($blogcategory->url ,str_replace(' ', '-', $url)) == 0){
                    $flag = true;
                    $filtereddata['allblogs'] = $blogcategory->blogs()->select('id','title','url','image_url','author')->where('status',1)->simplePaginate(3);
                    $filtereddata['blog_category_id'] = $blogcategory->id;
                    Session::flash('searched_blogs_header', $blogcategory->title);
                    break;
                }
            }
            if($flag){
                $filtereddata['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->limit(9)->get();
                $filtereddata['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
                $filtereddata['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('pages.blog.filteredblogs',$filtereddata);
            }
            else{
                $data['blog'] = Blog::select('id','title','url','body','image_url','author')
                ->with(['comments' => function($q){
                    $q->select('id','author','body','blog_id','created_at')
                    ->where('status',2);
                }])
                ->where('url',$url)
                ->where('status',1)
                ->first();
                $data['blogcategories'] = BlogCategory::select('id','title','url')->where('status',1)->get();
                $data['topstores'] = Store::select('id','title','secondary_url','logo_url')->where('status',1)->where('is_topstore',1)->limit(9)->get();
                $data['topcategories'] = Category::select('id','title','url','logo_url')->where('status',1)->where('is_topcategory',1)->limit(9)->get();
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->whereNotIn('id',[$data['blog']->id])
                ->where('status',1)
                ->simplePaginate(3);
                return view('pages.blog.readblog',$data);
            }
        }
    }
    public function postBlogComment(Request $request){
        if($request->ajax()){
            $blogcomment = new BlogComment;
            $blogcomment->body = $request->body;
            $blogcomment->author = $request->author;
            $blogcomment->email = $request->email;
            $blogcomment->status = "pending";
            $blogcomment->blog_id = $request->blog_id;
            $blogcomment->save();
            $response = [
                'status' => 'success',
                'message' => 'Your comment has been successfully received. Your comment will be visible after it is approved.',
            ];
            return response()->json($response);
        }
        else{
            $validator = Validator::make($request->all(),
                [
                    'email'=>'required|email',
                ]
            );
            if($validator->fails()){
                Session::flash('validation_message','Please Enter A valid Email');
                return Redirect::to(URL::previous() . "#post-comment");
            }
            $blogcomment = new BlogComment;
            $blogcomment->body = $request->body;
            $blogcomment->author = $request->author;
            $blogcomment->email = $request->email;
            $blogcomment->status = "pending";
            $blogcomment->blog_id = $request->blog_id;
            $blogcomment->save();
            Session::flash('comment_message','Your comment has been successfully received. Your comment will be visible after it is approved.');
            return Redirect::to(URL::previous() . "#post-comment");
        }
    }
}
