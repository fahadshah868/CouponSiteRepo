@extends('layouts.app_layout')

@section('title','All Categories')

@section('content')

<div class="all-categories-main-container">
    <div class="all-categories-main-heading">
        Browse Coupons By Category
    </div>
    <div class="ac-popular-stores-container">
        <div class="ac-popular-stores-heading">
            Popular Categories
        </div>
        <div class="ac-popular-stores-list-container">
            @for($i=1; $i<=10; $i++)
            <div class="ac-popular-store-container">
                <a href="#">
                    <div class="ac-popular-store-logo">
                        <img src="data:image/png;base64,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"/>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
    <div class="all-categories-list-container">
        <div class="all-categories-list-heading">
            Categories List
        </div>
        <div class="all-categories-list">
            <ul>
                @for($i=1; $i<= 40; $i++)
                    <li>
                        <div class="all-categories-names-container">
                            <div class="all-categories-list-bullets">&#9654</div>
                            <div class="all-categories-names"><a href="#">Clothing</a></div>
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</div>

@endsection