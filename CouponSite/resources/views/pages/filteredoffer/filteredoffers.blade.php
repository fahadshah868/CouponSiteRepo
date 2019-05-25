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
                <label class="checkbox-container">{{$store->title}}
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
                <label class="checkbox-container">{{$category->title}}
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
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');  
            getOffers(url);
        });
        function getOffers(url) {
            var category_id = [];
            var stores_id = [];
            $(`.checkbox-container`).find(`input:checked`).each(function () {
                stores_id.push($(this).val());
            });
            $.ajax({
                url : url,
                data: {stores_id: stores_id, categories_id: category_id}
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
            var category_id = [];
            var stores_id = [];
            $(`.checkbox-container`).find(`input:checked`).each(function () {
                stores_id.push($(this).val());
            });
            if(stores_id.length > 0){
                $(`#reset-store-filters`).css('display','block');
                $.ajax({
                    type:`GET`,
                    url:`/applymorefilters`,
                    data: {stores_id: stores_id, categories_id: category_id}
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
            else{
                $(`#reset-store-filters`).css('display','none');
                $.ajax({
                    type:`GET`,
                    url:`/applymorefilters`
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
            $(`#reset-store-filters`).click(function(){
                var category_id = $("#category_id").val();
                $(`#reset-store-filters`).css('display','none');
                $('.checkbox-container').find('input:checkbox').prop(`checked`, false);
                $.ajax({
                    type:`GET`,
                    url:`/applymorefilters`
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
    });
</script>

@endsection