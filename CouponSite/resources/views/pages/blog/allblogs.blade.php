@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

    <div class="ab-main-container">
        @foreach($allblogs as $blog)
            <div class="ab-container">
                <a href="/blog/{{$blog->url}}">
                    <div class="ab-img-container">
                        <img src="{{$panel_assets_url.$blog->image_url}}">
                    </div>
                </a>
                <div class="ab-details-container">
                    <a class="ab-title" href="/blog/{{$blog->url}}">{{$blog->title}}</a>
                    <span class="ab-author">By {{$blog->author}}</span>
                </div>
            </div>
        @endforeach
    </div>

@endsection