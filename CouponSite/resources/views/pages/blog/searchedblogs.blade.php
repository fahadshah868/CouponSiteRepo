@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

    <div class="ab-main-container">
        <div style="font-style: italic; font-size: 22px; font-weight: 500;">Search Results For "{{ $searched_title }}"</div>
        <hr>
        @if(count($searchedblogs) > 0)
            @foreach($searchedblogs as $searchedblog)
                <div class="ab-container">
                    <a class="ab-img-container" href="/blog/{{$searchedblog->url}}">
                        <img src="{{$panel_assets_url.$searchedblog->image_url}}">
                    </a>
                    <div class="ab-details-container">
                        <a class="ab-title" href="/blog/{{$searchedblog->url}}">{{$searchedblog->title}}</a>
                        <span class="ab-author">By {{$searchedblog->author}}</span>
                    </div>
                </div>
            @endforeach
        @else
            <div style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 30px;">
                <div style="font-style: italic; font-size: 22px; font-weight: 500;">Sorry! No Result Found</div>
            </div>
        @endif
    </div>

@endsection