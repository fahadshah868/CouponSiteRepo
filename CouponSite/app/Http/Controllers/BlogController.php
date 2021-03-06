<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;
use App\Blog;
use App\BlogComment;
use Session;
use Redirect;
use URL;
use Validator;

class BlogController extends Controller
{
    public function getBlogsList(Request $request){
        if($request->ajax()){
            //search blogs by title using searchbar
            if($request->has('title')){
                $url = str_replace(' ', '-', $request->title);
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('url','LIKE','%'.$url.'%')
                ->where('is_active','y')
                ->simplePaginate(20);
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('partialviews.blogs',$data);
            }
            //get all blogs
            else{
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('is_active','y')
                ->simplePaginate(20);
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('partialviews.blogs',$data);
            }
        }
        else{
            //search blogs by title using searchbar
            if($request->has('title')){
                $url = str_replace(' ', '-', $request->title);
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('url','LIKE','%'.$url.'%')
                ->where('is_active','y')
                ->simplePaginate(20);
                $data['searched_blog_title'] = $request->title;
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('pages.blog.searchedblogs',$data);
            }
            //get all blogs in http request
            else{
                $data['allblogs'] = Blog::select('id','title','url','image_url','author')
                ->where('is_active','y')
                ->simplePaginate(20);
                $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
                return view('pages.blog.allblogs',$data);
            }
        }
    }
    public function getCategoryWiseBlogsList(Request $request, $category){
        if($request->ajax()){
            $data['allblogs'] = Blog::select('id','title','url','image_url','author')
            ->where('blog_category_id', $request->blog_category_id)
            ->where('is_active','y')
            ->simplePaginate(20);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('partialviews.blogs',$data);
        }
        else{
            $blogcategory = BlogCategory::where('url',$category)->where('is_active','y')->first();
            $data['allblogs'] = $blogcategory->blogs()->select('id','title','url','image_url','author')->where('is_active','y')->simplePaginate(20);
            $data['blog_category_id'] = $blogcategory->id;
            Session::flash('searched_category_title', $blogcategory->title);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('pages.blog.categorywiseblogs',$data);
        }
    }
    public function getReadblog(Request $request, $url){
        if($request->ajax()){
            $data['allblogs'] = Blog::select('id','title','url','image_url','author')
            ->whereNotIn('id',[$request->id])
            ->where('is_active','y')
            ->simplePaginate(20);
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            return view('partialviews.blogs',$data);
        }
        else{
            $data['blog'] = Blog::select('id','title','url','body','image_url','author')
            ->with(['comments' => function($q){
                $q->select('id','author','body','blog_id','created_at')
                ->where('status',2);
            }])
            ->where('url',$url)
            ->where('is_active','y')
            ->first();
            $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
            $data['allblogs'] = Blog::select('id','title','url','image_url','author')
            ->whereNotIn('id',[$data['blog']->id])
            ->where('is_active','y')
            ->simplePaginate(20);
            return view('pages.blog.readblog',$data);
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
