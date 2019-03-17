@extends('layouts.app_layout')

@section('title','All Stores')

@section('content')

<div class="all-stores-main-container">
    <div class="all-stores-main-heading">
        Browse Coupons By Store
    </div>
    <div class="as-top-stores-container">
        <div class="as-top-stores-heading">
            Top Stores
        </div>
        <div class="as-top-stores-list-container">
            @foreach($topstores as $topstore)
            <div class="as-top-store-container">
                <a href="/store/{{$topstore->secondary_url}}" class="as-top-store-link">
                    <div class="as-top-store-logo">
                        <img src="{{$panel_assets_url}}{{$topstore->logo_url}}"/>
                    </div>
                    <div class="as-top-store-title">{{$topstore->title}}</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="as-allstores-container" id="as-allstores-container">
        <div class="as-category-outer-container" id="as-category-outer-container">
            <div class="as-category-inner-container" id="as-category-inner-container">
                <span class="as-category-heading">Filter Stores By Category</span>
                <div class="as-categories-container">
                    <ul class="as-categories-list">
                        <li class="as-categories-list-item active" title="All Stores">
                            <span>All Stores</span>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        @foreach($allcategories as $category)
                        <li class="as-categories-list-item" title="{{$category->title}} Stores & Coupons">
                            <a href="{{$category->id}}/stores">{{$category->title}}</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="as-filtered-stores-body-container">
            <span class="as-filtered-stores-heading">All Stores</span>
            <div class="as-filtered-stores-container">
                <div class="as-filtered-stores-letters-dropdown" id="as-filtered-stores-letters-dropdown">
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
                <ul class="as-filtered-stores-navbar" id="as-filtered-stores-navbar">
                    <li class="as-filtered-stores-navbar-item"><span class="as-filtered-stores-letter active-filtered-stores-letter">ALL</span></li>
                    @foreach($filtered_letters as $filtered_letter => $val)
                        <li class="as-filtered-stores-navbar-item"><span class="as-filtered-stores-letter">{{$filtered_letter}}</span></li>
                    @endforeach
                </ul>
                <ul class="as-filtered-stores-list" id="as-filtered-stores-list">
                    @foreach($allstores as $store)
                    <li>
                        <a class="as-filtered-stores-list-item" href="/store/{{$store->secondary_url}}" title="{{$store->title}} Coupons">
                            <span class="store_title">{{$store->title}}</span>
                            @if(count($store->offer) > 1) 
                                <span>{{count($store->offer)}} Coupons Available</span>
                            @elseif(count($store->offer) == 1)
                                <span>{{count($store->offer)}} Coupon Available</span>
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
</div>
<script src="{{asset('js/customdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        var height_difference = $(this).scrollTop() - $('#as-allstores-container').position().top;
        if(height_difference >= 0 && height_difference + 605 < $("#as-allstores-container").height()){
            $("#as-category-inner-container").css({position: "fixed", top: "10px", bottom: "auto", width: "320px"});
        }
        else if(height_difference + 605 >= $("#as-allstores-container").height()){
            $("#as-category-inner-container").css({position: "absolute", top: "auto", bottom: "0", width: "320px"});
        }
        else{
            $("#as-category-inner-container").css({position: "absolute", top: "0", bottom: "auto", width: "100%"});
        }
        $(document).on('scroll', function() {
            height_difference = $(this).scrollTop() - $('#as-allstores-container').position().top;
            if(height_difference >= 0 && height_difference + 605 < $("#as-allstores-container").height()){
                $("#as-category-inner-container").css({position: "fixed", top: "10px", bottom: "auto", width: "320px"});
            }
            else if(height_difference + 605 >= $("#as-allstores-container").height()){
                $("#as-category-inner-container").css({position: "absolute", top: "auto", bottom: "0", width: "320px"});
            }
            else{
                $("#as-category-inner-container").css({position: "absolute", top: "0", bottom: "auto", width: "100%"});
            }
        });
        //letters navbar
        $(".as-filtered-stores-letter").click(function(){
            $(".as-filtered-stores-letter").removeClass("active-filtered-stores-letter");
            $(this).addClass("active-filtered-stores-letter");
            var searched_character = $(this).text();
            // set dropdown selected option
            $('#as-filtered-stores-letters-dropdown .select span').text($(this).text());
            $('#as-filtered-stores-letters-dropdown .dropdown-menu li').removeClass('active');
            $('#as-filtered-stores-letters-dropdown .dropdown-menu li').each(function(index, value){
                if( $(value).text().toUpperCase() == searched_character.toUpperCase()) {
                    $(this).addClass('active');
                }
            });
            if(searched_character.toUpperCase() == "ALL"){
                $("#as-filtered-stores-list li").show();
            }
            else if(searched_character == "0-9"){
                $("#as-filtered-stores-list .store_title").each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if($.isNumeric(current_character)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }
            else{
                $("#as-filtered-stores-list .store_title").each(function(index, value){
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
        $("#as-filtered-stores-letters-dropdown .dropdown-menu li").click(function(){
            var searched_character = $(this).text();
            $(".as-filtered-stores-letter").removeClass("active-filtered-stores-letter");
            $(".as-filtered-stores-letter").each(function(index, value){
                if( $(value).text().toUpperCase() == searched_character.toUpperCase()) {
                    $(this).addClass('active-filtered-stores-letter');
                }
            });
            if(searched_character.toUpperCase() == "ALL"){
                $("#as-filtered-stores-list li").show();
            }
            else if(searched_character == "0-9"){
                $("#as-filtered-stores-list .store_title").each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if($.isNumeric(current_character)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }
            else{
                $("#as-filtered-stores-list .store_title").each(function(index, value){
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