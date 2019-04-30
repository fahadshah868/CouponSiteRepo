@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

    <div class="ab-main-container">
        @foreach($allblogs as $blog)
            <div class="ab-container">
                <a class="ab-img-container" href="/blog/{{$blog->url}}">
                    <img src="{{$panel_assets_url.$blog->image_url}}">
                </a>
                <div class="ab-details-container">
                    <a class="ab-title" href="/blog/{{$blog->url}}">{{$blog->title}}</a>
                    <span class="ab-author">By {{$blog->author}}</span>
                </div>
            </div>
        @endforeach
    </div>

@endsection