@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<!-- overlay container while ajax request -->
<div class="fo-overlay-container" id="fo-overlay-container"></div>
<div class="fo-main-container">
    <div class="fo-sb">
        <div class="fo-sb-offers-availability" id="offers-availability">{{$offers->total()}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        @if(count($stores) > 0)
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">
                <span>Filter By Store</span>
                <span class="reset-store-filters" id="reset-store-filters">Reset</span>
            </div>
            <div class="fo-sb-content-body" id="fo-sb-store-container">
                @foreach($stores as $store)
                <label class="checkbox-container store">{{$store->title}}
                    <input type="checkbox" value="{{$store->id}}" class="store-filter">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        @endif
        @if(count($categories) > 0)
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">
                <span>Filter By Category</span>
                <span class="reset-category-filters" id="reset-category-filters">Reset</span>
            </div>
            <div class="fo-sb-content-body" id="fo-sb-category-container">
                @foreach($categories as $category)
                <label class="checkbox-container category">{{$category->title}}
                    <input type="checkbox" value="{{$category->id}}" class="category-filter">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        @endif
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">Title</div>
            <div class="fo-sb-content-body">
                <span class="fo-store-details">Listed above you'll find some of the best online codes coupons, discounts and promotion codes as ranked by the users of RetailMeNot.com. To use a coupon simply click the coupon code then enter the code during the store's checkout process.</span>
            </div>
        </div>
    </div>
    <div class="fo-db">
        <div class="fo-db-heading">Online Promo Codes</div>
        @if(count($offers) > 0)
        <section id="filtered-offers">
            @include('partialviews.offers')
        </section>
        @else
        <div class="no-coupons-alert">No Online Code Coupons Available</div>
        @endif
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(document).ready(function(){
        var filtertype;
        // pagination using ajax----------------------------------------------------
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');  
            getOffers(url);
        });
        function getOffers(url) {
            var categories_id = [];
            var stores_id = [];
            $(`.checkbox-container`).find(`.store-filter:checked`).each(function () {
                stores_id.push($(this).val());
            });
            $(`.checkbox-container`).find(`.category-filter:checked`).each(function () {
                categories_id.push($(this).val());
            });
            $.ajax({
                url : url,
                data: {stores_id: stores_id, categories_id: categories_id, filtertype: -1}
            }).done(function (data) {
                $('#filtered-offers').html(data.partialview);  
                $('html, body').animate({
                    scrollTop: $("div.fo-db-heading").offset().top
                }, 500)
            }).fail(function () {
                alert('something went wrong.');
            });
        }
        // click on checkboxes----------------------------------------------------
        $(`.fo-sb-content-body`).on('click','.checkbox-container input[type="checkbox"]',function(){
            if($(this).attr('class') == "store-filter"){
                filtertype = 1;
            }
            else if($(this).attr('class') == "category-filter"){
                filtertype = 2;
            }
            var categories_id = [];
            var stores_id = [];
            $(`.checkbox-container`).find(`.store-filter:checked`).each(function () {
                stores_id.push($(this).val());
            });
            $(`.checkbox-container`).find(`.category-filter:checked`).each(function () {
                categories_id.push($(this).val());
            });
            // if (one OR both) stores OR categories filters applied
            if(stores_id.length > 0 || categories_id.length > 0){
                if(stores_id.length == 0){
                    $(`#reset-store-filters`).css('display','none');
                    stores_id = 0;
                }
                else{
                    $(`#reset-store-filters`).css('display','block');
                }
                if(categories_id.length == 0){
                    $(`#reset-category-filters`).css('display','none');
                    categories_id = 0;
                }
                else{
                    $(`#reset-category-filters`).css('display','block');
                }
                $.ajax({
                    type:`GET`,
                    url:`/filteronlinecodes`,
                    data: {stores_id: stores_id, categories_id: categories_id, filtertype: filtertype},
                    beforeSend: function (xhr) {
                        $("#fo-overlay-container").css("display","block");
                    },
                }).done(function (data) {
                    $(`#filtered-offers`).html(data.partialview);
                    //set offers count
                    if(data.offerscount > 1){
                        $(`#offers-availability`).html(data.offerscount+" Offers Available");
                    }
                    else if(data.offerscount == 1){
                        $(`#offers-availability`).html(data.offerscount+" Offer Available");
                    }
                    else if(data.offerscount < 1){
                        $(`#offers-availability`).html("No Offers Available");
                    }
                    //set store categories if not null e.g. when any checkbox checked
                    if(data.storecategories != null){
                        // when apply store filter
                        if(filtertype == 1){
                            var html = "";
                            var categories_arr = [];
                            $.each(data.storecategories, function(index, storecategory){
                                if(storecategory.category != null){
                                    var filteredcategory = storecategory.category.title;
                                    var flag = false;
                                    $('.checkbox-container.category').each(function(){
                                        var existingcategory = $(this).text().replace(/^\s+|\s+$/gm,'');
                                        var existingcategory_checkbox = $(this).find('input[type="checkbox"]');
                                        /*  there are two conditions
                                            1- if existing and server-side filtered categories are equals to each other
                                               so that it can not be duplicate on client side
                                            2- if some categories are checked before selecting store, and store has not containing that category mapping
                                               so that it can be tracable after de-selecting the same store
                                        */
                                        if(existingcategory == filteredcategory){
                                            flag = true;
                                            // check if category already exists in categories_arr
                                            if(categories_arr.indexOf(existingcategory) == -1){
                                                categories_arr.push(existingcategory);
                                            }
                                            if(existingcategory_checkbox.prop("checked")){
                                                html = html +
                                                `<label class="checkbox-container category">`+existingcategory+
                                                    `<input type="checkbox" value="`+existingcategory_checkbox.val()+`" class="category-filter" checked>`+
                                                    `<span class="checkmark"></span>`+
                                                `</label>`
                                            }
                                            else{
                                                html = html +
                                                `<label class="checkbox-container category">`+existingcategory+
                                                    `<input type="checkbox" value="`+existingcategory_checkbox.val()+`" class="category-filter">`+
                                                    `<span class="checkmark"></span>`+
                                                `</label>`
                                            }
                                            return false;
                                        }
                                        else if(existingcategory_checkbox.prop("checked") && categories_arr.indexOf(existingcategory) == -1){
                                            categories_arr.push(existingcategory);
                                            html = html +
                                                `<label class="checkbox-container store">`+ existingcategory +
                                                    `<input type="checkbox" value="`+existingcategory_checkbox.val()+`" class="store-filter" checked>`+
                                                    `<span class="checkmark"></span>`+
                                                `</label>`
                                        }
                                    });
                                    if(!flag){
                                        html = html +
                                        `<label class="checkbox-container category">`+filteredcategory+
                                            `<input type="checkbox" value="`+storecategory.category.id+`" class="category-filter">`+
                                            `<span class="checkmark"></span>`+
                                        `</label>`
                                    }
                                }
                            });
                            console.log(categories_arr);
                            $(`#fo-sb-category-container`).html(html);
                        }
                        // when apply category filter
                        else if(filtertype == 2){
                            var html = "";
                            var stores_arr = [];
                            $.each(data.storecategories, function(index, storecategory){
                                if(storecategory.store != null){
                                    var filteredstore = storecategory.store.title;
                                    var flag = false;
                                    $('.checkbox-container.store').each(function(){
                                        var existingstore = $(this).text().replace(/^\s+|\s+$/gm,'');
                                        var existingstore_checkbox = $(this).find('input[type="checkbox"]');
                                        /*  there are two conditions
                                            1- if existing and server-side filtered stores are equals to each other
                                               so that it can not be duplicate on client side
                                            2- if some stores are checked before selecting category, and store has not containing that category mapping
                                               so that it can be tracable after de-selecting the same category
                                        */
                                        if(existingstore == filteredstore){
                                            flag = true;
                                            // check if store already exists in stores_arr
                                            if(stores_arr.indexOf(existingstore) == -1){
                                                stores_arr.push(existingstore);
                                            }
                                            if(existingstore_checkbox.prop("checked")){
                                                html = html +
                                                `<label class="checkbox-container store">`+ existingstore +
                                                    `<input type="checkbox" value="`+existingstore_checkbox.val()+`" class="store-filter" checked>`+
                                                    `<span class="checkmark"></span>`+
                                                `</label>`
                                            }
                                            else{
                                                html = html +
                                                `<label class="checkbox-container store">`+ existingstore +
                                                    `<input type="checkbox" value="`+existingstore_checkbox.val()+`" class="store-filter">`+
                                                    `<span class="checkmark"></span>`+
                                                `</label>`
                                            }
                                            return false;
                                        }
                                        else if(existingstore_checkbox.prop("checked") && stores_arr.indexOf(existingstore) == -1){
                                            stores_arr.push(existingstore);
                                            html = html +
                                                `<label class="checkbox-container store">`+ existingstore +
                                                    `<input type="checkbox" value="`+existingstore_checkbox.val()+`" class="store-filter" checked>`+
                                                    `<span class="checkmark"></span>`+
                                                `</label>`
                                        }
                                    });
                                    if(!flag){
                                        html = html +
                                        `<label class="checkbox-container store">`+filteredstore+
                                            `<input type="checkbox" value="`+storecategory.store.id+`" class="store-filter">`+
                                            `<span class="checkmark"></span>`+
                                        `</label>`
                                    }
                                }
                            });
                            console.log(stores_arr);
                            $(`#fo-sb-store-container`).html(html);
                        }
                    }
                    // if store categories are null e.g. when uncheck all stores checkboxes and any of category checkbox checked
                    else{
                        // when uncheck all categories checkboxes and any of store checkbox checked
                        if(data.stores != null){
                            var html = "";
                            var stores = $('.checkbox-container.store').each(function(){
                                return $(this).text();
                            });
                            $.each(data.stores, function(index, store){
                                var filteredstore = store.title;
                                var flag = false;
                                stores.each(function(){
                                    var existingstore = $(this).text().replace(/^\s+|\s+$/gm,'');
                                    if(existingstore == filteredstore){
                                        flag = true;
                                        var checkbox = $(this).find('input[type="checkbox"]');
                                        if(checkbox.prop("checked")){
                                            html = html +
                                            `<label class="checkbox-container store">`+filteredstore+
                                                `<input type="checkbox" value="`+store.id+`" class="store-filter" checked>`+
                                                `<span class="checkmark"></span>`+
                                            `</label>`
                                        }
                                        else{
                                            html = html +
                                            `<label class="checkbox-container store">`+filteredstore+
                                                `<input type="checkbox" value="`+store.id+`" class="store-filter">`+
                                                `<span class="checkmark"></span>`+
                                            `</label>`
                                        }
                                        return false;
                                    }
                                });
                                if(!flag){
                                    html = html +
                                    `<label class="checkbox-container store">`+filteredstore+
                                        `<input type="checkbox" value="`+store.id+`" class="store-filter">`+
                                        `<span class="checkmark"></span>`+
                                    `</label>`
                                }
                            });
                            $(`#fo-sb-store-container`).html(html);
                        }
                        // when uncheck all stores checkboxes and any of category checkbox checked
                        if(data.categories != null){
                            var html = "";
                            var categories = $('.checkbox-container.category').each(function(){
                                return $(this).text();
                            });
                            $.each(data.categories, function(index, category){
                                var filteredcategory = category.title;
                                var flag = false;
                                categories.each(function(){
                                    var existingcategory = $(this).text().replace(/^\s+|\s+$/gm,'');
                                    if(existingcategory == filteredcategory){
                                        flag = true;
                                        var checkbox = $(this).find('input[type="checkbox"]');
                                        if(checkbox.prop("checked")){
                                            html = html +
                                            `<label class="checkbox-container category">`+filteredcategory+
                                                `<input type="checkbox" value="`+category.id+`" class="category-filter" checked>`+
                                                `<span class="checkmark"></span>`+
                                            `</label>`
                                        }
                                        else{
                                            html = html +
                                            `<label class="checkbox-container category">`+filteredcategory+
                                                `<input type="checkbox" value="`+category.id+`" class="category-filter">`+
                                                `<span class="checkmark"></span>`+
                                            `</label>`
                                        }
                                        return false;
                                    }
                                });
                                if(!flag){
                                    html = html +
                                    `<label class="checkbox-container category">`+filteredcategory+
                                        `<input type="checkbox" value="`+category.id+`" class="category-filter">`+
                                        `<span class="checkmark"></span>`+
                                    `</label>`
                                }
                            });
                            $(`#fo-sb-category-container`).html(html);
                        }
                    }
                    $("#fo-overlay-container").css("display","none");
                    $('html, body').animate({
                        scrollTop: $("div.fo-db-heading").offset().top
                    }, 500)
                }).fail(function () {
                    alert(`something went wrong.`);
                });
            }
            // when both stores and categories filters/checkboxes are unchecked
            else{
                $(`#reset-store-filters`).css('display','none');
                $(`#reset-category-filters`).css('display','none');
                $.ajax({
                    type:`GET`,
                    url:`/filteronlinecodes`,
                    data: {stores_id: 0, categories_id: 0, filtertype: 0},
                    beforeSend: function (xhr) {
                        $("#fo-overlay-container").css("display","block");
                    },
                }).done(function (data) {
                    $(`#filtered-offers`).html(data.partialview);
                    if(data.offerscount > 1){
                        $(`#offers-availability`).html(data.offerscount+" Offers Available");
                    }
                    else if(data.offerscount == 1){
                        $(`#offers-availability`).html(data.offerscount+" Offer Available");
                    }
                    else if(data.offerscount < 1){
                        $(`#offers-availability`).html("No Offers Available");
                    }
                    //display all top AND popular stores
                    if(data.stores != null){
                        var html = "";
                        $.each(data.stores, function(index, store){
                            html = html +
                            `<label class="checkbox-container store">`+store.title+
                                `<input type="checkbox" value="`+store.id+`" class="store-filter">`+
                                `<span class="checkmark"></span>`+
                            `</label>`
                        });
                        $(`#fo-sb-store-container`).html(html);
                    }
                    //display all top AND popular categories
                    if(data.categories != null){
                        var html = "";
                        $.each(data.categories, function(index, category){
                            html = html +
                            `<label class="checkbox-container category">`+category.title+
                                `<input type="checkbox" value="`+category.id+`" class="category-filter">`+
                                `<span class="checkmark"></span>`+
                            `</label>`
                        });
                        $(`#fo-sb-category-container`).html(html);
                    }
                    $("#fo-overlay-container").css("display","none");
                    $('html, body').animate({
                        scrollTop: $("div.fo-db-heading").offset().top
                    }, 500)
                }).fail(function () {
                    alert(`something went wrong.`);
                });
            }
        });
        $(`#reset-store-filters`).click(function(){
            filtertype = 1;
            var categories_id = [];
            $(`.checkbox-container`).find(`.category-filter:checked`).each(function () {
                categories_id.push($(this).val());
            });
            if(categories_id.length == 0){
                categories_id = 0;
            }
            $(`#reset-store-filters`).css('display','none');
            $('.checkbox-container').find('.store-filter:checkbox').prop(`checked`, false);
            $.ajax({
                type:`GET`,
                url:`/filteronlinecodes`,
                data: {stores_id: 0, categories_id: categories_id, filtertype: filtertype},
                beforeSend: function (xhr) {
                    $("#fo-overlay-container").css("display","block");
                },
            }).done(function (data) {
                $(`#filtered-offers`).html(data.partialview);
                // set filtered offers count
                if(data.offerscount > 1){
                    $(`#offers-availability`).html(data.offerscount+" Offers Available");
                }
                else if(data.offerscount == 1){
                    $(`#offers-availability`).html(data.offerscount+" Offer Available");
                }
                else if(data.offerscount < 1){
                    $(`#offers-availability`).html("No Offers Available");
                }
                // when uncheck all stores checkboxes and any of category checkbox checked
                if(data.categories != null){
                    var html = "";
                    var categories = $('.checkbox-container.category').each(function(){
                        return $(this).text();
                    });
                    $.each(data.categories, function(index, category){
                        var filteredcategory = category.title;
                        var flag = false;
                        categories.each(function(){
                            var existingcategory = $(this).text().replace(/^\s+|\s+$/gm,'');
                            if(existingcategory == filteredcategory){
                                flag = true;
                                var checkbox = $(this).find('input[type="checkbox"]');
                                if(checkbox.prop("checked")){
                                    html = html +
                                    `<label class="checkbox-container category">`+filteredcategory+
                                        `<input type="checkbox" value="`+category.id+`" class="category-filter" checked>`+
                                        `<span class="checkmark"></span>`+
                                    `</label>`
                                }
                                else{
                                    html = html +
                                    `<label class="checkbox-container category">`+filteredcategory+
                                        `<input type="checkbox" value="`+category.id+`" class="category-filter">`+
                                        `<span class="checkmark"></span>`+
                                    `</label>`
                                }
                                return false;
                            }
                        });
                        if(!flag){
                            html = html +
                            `<label class="checkbox-container category">`+filteredcategory+
                                `<input type="checkbox" value="`+category.id+`" class="category-filter">`+
                                `<span class="checkmark"></span>`+
                            `</label>`
                        }
                    });
                    $(`#fo-sb-category-container`).html(html);
                }
                $("#fo-overlay-container").css("display","none");
                $('html, body').animate({
                    scrollTop: $("div.fo-db-heading").offset().top
                }, 500)
            }).fail(function () {
                alert(`something went wrong.`);
            });
        });
        $(`#reset-category-filters`).click(function(){
            filtertype = 2;
            var stores_id = [];
            var categories_id = 0;
            $(`.checkbox-container`).find(`.store-filter:checked`).each(function () {
                stores_id.push($(this).val());
            });
            if(stores_id.length == 0){
                stores_id = 0;
            }
            $(`#reset-category-filters`).css('display','none');
            $('.checkbox-container').find('.category-filter:checkbox').prop(`checked`, false);
            $.ajax({
                type:`GET`,
                url:`/filteronlinecodes`,
                data: {stores_id: stores_id, categories_id: 0, filtertype: filtertype},
                beforeSend: function (xhr) {
                    $("#fo-overlay-container").css("display","block");
                },
            }).done(function (data) {
                $(`#filtered-offers`).html(data.partialview);
                // set filtered offers count
                if(data.offerscount > 1){
                    $(`#offers-availability`).html(data.offerscount+" Offers Available");
                }
                else if(data.offerscount == 1){
                    $(`#offers-availability`).html(data.offerscount+" Offer Available");
                }
                else if(data.offerscount < 1){
                    $(`#offers-availability`).html("No Offers Available");
                }
                // when uncheck all categories checkboxes and any of store checkbox checked
                if(data.stores != null){
                    var html = "";
                    var stores = $('.checkbox-container.store').each(function(){
                        return $(this).text();
                    });
                    $.each(data.stores, function(index, store){
                        var filteredstore = store.title;
                        var flag = false;
                        stores.each(function(){
                            var existingstore = $(this).text().replace(/^\s+|\s+$/gm,'');
                            if(existingstore == filteredstore){
                                flag = true;
                                var checkbox = $(this).find('input[type="checkbox"]');
                                if(checkbox.prop("checked")){
                                    html = html +
                                    `<label class="checkbox-container store">`+filteredstore+
                                        `<input type="checkbox" value="`+store.id+`" class="store-filter" checked>`+
                                        `<span class="checkmark"></span>`+
                                    `</label>`
                                }
                                else{
                                    html = html +
                                    `<label class="checkbox-container store">`+filteredstore+
                                        `<input type="checkbox" value="`+store.id+`" class="store-filter">`+
                                        `<span class="checkmark"></span>`+
                                    `</label>`
                                }
                                return false;
                            }
                        });
                        if(!flag){
                            html = html +
                            `<label class="checkbox-container store">`+filteredstore+
                                `<input type="checkbox" value="`+store.id+`" class="store-filter">`+
                                `<span class="checkmark"></span>`+
                            `</label>`
                        }
                    });
                    $(`#fo-sb-store-container`).html(html);
                }
                $("#fo-overlay-container").css("display","none");
                $('html, body').animate({
                    scrollTop: $("div.fo-db-heading").offset().top
                }, 500)
            }).fail(function () {
                alert(`something went wrong.`);
            });
        });
    });
</script>

@endsection