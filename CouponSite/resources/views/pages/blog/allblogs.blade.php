@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

<div style="width: 100%; margin: 30px 0;">
    <div style="width: 1150px; margin: auto; display: flex; flex-direction: row; flex-wrap: wrap;">
        <div style="width: 800px; padding: 30px; display: flex; flex-direction: column;">
            @foreach($allblogs as $blog)
            <div style="display: flex; flex-direction: row; flex-wrap: nowrap; margin-bottom: 10px; border-radius: 5px;">
                <a href="/blog/{{$blog->title}}" style="width: 405px; height: 225px;">
                    <img style="width: 100%; height: 100%;" src="{{$panel_assets_url.$blog->image_url}}">
                </a>
                <div style="display: flex; flex-direction: column; padding: 5px 20px; color: #555;">
                    <a href="/blog/{{$blog->title}}" style="margin-bottom: 10px; font-size: 20px; font-weight: 500;">{{$blog->title}}</a>
                    <span style="font-size: 12px; font-weight: 500;">By {{$blog->author}}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div style="width: 350px; display: flex; flex-direction: column;">
            <div style="width: 100%; padding: 20px 30px; margin-bottom: 20px; background-color: #fff; border-radius: 5px;">
                <div style="font-size: 16px; font-weight: 500; margin-bottom: 15px;">Popular Stores</div>
                <div style="display: flex; flex-wrap: wrap;">
                    @foreach($topstores as $store)
                    <a href="/store/{{$store->secondary_url}}" style="width: calc(33% - 10px); height: auto; margin: 0 7px 7px 0;">
                        <img src="{{$panel_assets_url.$store->logo_url}}" style="width: 100%; height: 100%; border: 1px solid #f1f1f1;">
                    </a>
                    @endforeach
                </div>
            </div>
            <div style="width: 100%; padding: 30px; background-color: #fff; border-radius: 5px;">
                <div style="font-size: 16px; font-weight: 500; margin-bottom: 15px;">Popular Categories</div>
                <div style="display: flex; flex-wrap: wrap;">
                    @foreach($topcategories as $category)
                    <a href="/coupons/{{$category->url}}" style="width: calc(33% - 10px); height: auto; margin: 0 7px 7px 0;">
                        <img src="{{$panel_assets_url.$category->logo_url}}" style="width: 100%; height: 100%; border: 1px solid #f1f1f1;">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection