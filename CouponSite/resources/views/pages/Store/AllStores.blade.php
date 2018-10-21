@extends('layouts.app_layout')

@section('title','All Stores')

@section('content')

<div class="all-stores-main-container">
    <div class="all-stores-main-heading">
        Browse Coupons By Store
    </div>
    <div class="as-popular-stores-container">
        <div class="as-popular-stores-heading">
            Popular Stores
        </div>
        <div class="as-popular-stores-list-container">
            @for($i=1; $i<=10; $i++)
            <div class="as-popular-store-container">
                <a href="#">
                    <div class="as-popular-store-logo">
                        <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg"/>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
    <div class="all-stores-list-container">
        <div class="all-stores-list-heading">
            Stores List
        </div>
        <div class="all-stores-list">
            <ul>
                @for($i=1; $i<= 100; $i++)
                    <li><span class="all-stores-list-bullets">&#9654;</span><a href="#">Kohl's</a></li>
                @endfor
            </ul>
        </div>
    </div>
</div>

@endsection