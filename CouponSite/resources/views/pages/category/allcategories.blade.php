@extends('layouts.app_layout')

@section('title','All Categories')

@section('content')

<div class="ac-main-container">
    <div class="ac-main-heading">
        Browse Coupons By Category
    </div>
    <div class="tc-main-container">
        <div class="tc-heading">
            Top Categories
        </div>
        <div class="tc-list-container">
            @foreach($topcategories as $topcategory)
            <div class="tc-container">
                <a href="/coupons/{{$topcategory->url}}}" class="tc-link">
                    <div class="tc-logo">
                        <img src="{{$panel_assets_url}}{{$topcategory->logo_url}}"/>
                    </div>
                    <div class="tc-title">{{$topcategory->title}}</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="ac-mega-container">
        <span class="ac-main-heading">All Categories & Coupons</span>
        <div class="ac-container">
            <div class="letters-dropdown" id="letters-dropdown">
                <div class="select">
                    <span>ALL</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <ul class="dropdown-menu">
                    <li class="active">ALL</li>
                    @foreach($filtered_letters as $filtered_letter => $val)
                        <li>{{$filtered_letter}}</li>
                    @endforeach
                </ul>
            </div>
            <ul class="ac-letters-navbar" id="ac-letters-navbar">
                <li class="ac-letters-navbar-item"><span class="ac-navbar-letter active-navbar-letter">ALL</span></li>
                @foreach($filtered_letters as $filtered_letter => $val)
                    <li class="ac-letters-navbar-item"><span class="ac-navbar-letter">{{$filtered_letter}}</span></li>
                @endforeach
            </ul>
            <ul class="ac-list" id="ac-list">
                @foreach($allcategories as $category)
                <li>
                    <a class="ac-list-item" href="/coupons/{{$category->url}}" title='{{$category->title}} Coupons'>
                        <span class="category-title">{{$category->title}}</span>
                        @if($category->offers_count > 1)
                            <span class="coupons-count">{{$category->offers_count}} Coupons Available</span>
                        @elseif($category->offers_count == 1)
                            <span class="coupons-count">{{$category->offers_count}} Coupon Available</span>
                        @else
                            <span class="coupons-count">No Coupons Available</span>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(document).ready(function(){
        //letters navbar
        $(`#ac-letters-navbar`).on(`click`,`.ac-letters-navbar-item .ac-navbar-letter`,function(){
            $(`.ac-navbar-letter`).removeClass(`active-navbar-letter`);
            $(this).addClass(`active-navbar-letter`);
            var searched_character = $(this).text();
            // set dropdown selected option
            $('#letters-dropdown .select span').text($(this).text());
            $('#letters-dropdown .dropdown-menu li').removeClass('active');
            $('#letters-dropdown .dropdown-menu li').each(function(index, value){
                if( $(value).text().toUpperCase() == searched_character.toUpperCase()) {
                    $(this).addClass('active');
                }
            });
            if(searched_character.toUpperCase() == `ALL`){
                $(`#ac-list li`).show();
            }
            else if(searched_character == `0-9`){
                $(`#ac-list .category-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if($.isNumeric(current_character)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }
            else{
                $(`#ac-list .category-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if( current_character.toUpperCase().indexOf(searched_character.toUpperCase()) > -1) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }
        });
        //letters dropdown
        $(`#letters-dropdown`).on(`click`,`.dropdown-menu li`,function(){
            var searched_character = $(this).text();
            $(`.ac-navbar-letter`).removeClass(`active-navbar-letter`);
            $(`.ac-navbar-letter`).each(function(index, value){
                if( $(value).text().toUpperCase() == searched_character.toUpperCase()) {
                    $(this).addClass('active-navbar-letter');
                }
            });
            if(searched_character.toUpperCase() == `ALL`){
                $(`#ac-list li`).show();
            }
            else if(searched_character == `0-9`){
                $(`#ac-list .category-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if($.isNumeric(current_character)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }
            else{
                $(`#ac-list .category-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if( current_character.toUpperCase().indexOf(searched_character.toUpperCase()) > -1) {
                    $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }
        });
    });
</script>
@endsection