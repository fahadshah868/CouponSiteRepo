@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sb">
        <div class="fo-sb-offers-availability" id="offers-availability">{{$filteredoffers->total()}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        @if(count($stores) > 0)
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">
                <span>Filter By Store</span>
                <span class="reset-store-filters" id="reset-store-filters">Reset</span>
            </div>
            <div class="fo-sb-content-body">
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
            <div class="fo-sb-content-body">
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
        @if(count($filteredoffers) > 0)
        <section id="filtered-offers">
            @include('partialviews.filteredoffers')
        </section>
        @else
        <div class="no-coupons-alert">No Coupons Available For </div>
        @endif
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(document).ready(function(){
        var filter;
        var filtertype;
        if("{{Session::has('filter')}}"){
            filter = "{{Session::get('filter')}}";
        }
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
                data: {stores_id: stores_id, categories_id: categories_id, filter: filter, filtertype: 0}
            }).done(function (data) {
                $('#filtered-offers').html(data.partialview);  
                $('html, body').animate({
                    scrollTop: $("div.fo-db-heading").offset().top
                }, 500)
            }).fail(function () {
                alert('something went wrong.');
            });
        }
        $(`.checkbox-container input[type="checkbox"]`).click(function(){
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
                    url:`/applymorefilters`,
                    data: {stores_id: stores_id, categories_id: categories_id, filter: filter, filtertype: filtertype}
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
                    //set store categories
                    if(data.storecategories != null){
                        if(filtertype == 1){
                            var categories = $('.checkbox-container.category').each(function(){
                                return $(this).text();
                            });
                            $.each(data.storecategories, function(index, storecategory){
                                var filteredcategory = storecategory.category.title;
                                categories.each(function(){
                                    var existingcategory = $(this).text().replace(/^\s+|\s+$/gm,'');
                                });
                            });
                        }
                        else if(filtertype == 2){

                        }
                    }
                    else{

                    }












                }).fail(function () {
                    alert(`something went wrong.`);
                });
            }
            else{
                $(`#reset-store-filters`).css('display','none');
                $(`#reset-category-filters`).css('display','none');
                $.ajax({
                    type:`GET`,
                    url:`/applymorefilters`,
                    data: {stores_id: 0, categories_id: 0, filter: filter, filtertype: 0}
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
                url:`/applymorefilters`,
                data: {stores_id: 0, categories_id: categories_id, filter: filter, filtertype: filtertype}
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
                url:`/applymorefilters`,
                data: {stores_id: stores_id, categories_id: 0, filter: filter, filtertype: filtertype}
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
            }).fail(function () {
                alert(`something went wrong.`);
            });
        });
    });
</script>

@endsection