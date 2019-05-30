@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sb">
        <div class="fo-sb-offers-availability" id="offers-availability">{{$offers->total()}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        @if(count($relatedstores) > 0)
            <div class="fo-sb-content-container">
                <div class="fo-sb-content-heading">
                    <span>Filter By Store</span>
                    <span class="reset-store-filters" id="reset-store-filters">Reset</span>
                </div>
                <div class="fo-sb-content-body">
                    <input type="hidden" id="category_id" value="{{$category->id}}">
                    @foreach($relatedstores as $store)
                        <label class="checkbox-container">{{$store->title}}
                            <input type="checkbox" value="{{$store->id}}" class="store-filter">
                            <span class="checkmark"></span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($alltopcategories) > 0)
            <div class="fo-sb-content-container">
                <div class="fo-sb-content-heading">Top Categories</div>
                <div class="fo-sb-list-container">
                    <ul>
                        @foreach($alltopcategories as $topcategory)
                            <li>
                                <a class="fo-sb-list-item" href="/coupons/{{$topcategory->url}}" title="{{$topcategory->title}} Coupons">
                                    <span class="item-title">{{$topcategory->title}}</span>
                                    <span class="coupons-count">{{$topcategory->offers_count}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">{{$category->title}}</div>
            <div class="fo-sb-content-body">
                <span class="fo-store-details">{!!$category->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-db">
        <div class="fo-db-heading">{{$category->title}} Coupons & Promo Codes</div>
        @if(count($offers) > 0)
        <div id="filtered-offers">
        @include('partialviews.offers')
        </div>
        @else
        <div class="no-coupons-alert">No Coupons Available For {{$category->title}}</div>
        @endif
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(document).ready(function(){
        $(`body`).on(`click`, `.pagination a`, function(e) {
            e.preventDefault();
            var url = $(this).attr(`href`);
            getArticles(url);
        });
        function getArticles(url) {
            var category_id = $("#category_id").val();
            var stores_id = [];
            $(`.checkbox-container`).find(`input:checked`).each(function () {
                stores_id.push($(this).val());
            });
            $.ajax({
                url : url,
                data: {stores_id: stores_id, category_id: category_id, filter: 1}
            }).done(function (data) {
                $(`#filtered-offers`).html(data.partialview);
                $('html, body').animate({
                    scrollTop: $("div.fo-db-heading").offset().top
                }, 500)
            }).fail(function () {
                alert(`something went wrong.`);
            });
        }
        $(`.checkbox-container input[type="checkbox"]`).click(function(){
            var category_id = $("#category_id").val();
            var stores_id = [];
            $(`.checkbox-container`).find(`input:checked`).each(function () {
                stores_id.push($(this).val());
            });
            if(stores_id.length > 0){
                $(`#reset-store-filters`).css('display','block');
                $.ajax({
                    type:`GET`,
                    url:`/filtercategoryoffers`,
                    data: {stores_id: stores_id, category_id: category_id, filter: 1}
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
                var category_id = $("#category_id").val();
                $.ajax({
                    type:`GET`,
                    url:`/filtercategoryoffers`,
                    data: {stores_id: 0, category_id: category_id, filter: 1}
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
                    url:`/filtercategoryoffers`,
                    data: {stores_id: 0, category_id: category_id, filter: 1}
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