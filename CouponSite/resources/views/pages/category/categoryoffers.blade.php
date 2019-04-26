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
                <input type="hidden" id="category_id" value="{{$category->id}}">
                @foreach($stores as $store)
                <label class="checkbox-container">{{$store{0}->store->title}}
                    <input type="checkbox" value="{{$store{0}->store->id}}" class="store-filter">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        @endif
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">Top Categories</div>
            <div class="fo-sb-list-container">
                <ul>
                    @foreach($alltopcategories as $topcategory)
                        @if($topcategory->id != $category->id)
                        <li>
                            <a class="fo-sb-list-item" href="/coupons/{{$topcategory->url}}" title="{{$topcategory->title}} Coupons">
                                <span class="item-title">{{$topcategory->title}}</span>
                                <span class="coupons-count">{{$topcategory->offers_count}}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">{{$category->title}}</div>
            <div class="fo-sb-content-body">
                <span class="fo-store-details">{!!$category->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-db">
        <div class="fo-db-heading">{{$category->title}} Coupons & Promo Codes</div>
        @if(count($filteredoffers) > 0)
        <section id="filtered-offers">
        @include('partialviews.filteredoffers')
        </section>
        @else
        <div class="no-coupons-alert">No Coupons Available For {{$category->title}}</div>
        @endif
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(`body`).on(`click`, `.pagination a`, function(e) {
        e.preventDefault();
        var url = $(this).attr(`href`);  
        getArticles(url);
    });
    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $(`#filtered-offers`).html(data);
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
                url:`/applymorefilters/`+stores_id+`/`+category_id
            }).done(function (data) {
                $(`#filtered-offers`).html(data);
                if($(`#fo-offers-availability`).val() > 1){
                    $(`#offers-availability`).html($(`#fo-offers-availability`).val()+" Offers Available");
                }
                else if($(`#fo-offers-availability`).val() == 1){
                    $(`#offers-availability`).html($(`#fo-offers-availability`).val()+" Offer Available");
                }
            }).fail(function () {
                alert(`something went wrong.`);
            });
        }
        else{
            $(`#reset-store-filters`).css('display','none');
            $.ajax({
                type:`GET`,
                url:`/applymorefilters/0/`+category_id
            }).done(function (data) {
                $(`#filtered-offers`).html(data);
                if($(`#fo-offers-availability`).val() > 1){
                    $(`#offers-availability`).html($(`#fo-offers-availability`).val()+" Offers Available");
                }
                else if($(`#fo-offers-availability`).val() == 1){
                    $(`#offers-availability`).html($(`#fo-offers-availability`).val()+" Offer Available");
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
                url:`/applymorefilters/0/`+category_id
            }).done(function (data) {
                $(`#filtered-offers`).html(data);
                if($(`#fo-offers-availability`).val() > 1){
                    $(`#offers-availability`).html($(`#fo-offers-availability`).val()+" Offers Available");
                }
                else if($(`#fo-offers-availability`).val() == 1){
                    $(`#offers-availability`).html($(`#fo-offers-availability`).val()+" Offer Available");
                }
            }).fail(function () {
                alert(`something went wrong.`);
            });
        });
    });
</script>
@endsection