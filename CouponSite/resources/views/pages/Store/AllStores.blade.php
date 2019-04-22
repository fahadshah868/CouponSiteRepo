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
                        <li>
                            <div class="as-categories-list-item active" id="allstores" title="All Stores & Coupons">
                                <span>All Stores</span>
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </li>
                        @foreach($allcategories as $category)
                            <li>
                            <div class="as-categories-list-item" id="{{$category->category->id}}" title='{{$category->category->title}} Stores & Coupons'>
                                    <span>{{$category->category->title}}</span>
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="as-filtered-stores-body-container">
            <span class="as-filtered-stores-heading">All Stores & Coupons</span>
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
                        <a class="as-filtered-stores-list-item" href="/store/{{$store->secondary_url}}" title='{{$store->title}} Coupons'>
                            <div class="store-info">
                                <img class="store-logo" src="{{$panel_assets_url.$store->logo_url}}">
                                <span class="store-title">{{$store->title}}</span>
                            </div>
                            @if(count($store->offers) > 1)
                                <span class="coupons-count">{{$store->offers_count}} Coupons Available</span>
                            @elseif(count($store->offers) == 1)
                                <span class="coupons-count">{{$store->offers_count}} Coupon Available</span>
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
</div>
<script src="{{asset('js/customdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        var height_difference = $(this).scrollTop() - $('#as-allstores-container').position().top;
        if(height_difference >= 0 && height_difference + 605 < $(`#as-allstores-container`).height()){
            $(`#as-category-inner-container`).css({position: `fixed`, top: `10px`, bottom: `auto`, width: `320px`});
        }
        else if(height_difference + 605 >= $(`#as-allstores-container`).height()){
            $(`#as-category-inner-container`).css({position: `absolute`, top: `auto`, bottom: `0`, width: `320px`});
        }
        else{
            $(`#as-category-inner-container`).css({position: `absolute`, top: `0`, bottom: `auto`, width: `100%`});
        }
        $(document).on('scroll', function() {
            height_difference = $(this).scrollTop() - $('#as-allstores-container').position().top;
            if(height_difference >= 0 && height_difference + 605 < $(`#as-allstores-container`).height()){
                $(`#as-category-inner-container`).css({position: `fixed`, top: `10px`, bottom: `auto`, width: `320px`});
            }
            else if(height_difference + 605 >= $(`#as-allstores-container`).height()){
                $(`#as-category-inner-container`).css({position: `absolute`, top: `auto`, bottom: `0`, width: `320px`});
            }
            else{
                $(`#as-category-inner-container`).css({position: `absolute`, top: `0`, bottom: `auto`, width: `100%`});
            }
        });
        //letters navbar
        $(`#as-filtered-stores-navbar`).on(`click`,`.as-filtered-stores-navbar-item .as-filtered-stores-letter`,function(){
            $(`.as-filtered-stores-letter`).removeClass(`active-filtered-stores-letter`);
            $(this).addClass(`active-filtered-stores-letter`);
            var searched_character = $(this).text();
            // set dropdown selected option
            $('#as-filtered-stores-letters-dropdown .select span').text($(this).text());
            $('#as-filtered-stores-letters-dropdown .dropdown-menu li').removeClass('active');
            $('#as-filtered-stores-letters-dropdown .dropdown-menu li').each(function(index, value){
                if( $(value).text().toUpperCase() == searched_character.toUpperCase()) {
                    $(this).addClass('active');
                }
            });
            if(searched_character.toUpperCase() == `ALL`){
                $(`#as-filtered-stores-list li`).show();
            }
            else if(searched_character == `0-9`){
                $(`#as-filtered-stores-list .store-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if($.isNumeric(current_character)) {
                        $(this).parent().parent().parent().show();
                    } else {
                        $(this).parent().parent().parent().hide();
                    }
                });
            }
            else{
                $(`#as-filtered-stores-list .store-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if( current_character.toUpperCase().indexOf(searched_character.toUpperCase()) > -1) {
                        $(this).parent().parent().parent().show();
                    } else {
                        $(this).parent().parent().parent().hide();
                    }
                });
            }
        });
        //letters dropdown
        $(`#as-filtered-stores-letters-dropdown`).on(`click`,`.dropdown-menu li`,function(){
            var searched_character = $(this).text();
            $(`.as-filtered-stores-letter`).removeClass(`active-filtered-stores-letter`);
            $(`.as-filtered-stores-letter`).each(function(index, value){
                if( $(value).text().toUpperCase() == searched_character.toUpperCase()) {
                    $(this).addClass('active-filtered-stores-letter');
                }
            });
            if(searched_character.toUpperCase() == `ALL`){
                $(`#as-filtered-stores-list li`).show();
            }
            else if(searched_character == `0-9`){
                $(`#as-filtered-stores-list .store-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if($.isNumeric(current_character)) {
                        $(this).parent().parent().parent().show();
                    } else {
                        $(this).parent().parent().parent().hide();
                    }
                });
            }
            else{
                $(`#as-filtered-stores-list .store-title`).each(function(index, value){
                    var current_character = $(value).text().charAt(0);
                    if( current_character.toUpperCase().indexOf(searched_character.toUpperCase()) > -1) {
                    $(this).parent().parent().parent().show();
                    } else {
                        $(this).parent().parent().parent().hide();
                    }
                });
            }
        });
    });
    $(`.as-categories-list-item`).click(function(){
        if(!$(this).hasClass(`active`)){
            $(`.as-categories-list-item`).removeClass(`active`);
            $(this).addClass(`active`);
            var category_id = $(this).attr(`id`);
            $.ajax({
                type:'GET',
                url:'/'+category_id+'/stores',
                data: '',
                beforeSend: function(){
                },
                complete: function(){
                },
                success:function(data){
                    $(`#as-filtered-stores-navbar li`).not(`#as-filtered-stores-navbar li:first`).remove();
                    $(`#as-filtered-stores-list li`).remove();
                    //letters navbar
                    $(`#as-filtered-stores-letters-dropdown .dropdown-menu li`).not(`#as-filtered-stores-letters-dropdown .dropdown-menu li:first`).remove();
                    $(`#as-filtered-stores-navbar li .as-filtered-stores-letter`).removeClass(`active-filtered-stores-letter`);
                    $(`#as-filtered-stores-navbar li:first .as-filtered-stores-letter`).addClass(`active-filtered-stores-letter`);
                    //letters dropdown
                    $(`#as-filtered-stores-letters-dropdown .dropdown-menu li`).removeClass(`active`);
                    $(`#as-filtered-stores-letters-dropdown .dropdown-menu li:first`).addClass(`active`);
                    $(`#as-filtered-stores-letters-dropdown .select span`).text(`ALL`);
                    if(data.status == 1){
                        $.each(data.filtered_letters, function (index, filtered_letter) {
                            var html = `<li class="as-filtered-stores-navbar-item"><span class="as-filtered-stores-letter">`+index+`</span></li>`;
                            $(`#as-filtered-stores-navbar`).append(html);
                            $(`#as-filtered-stores-letters-dropdown .dropdown-menu`).append(`<li>`+index+`</li>`);
                        });
                        $.each(data.allstores, function (index, store) {
                            var html = `<li>`+
                                `<a class="as-filtered-stores-list-item" href="/store/`+store.secondary_url+`" title="`+store.title+` Coupons">`+
                                    `<div class="store-info">`+
                                        `<img class="store-logo" src="`+data.panel_assets_url+store.logo_url+`">`+
                                        `<span class="store-title">`+store.title+`</span>`+
                                    `</div>`;
                                    if(store.offers_count > 1){
                                        html = html + `<span class="coupons-count">`+store.offers_count+` Coupons Available</span>`;
                                    }
                                    else if(store.offers_count == 1){
                                        html = html + `<span class="coupons-count">`+store.offers_count+` Coupon Available</span>`;
                                    }
                                    else{
                                        html = html + `<span class="coupons-count">No Coupons Available</span>`;                                
                                    }
                                `</a>`+
                            `</li>`;
                            $(`#as-filtered-stores-list`).append(html);
                        });
                    }
                    else{
                        $.each(data.filtered_letters, function (index, filtered_letter) {
                            var html = `<li class="as-filtered-stores-navbar-item"><span class="as-filtered-stores-letter">`+index+`</span></li>`;
                            $(`#as-filtered-stores-navbar`).append(html);
                            $(`#as-filtered-stores-letters-dropdown .dropdown-menu`).append(`<li>`+index+`</li>`);
                        });
                        $.each(data.storecategories, function (index, storecategory) {
                            var html = `<li>`+
                                `<a class="as-filtered-stores-list-item" href="/store/`+storecategory.store.secondary_url+`" title="`+storecategory.store.title+` Coupons">`+
                                    `<div class="store-info">`+
                                        `<img class="store-logo" src="`+data.panel_assets_url+storecategory.store.logo_url+`">`+
                                        `<span class="store-title">`+storecategory.store.title+`</span>`+
                                    `</div>`;
                                    if(storecategory.store.offers_count > 1){
                                        html = html + `<span class="coupons-count">`+storecategory.store.offers_count+` Coupons Available</span>`;
                                    }
                                    else if(storecategory.store.offers_count == 1){
                                        html = html + `<span class="coupons-count">`+storecategory.store.offers_count+` Coupon Available</span>`;
                                    }
                                    else{
                                        html = html + `<span class="coupons-count">No Coupons Available</span>`;                                
                                    }
                                `</a>`+
                            `</li>`;
                            $(`#as-filtered-stores-list`).append(html);
                        });
                    }
                }
            });
        }
    });
</script>

@endsection