@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

<div style="width: 100%;">
    <div style="position: relative;">
        <img style="width: 100%; height: auto;" src="{{$panel_assets_url.$blog->image_url}}">
        <div class="overlay" style="position: absolute; bottom: 0; background-color: rgba(0,0,0, 0.7); overflow: hidden; width: 100%; height: 150px;">
            <div style="padding: 20px; display: flex; flex-wrap: wrap; justify-content: center; font-size: 32px; font-weight: 400; color: #fff;">{{$blog->title}}</div>
        </div>
    </div>
    <div style="padding: 20px;">
    {!! $blog->body !!}
    </div>
</div>

@endsection