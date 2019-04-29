<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function getAllBlogsList(){
        $data['allblogs'] = Blog::select('id','title','image_url')->where('status',1)->get();
        return view('pages.blog.allblogs',$data);
    }
}
