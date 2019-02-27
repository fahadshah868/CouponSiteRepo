@extends('layouts.app_layout')

@section('title','All Categories')

@section('content')

<div class="all-categories-main-container">
    <div class="all-categories-main-heading">
        Browse Coupons By Category
    </div>
    <div class="ac-top-categories-container">
        <div class="ac-top-categories-heading">
            Top Categories
        </div>
        <div class="ac-top-categories-list-container">
            @foreach($topcategories as $topcategory)
            <div class="ac-top-category-container">
                <a href="/coupons/{{$topcategory->title}}}" class="ac-top-category-link">
                    <div class="ac-top-category-logo">
                        <img src="{{$panel_assets_url}}{{$topcategory->logo_url}}"/>
                    </div>
                    <div class="ac-top-category-title">{{$topcategory->title}}</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="ac-all-categories-container">
        <div class="ac-all-categories-list-heading">
            All Categories
        </div>
        <div class="ac-all-categories-list-container">
            <ul class="ac-all-categories-list">
                @foreach($allcategories as $category)
                <li>
                    <a class="all-categories-list-item" href="/coupons/{{$category->title}}" title="{{$category->title}} Coupons">
                        <span>{{$category->title}}</span>
                        @if(count($category->offer) == 1)
                        <span>{{count($category->offer)}} Coupon Available</span>
                        @elseif(count($category->offer) > 1)
                        <span>{{count($category->offer)}} Coupons Available</span>
                        @else
                        <span>No Coupons Available</span>
                        @endif                        
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection